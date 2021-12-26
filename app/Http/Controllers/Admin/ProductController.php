<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductValidator;
use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function showCreateForm()
    {
        $active = "products";
        $categories = Category::get();

        return view('backend.products.form-create', compact('categories', 'active'));
    }

    public function create(ProductValidator $request)
    {
        $params = $request->all();
        $params['slug'] = Str::slug($params['name']);
        
        if (data_get($params, 'image')) {
            $file = $params['image'];
            $params['image'] = Storage::putFileAs('images', $file, $file->getClientOriginalName());
        
        }
        Product::create($params);
        return redirect()->route('admin.product');
    }

    public function showEditForm($id)
    {
        $active = "products";
        $products = Product::find($id);

        return view('backend.products.form-edit', compact('products', 'active'));
    }

    public function update(ProductValidator $request, $id)
    {   
        $params = $request->all();
        $slug = Str::slug($params['name']);
        $params['slug'] = $slug;
        $file = $request->file('image');
        $path = Storage::putFileAs('images', $file, $file->getClientOriginalName());
        $params['image'] = $path;
        
        Product::where('id', $id)->update([
            'name' => $params['name'],
            'description' => $params['description'],
            'slug' => $params['slug'],
            'image' => $params['image'],
            'quantity' => $params['quantity'],
        ]);
        
        return redirect()->route('admin.product');
    }

    public function delete($id)
    {
        Product::where('id', $id)->delete();

        return redirect()->route('admin.product');
    }
    
    public function index()
    {
        $active = "products";
        $params = request()->all();
        $search = $params['search'] ?? '';
        $products = Product::where('name', 'LIKE', "%{$search}%")->paginate(10);

        return view('backend.products.index', compact('products', 'search', 'active'));
    }
}
