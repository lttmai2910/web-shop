<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

require_once('Config.php');

class PostController extends Controller 
{

    public function index(): Response
    {
        $post = Post::latest()->paginate(10);
        return Inertia::render('Admin/Post/Index', ['post'=>$post]);
    }

    public function destroy($id): RedirectResponse
    {
        $images = DB::select('select image from posts where id = :id', ['id' => $id]);
        foreach ($images as $image)
        {
            File::delete(public_path(path_delete_post.$image->image));
        }
        Post::find($id)->delete();
        return Redirect::route('post.index');
    }
    

    public function create()
    {
        return Inertia::render('Admin/Post/Create'); 
    }

    public function store(Request $request): RedirectResponse
    {
        
        $filename = time().'.'.$request->image->extension();
        $request->image->move(public_path(path_post), $filename);  

        Post::create([
            'id_user' => $request->id_user,
            'title' => $request->title,
            'body' => $request->body,
            'image' => $filename,
            'status' => $request->status,
        ]);
        return Redirect::route('post.index');
    }

    public function edit(Post $post)
    {
        return Inertia::render('Admin/Post/Edit', ['post'=>$post]);
    }

    public function update($id, Request $request): RedirectResponse
    {
        if($request->image){
            $images = DB::select('select image from posts where id = :id', ['id' => $id]);
            foreach ($images as $image)
            {
                File::delete(public_path(path_delete_post.$image->image));
            }
            $filename = time().".".$request->image->extension();
            $request->image->move(public_path(path_post), $filename);
    
            Post::find($id)->update([
                'id_user' => $request->id_user,
                'title' => $request->title,
                'body' => $request->body,
                'image' => $filename,
                'status' => $request->status,
            ]);
        }
        else
        {
            Post::find($id)->update([
                'id_user' => $request->id_user,
                'title' => $request->title,
                'body' => $request->body,
                'status' => $request->status,
            ]);
            
        }
        return Redirect::route('post.index');
    }

    public function post(): Response
    {
        $post = Post::with('user')->where('status', 1)->latest()->paginate(12);
        return Inertia::render('Public/Post/Index', ['posts' => $post]);
    }

    public function show($id): Response
    {
        $post = Post::with('user')->findOrFail($id);
        
        $relatedPosts = Post::where('id_user', $post->id_user)
                            ->where('id', '!=', $post->id)
                            ->where('status', 1)
                            ->limit(3)
                            ->get();

        return Inertia::render('Public/Post/PostItem', [
            'post' => $post,
            'relatedPosts' => $relatedPosts,
        ]);
    }

}   

