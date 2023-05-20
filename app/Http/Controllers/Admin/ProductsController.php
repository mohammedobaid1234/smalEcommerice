<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Language;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;

class ProductsController extends Controller{
    public function __construct(){
        $this->middleware(['auth','check:2'])->except(['index','showProduct']);
    }

    public function index(Request $request){
        $products = Product::paginate($request->page_size ?? 10);
        return response()->json([
            'data' => $products
        ]);
    }
    public function showProduct($id){
        $product = Product::whereId($id)->first();
        return response()->json([
            'data' => $product
        ]);
    }
    public function manage(Request $request){
        $data['activePage'] = ['products' => 'products'];
        $data['breadcrumb'] = [
            ['title' => 'products'],
        ];
        $data['addRecord'] = ['href' => route('products.create'), 'class' => 'create_item_btn'];
        if ($request->ajax()) {
            $data  = Product::orderBy('id', 'asc')->get();
            return Datatables::of($data)
            ->editColumn('type',function($row){
                $btn =view('admin.core.status_label')->with(['row'=>$row])->render();
                return $btn;
            })->setRowId(function ($row) {
                return 'tr-'.$row->id;
            })->editColumn('image',function($row){
                return '<a href="'.$row->image_url.'" target="_blank"><img src="'.$row->image_url.'" width="50px" height="50px" style="border-radius: 10% !important;"></a>';
            })->escapeColumns([])
            ->addColumn('index', function($row){
                $btn =view('admin.core.table_index')->with(['row'=>$row])->render();
                return $btn;
            })
            ->addColumn('action', function ($user) {
                $btn = '';
                $btn .= '<a data-id='. $user->id. ' \' href ='. route('products.edit', $user->id) .' \'class="btn btn-sm btn-clean btn-icon edit_item_btn" > <i class="la la-edit"></i></a>';
                $btn .= '<a data-action="destroy" data-id='. $user->id. 'class="btn btn-xs red tooltips" ><i class="fa fa-times" aria-hidden="true"></a>';
                return $btn;
            })->rawColumns(['action','index'])
            ->filter(function ($query) use ($request) {
                if ($request->has('name') && $request->get('name') != null) {
                    $query->where('name', 'like', "%{$request->get('name')}%");
                }
                if ($request->has('created_at') && $request->get('created_at') != null) {
                   $query->WhereCreatedAt($request->get('created_at'));
                }
            })
            ->make(true);
        }
        return view('admin.products.manage', [
            'data' => $data
        ]);
    }

    public function create(){
        $data['activePage'] = ['products' => 'products'];
        $data['breadcrumb'] = [
            ['title' => "Products Management"],
            ['title' => "Products"],
            ['title' => 'Add Product'],
        ];
        return view('admin.products.create',[
            'data' => $data,
        ]);
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'description' => 'required',
            'price' => 'required'
        ]);

        $item =new Product();
        $item->name = $request->name;
        $item->type = $request->type;
        $item->description = $request->description;
        $item->price = $request->price;
        $item->is_new = $request->is_new;
        $item->save();
        return response()->json([
            'message' => 'ok',
            'data' => $item
        ]);
    }
    public function edit($id){

        $data['activePage'] = ['products' => 'products'];
        $data['breadcrumb'] = [
            ['title' => "Products Management"],
            ['title' => "Products"],
            ['title' => 'Edit Product'],
        ];
        $product = Product::whereId($id)->first();
        return view('admin.products.edit',[
            'data' => $data,
            'product' => $product
        ]);

    }
    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'description' => 'required',
            'price' => 'required'

        ]);
        $product = Product::whereId($id)->first();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->type = $request->type;
        $product->price = $request->price;
        $product->is_new = $request->is_new;
        $product->save();
        return response()->json([
            'message' => 'ok',
            'data' => $product
        ]);
    }
    public function show($id){
        $item = Product::whereId($id)->first();
        $images_new  = collect([]);
        $new['url'] =  $item->image_url;
        $new['name'] = $item->image;
        $images_new->push($new);
        return response()->json($images_new,200);
    }

    public function addImage(Request $request){
        $id = $request->userId;
        $item = Product::whereId($id)->first();
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $item->image !== null ?Storage::disk('uploads')->delete($item->image): '';
            $uploadedFile = $request->file('file');
            $image = $uploadedFile->store('/', 'uploads');
            $item->image = $image;
            $item->save();
            return response()->json(['message' => 'ok']);
        }
    }
    public function removeImage(Request $request, $id){
        $item = Product::where('image',$id)->first();
        $item->image !== null ?Storage::disk('public')->delete($item->image): '';
        $item->image = null;
        $item->save();
        return response()->json(['message' => 'ok']);
    }
    public function destroy($id)
    {


        $product = Product::findOrFail($id);
        $product->delete();

        $product->image  ? unlink(public_path('uploads/' . $product->image)) : '';

        return response()->json(['message' => 'ok']);

    }
    public function manageOrders(Request $request){
        $data['activePage'] = ['orders' => 'orders'];
        $data['breadcrumb'] = [
            ['title' => 'orders'],
        ];
        // $data['addRecord'] = ['href' => route('orders.create'), 'class' => 'create_item_btn'];
        if ($request->ajax()) {
            $data = Order::with('order_details.product','user')->get();

            return Datatables::of($data)
            ->setRowId(function ($row) {
                return 'tr-'.$row->id;
            })->escapeColumns([])
            // ->addColumn('index', function($row){
            //     $btn =view('admin.core.table_index')->with(['row'=>$row])->render();
            //     return $btn;
            // })
            ->addColumn('action', function ($user) {
                $btn = '';
                $btn .= '<a data-action="destroy" data-id="'. $user->id. '" class="btn btn-xs red tooltips" ><i class="fa fa-times" aria-hidden="true"></a>';
                return $btn;
            })->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.orders.manage', [
            'data' => $data
        ]);
    }

    public function deleteOrder($id){
        $product = Order::findOrFail($id);
        $product->delete();
        return response()->json(['message' => 'ok']);


    }



}
