<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function posts() 
    {
        $active = "posts";
        $posts = Post::with('category')->paginate(10);
        return view('backend.posts.index', compact('active', 'posts'));
    }

    public function create(){
        $categories = PostCategory::all();
        return view('backend.posts.create', compact('categories'));
    }

    public function store() {
        request()->validate([
            'post_category_id' => ['required', 'numeric'],
            'title' => ['required',' unique:posts,title'],
            'description' => 'required',
            'body' => 'required',
        ]);
        Post::create([
            'post_category_id' => request()->input('post_category_id'),
            'title' => request()->input('title'),
            'description' => request()->input('description'),
            'body' => request()->input('body'),
            'excerpt' => Str::limit(request()->input('body'), 10)
        ]);
        return redirect('/admin/posts')->with('success', 'Create a post successfully');
    }
}
