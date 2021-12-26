<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryValidator;
use App\Models\Category;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    use HasFactory;

    
    public function showCreateForm()
    {
        $active = "categories";
        return view('backend.categories.form-create', compact('active'));
    }

    public function create(CategoryValidator $request)
    {
        $attributes = $request->all();
        $slug = Str::slug($attributes['name']);
        $attributes['slug'] = $slug;
        Category::create($attributes);
        return redirect()->route('admin.category');
    }

    public function showEditForm($id)
    {
        //$products = DB::select('SELECT * FROM products WHERE id=?', [$id]);
        $active = "categories";
        $categories = Category::where('id',"$id")->first()->toArray();
        // dd($categories);
        return view('backend.categories.form-edit', compact('categories', 'active'));
    }

    public function update(CategoryValidator $request, $id)
    {   
        $attributes = $request->input();
        $slug = Str::slug($attributes['name']);
        $attributes['slug'] = $slug;

        Category::where('id', $id)->update([
            'name'=>$attributes['name'],
            'slug'=>$attributes['slug'],
        ]);
        return redirect()->route('admin.category')->with('success', 'Updated!');
    }

    public function delete($id)
    {
        $category = Category::find($id);

        $category->delete();    

        return redirect()->route('admin.category');
    }
    
    public function index() 
    {
        $active = "categories";
        $attributes = request()->all();
        $search = $attributes['search'] ?? " ";
        $post_categories = PostCategory::paginate(5);
        $categories = Category::where('name', 'LIKE', "%{$search}%")->paginate(5);
        return view('backend.categories.index', compact('categories', 'search', 'active', 'post_categories'));
    }

    
}
