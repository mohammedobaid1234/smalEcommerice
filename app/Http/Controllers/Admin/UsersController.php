<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\Datatables\Datatables;
class UsersController extends Controller{
    public function __construct(){
        $this->middleware(['auth']);
    }
    public function manage(Request $request){
        $data['activePage'] = ['users' => 'users'];
        $data['breadcrumb'] = [
            ['title' => 'Users'],
        ];
        // $data['addRecord'] = ['href' => route('users.create'), 'class' => 'create_item_btn'];
        if ($request->ajax()) {
            $data = User::select('*')->get();
            return Datatables::of($data)
            ->addColumn('action', function ($user) {
                $btn = '';
                $btn .= '<a data-id='. $user->id. ' class="btn btn-sm btn-clean btn-icon edit_item_btn" > <i class="la la-edit"></i></a>';
                $btn .= '<a data-action="destroy" data-id='. $user->id. 'class="btn btn-xs red tooltips" ><i class="fa fa-times" aria-hidden="true"></a>';
                return $btn;
            })
            ->addColumn('index', function($row){
                $btn =view('admin.core.table_index')->with(['row'=>$row])->render();
                return $btn;
            })
            ->rawColumns(['action', 'index'])
            ->filter(function ($query) use ($request) {
                if ($request->has('name') && $request->get('name') != null) {
                    $query->where('name', 'like', "%{$request->get('name')}%");
                }
                if ($request->has('email') && $request->get('email') != null) {
                    $query->where('email', 'like', "%{$request->get('email')}%");
                }
                if ($request->has('created_at') && $request->get('created_at') != null) {
                   $query->WhereCreatedAt($request->get('created_at'));
                }
            })
            ->make(true);
        }
        return view('admin.users.manage', [
            'data' => $data,
        ]);
    }

    public function create(){
        $data['activePage'] = ['users' => 'users'];
        $data['breadcrumb'] = [
            ['title' => "Users Management"],
            ['title' => "Users"],
            ['title' => 'Add User'],
        ];
        $html= view('admin.users.create')->with(['data'=>$data])->render();
        return response()->json(['status' => true, 'code' => 200, 'message' => 'OK', 'html'=>$html ]);
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        $email = User::where('email', $request->email)->first();
        if($email){
            return response()->json(['message' => 'Email is exsist' ], 403);
        }
        $user =new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password =Hash::make($request->password);
        $user->save();
        return response()->json([
            'message' => 'ok',
            'data' => $user
        ]);
    }
    public function edit($id){
        $data['activePage'] = ['users' => 'users'];
        $data['breadcrumb'] = [
            ['title' => "Users Management"],
            ['title' => "Users"],
            ['title' => 'Edit User'],
        ];
        $user = User::whereId($id)->first();
        // return view('admin.users.edit')->with(['data'=>$data, 'user' => $user]);
        $html= view('admin.users.edit')->with(['data'=>$data, 'user' => $user])->render();
        return response()->json(['status' => true, 'code' => 200, 'message' => 'OK','item' =>$user ,'html'=>$html ]);
    }
    public function show($id){
        $user = User::whereId($id)->first();
        $images = $user->getMedia('user-image');
        $images_new  = collect([]);
        foreach($images as $image){
            $new['url'] =  url('/') . '/storage/app/public/' . $image->id . '/' . $image->file_name;
            $new['name'] = $image->file_name;
            $images_new->push($new);
        }

        return response()->json($images_new,200);
    }
    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
        $email = User::where('id', '<>', $id)->where('email', $request->email)->first();
        if($email){
            return response()->json(['message' => 'Email is exsist' ], 403);
        }
        $user = User::whereId($id)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return response()->json([
            'message' => 'ok',
            'data' => $user
        ]);
    }
    public function addImage(Request $request){
        $id = $request->userId;
        $user = User::whereId($id)->first();
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $extension = strtolower($request->file('file')->extension());
            $media_new_name = strtolower(md5(time())) . "." . $extension;
            $collection = "user-image";

            $user->addMediaFromRequest('file')
                ->usingFileName($media_new_name)
                ->usingName($request->file('file')->getClientOriginalName())
                ->toMediaCollection($collection);
            return response()->json(['message' => 'ok']);
        }
    }

    public function removeImage(Request $request, $id){
        $image = \Spatie\MediaLibrary\MediaCollections\Models\Media::where('file_name', $id)->first();
        $image->delete();
        return response()->json(['message' => 'ok']);
    }

}
