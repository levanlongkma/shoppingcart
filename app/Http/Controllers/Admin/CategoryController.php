<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryValidator;
use App\Models\Category;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    use HasFactory;

    public function categories() 
    {
        return view('backend.categories.index',['categories'=>DB::table('categories')->paginate(5)]);
    }

    public function showCreateForm()
    {
        return view('backend.categories.form-create');
    }

    public function create(CategoryValidator $request)
    {
        $attributes = $request->input();

        $products = Category::create($attributes);
        $validated = $request->validated();

        return redirect()->route('admin.category');
    }

    public function showEditForm($id)
    {
        //$products = DB::select('SELECT * FROM products WHERE id=?', [$id]);
        $categories = Category::all()->where('id',"$id");

        return view('backend.categories.form-edit', compact('categories'));
    }

    public function update(Request $request, $id)
    {   
        $name = $request->input('name');
        $slug = $request->input('slug');

        Category::where('id', $id)->update([
            'name'=>"$name",
            'slug'=>"$slug",
        ]);
        return redirect()->route('admin.category')->with('alert', 'Updated!');
    }

    public function delete($id)
    {
        $category = Category::find($id);

        $category->delete();    

        return redirect()->route('admin.category');
    }
    
    public function search(Request $request)
    {
        $search = $request->input('search');

        $categories = Category::query()->where('name', 'LIKE', "%{$search}%")->get();

        return view('backend.categories.index', compact('categories'));
    }
}
