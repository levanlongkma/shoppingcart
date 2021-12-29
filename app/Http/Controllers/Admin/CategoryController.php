<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryValidator;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
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

    public function store(CategoryValidator $request)
    {
        $params = $request->all();
        $slug = Str::slug(data_get($params, 'name'));
        $result = Category::create([
            'name' => $params['name'],
            'slug' => $slug
        ]);

        if ($result) {
            Session::flash('messages_success', 'Tao thanh cong');
            
            return ['status' => true];
        }

        return ['status' => false];
    }
}
