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
        // dd($request->all());
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
        $data = Post::with('category','users')->get();
        return response()->json($data);
    }
}
