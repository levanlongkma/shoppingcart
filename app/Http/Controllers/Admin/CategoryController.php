<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    use HasFactory;
    public function index() 
    {
        $active = "categories";
        $attributes = request()->all();
        $categories = new Category();
        if (request()->ajax()) {
            $categories = $categories->all();
            include(resource_path('views/categories/data.blade.php'));
        }
        $categories = Category::paginate();
        return view('backend.categories.index', compact('categories', 'active'));
    }
    public function store() {
        $name = request()->input('name');
        // dd($name);
        $slug = Str::slug($name);
        $result = Category::insert([
            'name' => $name,
            'slug' => $slug,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        if ($result) {
            return response()->json([
                'result' => 'success',
            ]);
        }
    }
}
