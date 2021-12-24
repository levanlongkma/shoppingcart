<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    public function posts() 
    {
        $active = "posts";
        $posts = Post::with('category')->paginate(3);
        return view('backend.posts.index', compact(['active', 'posts']));
    }

    public function create(){
        $categories = PostCategory::all();
        return view('backend.posts.create', compact(['categories']));
    }

    public function store() 
    {
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
            'body' => request()->input('body')
        ]);
        return redirect('/admin/posts')->with('success', 'Create a post successfully');
    }

    public function edit(Post $post) {
        $categories = PostCategory::all();
        return view('backend.posts.edit', ['categories' => $categories, 'post' => $post]);
    }

    public function update(Post $post) 
    {
        request()->validate([
            'post_category_id' => ['required', 'numeric'],
            'title' => ['required', Rule::unique('posts','title')->ignore($post)],
            'description' => 'required',
            'body' => 'required',
        ]);
        Post::where('id', $post->id)->update([
            'post_category_id' => request()->input('post_category_id'),
            'title' => request()->input('title'),
            'description' => request()->input('description'),
            'body' => request()->input('body')
        ]);
        return redirect('/admin/posts')->with('success', 'Update a post successfully');
    }

    public function delete(Post $post) {
        Post::where('id', $post->id)->delete();
        return redirect('/admin/posts')->with('success', 'Delete a post successfully');
    }
}
