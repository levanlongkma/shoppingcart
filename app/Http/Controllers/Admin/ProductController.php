<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductValidator;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() 
    {
        // $products = Product::all();

        //return view(, compact('products'));
        return view('backend.products.index',['products'=>DB::table('products')->paginate(4)]);
    }

    public function showCreateForm()
    {
        return view('backend.products.form-create');
    }

    public function create(ProductValidator $request)
    {
        $attributes = $request->input();
        $file = $request->file('product_image');
        $attributes['product_image'] = $file->getClientOriginalName();
        $file->storeAs('products',$file->getClientOriginalName(),'product_image');

        $products = Product::create($attributes);
        $validated = $request->validated();

        return redirect()->route('admin.product');
    }

    public function showEditForm($id)
    {
        //$products = DB::select('SELECT * FROM products WHERE id=?', [$id]);
        $products = Product::all()->where('id',"$id");

        return view('backend.products.form-edit', compact('products'));
    }

    public function update(Request $request, $id)
    {   
        $name = $request->input('name');
        $description = $request->input('description');
        $slug = $request->input('slug');
        $product_image = $request->file('product_image');
        $quantity = $request->input('quantity');

        //DB::update('UPDATE products SET name = ?, description=?, slug=?, product_image=?, quantity=? WHERE id=? ', ["$name", "$description","$slug","$product_image","$quantity","$id"]);
        Product::where('id', $id)->update([
            'name'=>"$name",
            'description'=>"$description",
            'slug'=>"$slug",
            'product_image'=>"$product_image",
            'quantity'=>"$quantity",
        ]);
        
        return redirect()->route('admin.product');
    }

    public function show($id)
    {
        $products = Product::all()->where('id',"$id");

        return view('backend.products.show', compact('products'));
    }

    public function delete($id)
    {
        $product = Product::find($id);

        $product->delete();    

        return redirect()->route('admin.product');
    }
    
    public function search(Request $request)
    {
        $search = $request->input('search');

        $products = Product::query()->where('name', 'LIKE', "%{$search}%")->get();

        return view('backend.products.index',['products'=>DB::table('products')->paginate(4)]);
    }
}
