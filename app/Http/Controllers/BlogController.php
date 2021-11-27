<?php

namespace App\Http\Controllers;

use App\Cms;
use App\Post;
use App\Category;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function postBlog(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'name' => 'required',
            'text' => 'required',
        
        ]);
        $input = $request->all();
        $blog = Cms::create($input);
        return response()->json($blog);
    }

    public function getBlog(Request $request)
    {
        $blog = Cms::latest()->get();
        return response()->json($blog);
    }

    public function SavingPost(Request $request)
    { 
        $this->validate($request, [
        'name' => 'required',
        'number' => 'required',
        'user_id' => 'required',
        'category_id' => 'required',
        ]);
        $input = $request->all();
        $data = Post::create($input);
        return response()->json($data, 200);
    }
    public function fetchPosts()
    {
        $posts = Category::all();
       return response()->json($posts, 200);
    }
    public function fetchallPosts()
    {
        $data = Post::with('category','users')
        ->latest()
        ->paginate(10);
        return response()->json($data);
    }   
    
    public function DeletePost($id)
    {
        Post::where('id',$id)->first()->delete();
        return "DELETED";
    }

    public function UpdatePost(Request $request , $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'number' => 'required',
            'user_id' => 'required',
            'category_id' => 'required',
            ]);
        $post = Post::find($id);
        $post->name = $request->name;
        $post->number = $request->number;
        $post->category_id = $request->category_id;
        $post->user_id = $request->user_id;
        $post->save();
        return "Saved";
    }
    public function get_single_post_date($id)
    {
        
       $post = Post::find($id);
       return $post;
    }
    public function storeCategory(Request $request)
    {
       $input = $request->all();
       Category::create($input);
       return true;
    }
}
