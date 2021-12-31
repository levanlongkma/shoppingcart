<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryValidator;
use App\Http\Requests\Admin\UpdateCategoryValidator;
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
        $categories = Category::paginate();
        return view('backend.categories.index', compact('categories', 'active'));
    }

    public function store(CategoryValidator $request)
    {
        $params = $request->all();
        $slug = Str::slug(data_get($params, 'name'));
        $newCategory = Category::create([
            'name' => $params['name'],
            'slug' => $slug
        ]);

        if ($newCategory) {
            Session::flash('messages_success', 'Great! A Category Is Added');
            return ['status' => true];
        }

        return ['status' => false];
    }

    public function update(CategoryValidator $request) {
        $params = $request->all();
        dd($params);
        $slug = Str::slug(data_get($params, 'name'));
        $updatedCategory = Category::where('id', data_get($params, 'id'))->update([
            'name' => $params['name'],
            'slug' => $slug,
            'updated_at' => now()
        ]);
        if ($updatedCategory) {
            Session::flash('message_success', 'The category is updated man');
            return ['status' => true];
        }
        return ['status' => false];
    }
}
