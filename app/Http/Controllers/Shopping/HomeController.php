<?php

namespace App\Http\Controllers\Shopping;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Favorite;
use App\Models\Product;
use App\Models\Slide;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{

    
    public function home()
    {
        $params = request()->all();
        $products = $this->getProductsList($params);
        $userFavoriteItems = null;
        
        if(isset(auth()->user()->id)) {
            $userFavoriteItems = Favorite::with('favoriteProducts')->where('user_id', auth()->user()->id)->get();
        }
        
        if (data_get($params, 'category')) {
            $categoryName = Category::where('slug', $params['category'])->first()->name;
        }
        else {
            $categoryName = 'Tất cả sản phẩm';
        }

        return view('shopping.pages.home',[   
            'slides' => Slide::all(), 
            'categories' => Category::all(), 
            'categoryName' => $categoryName, 
            'userFavoriteItems' => $userFavoriteItems,
            'products' => $products,
            'highestPrice' => DB::select('SELECT price FROM products ORDER BY price DESC LIMIT 1')[0]->price
        ]);
    }

    protected function getProductsList($params) {
        if (data_get($params, 'category')) {
            $query = Product::with('category', 'productImages')
            ->whereHas ('category', function ($query) {
                $query->where ('slug', request()->category);
            });
        }
        else {
            $query = Product::with('productImages');
        }

        if (data_get($params, 'search')) {
            $query->where('name', 'LIKE', '%' .$params['search']. '%');
        }

        if (data_get($params, 'price-from') && data_get($params, 'price-to')) {
            $query->whereBetween('price', [$params['price-from'], $params['price-to']]);
        }   
        else if (data_get($params, 'price-from') && ! data_get($params, 'price-to')) {
            $query->where('price', '>=' , $params['price-from']);
        }
        else if (data_get($params, 'price-to')) {
            $query->where('price', '<=' , $params['price-to']);
        }

        return $query->orderBy('id', 'desc')->paginate(20);
    }

    public function blogList()
    {
        return view('shopping.pages.blog.blog-list');
    }

    public function blogSingle()
    {
        return view('shopping.pages.blog.blog-single');

    }

    public function products()
    {
        return view('shopping.pages.shop.products');
    }

    public function productDetails(Product $product)
    {
        return view('shopping.pages.shop.product-details', [
            'product' => $product,
            'category' => Category::where('id', $product->category_id)->firstOrFail(),
            'categories' => Category::all(), 
            'highestPrice' => DB::select('SELECT price FROM products ORDER BY price DESC LIMIT 1')[0]->price
        ]);
    }

    public function Checkout()
    {
        return view('shopping.pages.shop.checkout');
    }

    public function Cart()
    {
        return view('shopping.pages.shop.cart');

    }

    public function Login()
    {
        return view('shopping.pages.shop.login');

    }

    public function ContactUs()
    {
        return view('shopping.pages.contact_us.contact-us');
    }
}
