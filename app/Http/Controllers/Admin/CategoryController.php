<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryValidator;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    use HasFactory;

    
    public function showCreateForm()
    {
        return view('backend.categories.form-create');
    }

    public function create(CategoryValidator $request)
    {
        $attributes = $request->input();
        $slug = Str::slug($attributes['name']);
        $attributes['slug'] = $slug;
        Category::create($attributes);
        
        return redirect()->route('admin.category');
    }

    public function showEditForm($id)
    {
        //$products = DB::select('SELECT * FROM products WHERE id=?', [$id]);
        $categories = Category::where('id',"$id");

        return view('backend.categories.form-edit', compact('categories'));
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
        return redirect()->route('admin.category')->with('alert', 'Updated!');
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
        $categories = Category::where('name', 'LIKE', "%{$search}%")->paginate(5);
        return view('backend.categories.index', compact('categories', 'search', 'active'));
    }

    public function store() {
        dd('hello');
    }

    
}
