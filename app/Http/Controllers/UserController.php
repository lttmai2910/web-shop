<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

require_once('Config.php');

class UserController extends Controller 
{

    public function index(): Response
    {
        $user = User::latest()->paginate(10);
        return Inertia::render('Admin/User/Index', ['user'=>$user]);
    }

    public function destroy($id): RedirectResponse
    {
        // Tìm người dùng
        $user = User::findOrFail($id);
        
        // Lấy ID của người dùng mặc định hoặc một giá trị khác phù hợp
        $defaultUserId = '0'; 
        
        // Cập nhật id_user của các bài viết liên quan thành giá trị mặc định
        Post::where('id_user', $id)->update(['id_user' => $defaultUserId]);
        $images = DB::select('select image from users where id = :id', ['id' => $id]);
        foreach ($images as $image)
        {
            File::delete(public_path(path_delete_admin.$image->image));
        }
        $user->delete();
    
        return Redirect::route('user.index');
    }

    public function create()
    {
        return Inertia::render('Admin/User/Create');
    }

    public function store(Request $request): RedirectResponse
    {
        $filename = time().'.'.$request->image->extension();
        $request->image->move(public_path(path_admin), $filename);  

        User::create([
            'name' => $request->name,
            'birthday' => $request->birthday,
            'address' => $request->address,
            'gender' => $request->gender,
            'image' => $filename,
            'role' => $request->role,
            'status' => $request->status,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return Redirect::route('user.index');
    }

    public function edit(User $user)
    {
        return Inertia::render('Admin/User/Edit', ['user'=>$user]);
    }

    public function update($id, Request $request): RedirectResponse
    {
        if($request->image){
            $images = DB::select('select image from users where id = :id', ['id' => $id]);
            foreach ($images as $image)
            {
                File::delete(public_path(path_delete_admin.$image->image));
            }
            $filename = time().".".$request->image->extension();
            $request->image->move(public_path(path_admin), $filename);
    
            User::find($id)->update([
                'name' => $request->name,
                'birthday' => $request->birthday,
                'address' => $request->address,
                'gender' => $request->gender,
                'image' => $filename,
                'role' => $request->role,
                'status' => $request->status,
            ]);
        }
        else
        {
            User::find($id)->update([
                'name' => $request->name,
                'birthday' => $request->birthday,
                'address' => $request->address,
                'gender' => $request->gender,
                'role' => $request->role,
                'status' => $request->status,
            ]);
        }
        return Redirect::route('user.index');
    }
}
