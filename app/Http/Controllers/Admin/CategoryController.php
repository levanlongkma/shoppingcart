<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoryController extends Controller
{
    use HasFactory;
    public function index() 
    {
        $active = "categories";
        $attributes = request()->all();
        $search = $attributes['search'] ?? " ";
        $categories = Category::where('name', 'LIKE', "%{$search}%")->paginate(5);
        return view('backend.categories.index', compact('categories', 'search', 'active'));
    }
    public function store() {
        
    }
}
