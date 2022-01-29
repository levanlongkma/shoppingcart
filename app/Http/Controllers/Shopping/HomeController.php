<?php

namespace App\Http\Controllers\Shopping;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\District;
use App\Models\Favorite;
use App\Models\Product;
use App\Models\Slide;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        $highestPrice = DB::select('SELECT price FROM products ORDER BY price DESC LIMIT 1')[0]->price;
        if (! $highestPrice) {
            $highestPrice = 5000000;
        }
        return view('shopping.pages.home',[   
            'slides' => Slide::all(), 
            'categories' => Category::all(), 
            'categoryName' => $categoryName, 
            'userFavoriteItems' => $userFavoriteItems,
            'products' => $products,
            'highestPrice' => $highestPrice
        ]);
    }
    
    public function addToCart($id)
    {
        $product = Product::find($id);
        $product_image = Product::find($id)->productImages()->first();
        
        $cart = session()->get('cart');
        

        $cart[$id] = [
            "id" => $product->id,
            "name" => $product->name,
            "quantity" => 1,
            "price" => $product->price,
            "image"=> $product_image,
        ];

        session()->put('cart', $cart);
        session()->flash('success_add', "Đã thêm sản phẩm vào giỏ hàng của bạn");
        return redirect()->back();
    }

    public function update(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);

            session()->flash('success', 'Đã cập nhật giỏ hàng thành công');
        }
    }

    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');

            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Đã xóa 1 sản phẩm khỏi giỏ hàng!');
        }
    }

    public function productsOnCategory($id)
    {
        try {
            $products = Product::where('category_id', $id)->get();
            return [
                'status' => true,
                'products' => $products
            ];
        } catch (Exception $e) {
            Log::error($e);
            return [
                'status' => false,
            ];
        }
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
        $userFavoriteItems = null;
        
        if(isset(auth()->user()->id)) {
            $userFavoriteItems = Favorite::with('favoriteProducts')->where('user_id', auth()->user()->id)->get();
        }

        return view('shopping.pages.blog.blog-list', compact(['userFavoriteItems']));
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
        $userFavoriteItems = null;
        
        if(isset(auth()->user()->id)) {
            $userFavoriteItems = Favorite::with('favoriteProducts')->where('user_id', auth()->user()->id)->get();
        }

        return view('shopping.pages.shop.product-details', [
            'product' => $product,
            'category' => Category::where('id', $product->category_id)->firstOrFail(),
            'categories' => Category::all(), 
            'highestPrice' => DB::select('SELECT price FROM products ORDER BY price DESC LIMIT 1')[0]->price,
            'userFavoriteItems' => $userFavoriteItems
        ]);
    }

    public function Checkout(Request $request)
    {
            if(count(session('cart')) > 0 ){

                if(isset(auth()->user()->id)) {
                    $userFavoriteItems = Favorite::with('favoriteProducts')->where('user_id', auth()->user()->id)->get();
                }
                
                $cities = City::all();

                return view('shopping.pages.shop.checkout', compact(['cities', 'userFavoriteItems']));
            } else {

                return redirect()->back()->with(['error_cart'=>'Không có sản phẩm nào để thanh toán']);
            }
    }

    public function Cart()
    {
        $userFavoriteItems = null;
        
        if(isset(auth()->user()->id)) {
            $userFavoriteItems = Favorite::with('favoriteProducts')->where('user_id', auth()->user()->id)->get();
        }
        return view('shopping.pages.shop.cart', compact('userFavoriteItems'));
    }

    public function Login()
    {
        $userFavoriteItems = null;
        
        if(isset(auth()->user()->id)) {
            $userFavoriteItems = Favorite::with('favoriteProducts')->where('user_id', auth()->user()->id)->get();
        }
        return view('shopping.pages.shop.login',compact('userFavoriteItems'));

    }

    public function ContactUs()
    {
        $userFavoriteItems = null;
        
        if(isset(auth()->user()->id)) {
            $userFavoriteItems = Favorite::with('favoriteProducts')->where('user_id', auth()->user()->id)->get();
        }
        return view('shopping.pages.contact_us.contact-us', compact(['userFavoriteItems']));
    }
}
