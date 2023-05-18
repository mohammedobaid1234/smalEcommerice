<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class FrontController extends Controller{

    public function __construct(){
        $this->middleware('auth', [
            'except' => ['home', 'viewProduct','register','manStore','cart']
            ]);
        }
    public function home(){
       $newProducts = Product::where('is_new', '1')->get();
       $manProducts = Product::where('type', '1')->get();
       $womanProducts = Product::where('type', '2')->get();
    //    $allProducts = Product::get();
       return view('front.home', [
        'manProducts' => $manProducts,
        'womanProducts' => $womanProducts,
        'newProducts' => $newProducts
       ]);

    }

    public function viewProduct($id){
        $product = Product::whereId($id)->first();
        return view('front.product-details', [
            'product' => $product
           ]);
    }

    public function register(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'mobile_no' => 'required',
            'address' => 'required',
            'password' => 'required|string',
            'confirm_password' => 'required|same:password',
        ]);
        $mobile_no = User::where('mobile_no', $request->mobile_no)->first();
        if($mobile_no){
            return response()->json(['message' => 'This mobile number is already exsist'],403 );
        }
        $email = User::where('email', $request->email)->first();
        if($email){
            return response()->json(['message' => 'This mobile number is already exsist'],403 );
        }
        $newUser = new User();
        $newUser->name = $request->name;
        $newUser->email = $request->email;
        $newUser->mobile_no  = $request->mobile_no ;
        $newUser->address  = $request->address ;
        $newUser->type   = '1';
        $newUser->password = Hash::make($request->password);
        $newUser->save();
        return response()->json([
            'data' =>$newUser,
        ], 200);
    }
    public function addToCart(Request $request){
        $request->validate([
            'product_quantity' => 'required',
            'id' => 'required',
        ]);
        $user_id = auth()->user()->id;
        $orderNotCheckout = Order::whereNull('checkout')->where('user_id', $user_id)->first();
        $product = Product::whereId($request->id)->first();
        $orderNotCheckout ? $order = $orderNotCheckout: $order =  new Order();
        $order->save();

        $orderDetailsWithOder = OrderDetails::where('product_id', $request->id)
        ->where('order_id', $order->id)->first();

        $orderDetailsWithOder ? $orderDetails = $orderDetailsWithOder :  $orderDetails = new OrderDetails();

        $orderDetails->order_id = $order->id;
        $orderDetails->quantity = $orderDetailsWithOder ? $request->product_quantity + $orderDetailsWithOder->quantity :$request->product_quantity;
        $orderDetails->save();
        $orderDetails->product_id = $product->id;
        $orderDetails->price = $product->price ;
        $orderDetails->total = $product->price * $request->product_quantity ;

        $orderDetails->save();
        $order->user_id = auth()->user()->id;
        $order->total = $order->total + $orderDetails->total;
        // $orderDetailsWithOder ? $order->total - $saved + $orderDetails->total :
        $order->save();

        return response()->json([
            'message' =>'ok',
        ], 200);
    }

    public function manStore(){
        $manProducts = Product::where('type', '1')->get();
        return view('front.man-store', [
            'manProducts' => $manProducts,
           ]);

    }
    public function womanStore(){
        $womanProducts = Product::where('type', '2')->get();
        return view('front.woman-store', [
            'womanProducts' => $womanProducts,
           ]);

    }

    public function cart(){
        if(!auth()->user()){
            return redirect()->route('home');

        }
        $user_id = auth()->user()->id;
        $orderNotCheckout = Order::whereNull('checkout')->with('order_details.product')->where('user_id', $user_id)->first();
        if(!$orderNotCheckout){
            return redirect()->route('home');
        }
        return view('front.cart', [
            'orderDetails' => $orderNotCheckout->order_details,
            'total' => $orderNotCheckout->total
           ]);
    }

    public function checkout(){
        $user_id = auth()->user()->id;
        $orderNotCheckout = Order::whereNull('checkout')->where('user_id', $user_id)->first();
        $orderNotCheckout->checkout = now();
        $orderNotCheckout->save();
        return response()->json([
            'message' =>'ok',
        ], 200);
    }

    public function addAndDeleteFromCart(Request $request){
        $user = auth()->user();
        $request->validate([
            'flag' => 'required',
            'product_id' => 'required',
        ]);
        $order = Order::with('order_details.product')
        ->where('checkout', null)
        ->where('user_id', $user->id)
        ->first();
        if(!$order){
            return response()->json(['message' => 'Make order'],403);
        }

        $product = Product::whereId($request->product_id)
        ->first();
        if(!$product){
            return response()->json([
                'message' => 'This Product Not Found'
            ],403);
        }
        \DB::beginTransaction();
        try {
            $product = Product::whereId($request->product_id)->first();

            $order_details = OrderDetails::where('order_id', $order->id)
            ->where('product_id', $request->product_id)
            ->first();
            if(!$order_details && $request->flag == 2){
                return response()->json([
                    'message' => 'This Process Not Allowed'
                ],403);
            }
            if($order_details && $request->flag == 2 && $order_details->quantity == 1){
                $request->flag  = 3;
                // return response()->json([
                //     'message' => 'This Process Not Allowed You Can Delete Product From Cart'
                // ],403);
            }

            if(!$order_details && $request->flag == 1){
                $order_details = new OrderDetails;
                $order_details->order_id = $order->id;
                $order_details->product_id  = $request->product_id ;
                $order_details->price  =  $product->price ;
                $order_details->quantity  =  0 ;
                $order_details->total  =  0 ;
                $order_details->save();
            }
            if($request->flag == '1'){
                $order_details->quantity = $order_details->quantity + 1;
                $order_details->save();
            }
            if($request->flag == 2){
                $order_details->quantity = $order_details->quantity - 1;
                $order_details->save();
            }
            if($request->flag == 3){

               if(!$order_details){
                return response()->json([
                    'message' => 'This Product is already deleted'
                ],403);
               }

            //    $order_details->deleted_at = now();
            //    $order_details->save();
            OrderDetails::where('order_id', $order->id)
            ->where('product_id', $request->product_id)
            ->delete();

            }
            $order_details->total = $order_details->price * $order_details->quantity;
            $order_details->save();
            $order = Order::with('order_details.product')
            ->where('checkout', null)
            ->where('user_id', $user->id)
            ->first();
            $order->total = $order->order_details->sum('total');
            $order->save();
            \DB::commit();
        } catch (\Exception $e) {

            \DB::rollback();
            return response()->json(['message' => $e->getMessage()], 403);
        }
        $order->save();
        return response()->json([
            'message' => 'This Process Succ'
            ,'total' => $order->total
        ]);
    }

    public function userOrders(){
        $user_id = auth()->user()->id;
        $userOrders = Order::with('order_details.product', 'user')->whereNotNull('checkout')->where('user_id', $user_id)->get();
        $products = collect([]);
        foreach ($userOrders as $order) {
            foreach ($order->order_details as $product) {
                $products->push([
                    'order_id' => $order->id,
                    'product_image' => $product->product->image_url,
                    'product_name' => $product->product->name,
                    'product_quantity' => $product->quantity,
                    'product_total' => $product->total,
                    'created_at' => $product->created_at,
                    'user_name' => $order->user->name,
                    'user_mobile_no' => $order->user->mobile_no,
                    'user_email' => $order->user->email,
                    'user_address' => $order->user->address,
                    'details_id' => $product->id

                ]);
            }
        }
        // return $products;
        // return $userOrders;
        return view('front.orders', [
            'userOrders' => $products,
           ]);
    }

    public function deleteDetailsFromOrder($id){
        $user = auth()->user();
        $order = Order::with('order_details.product')
        ->where('user_id', $user->id)
        ->whereHas('order_details', function($q) use($id){
            $q->where('order_details.id', $id);
        })
        ->first();
       OrderDetails::whereId($id)->delete();
       $order->total = $order->order_details->sum('total');
        $order->save();
       return response()->json([
        'message' =>'ok',
      ], 200);
    }
    public function userUpdateProfilePage(){
        $user = auth()->user();
        return view('front.edit-profile', [
            'user' => $user,
           ]);
    }
    public function userUpdateProfile(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'mobile_no' => 'required',
            'address' => 'required',
        ]);
        $user = auth()->user();
        $mobile_no = User::where('mobile_no', $request->mobile_no)
        ->where('id', '<>', $user->id)
        ->first();
        if($mobile_no){
            return response()->json(['message' => 'This mobile number is already exsist'],403 );
        }
        $email = User::where('email', $request->email)
        ->where('id', '<>', $user->id)
        ->first();
        if($email){
            return response()->json(['message' => 'This mobile number is already exsist'],403 );
        }
        $newUser = User::whereId($user->id)->first();
        $newUser->name = $request->name;
        $newUser->email = $request->email;
        $newUser->mobile_no  = $request->mobile_no ;
        $newUser->address  = $request->address ;
        $newUser->type   = '1';
        $newUser->save();
        return response()->json([
            'data' =>$newUser,
        ], 200);
    }
}
