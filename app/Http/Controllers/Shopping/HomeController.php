<?php

namespace App\Http\Controllers\Shopping;

use App\Http\Controllers\Controller;
use App\Models\Category;
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
        return view('shopping.pages.home',[   
            'slides' => Slide::all(), 
            'categories' => Category::all(), 
            'products' => self::productsDisplayOnHome(Product::with('productImages')->get()), 
            'highestPrice' => DB::select('SELECT price FROM products ORDER BY price DESC LIMIT 1')[0]->price
        ]);
    }
    
    public function productsOnCategory()
    {
        if (request()->ajax()) 
        {
            try 
            {
                if (request()->input('category_id'))
                {
                    if(request()->input('search')) 
                    {
                        $products = Product::with('productImages')
                        ->where([
                            ['category_id', request()->input('category_id')],
                            ['name', 'LIKE', '%'. request()->input('search') .'%']
                        ])
                        ->get();

                        $output = self::productsDisplayOnHome($products);
                        $highestPrice = 
                        Product::where([
                            ['category_id', request()->input('category_id')],
                            ['name', 'LIKE', '%'. request()->input('search') .'%']
                        ])
                        ->select('price')->orderBy('price', 'desc')
                        ->limit(1)->get()[0]->price;
                        
                        return json_encode([
                            'status' => true,
                            'output' => $output,
                            'highestPrice' => $highestPrice
                        ]);
                    }

                    return json_encode([
                        'status' => true,
                        'output' => self::productsDisplayOnHome(Product::with('productImages')->where('category_id', request()->input('category_id'))->get()),
                        'highestPrice' => Product::where('category_id', request()->input('category_id'))->select('price')->orderBy('price', 'desc')->limit(1)->get()[0]->price
                    ]);
                }

                if (request()->input('search')) {
                    return json_encode([
                        'status' => true,
                        'output' => self::productsDisplayOnHome(Product::with('productImages')->where('name', 'LIKE', '%'. request()->input('search') .'%')->get()),
                        'highestPrice' => Product::where('name', 'LIKE', '%'. request()->input('search') .'%')->select('price')->orderBy('price', 'desc')->limit(1)->get()[0]->price,
                    ]);
                }

                return json_encode([
                    'status' => true,
                    'output' => self::productsDisplayOnHome(Product::with('productImages')->get()),
                    'highestPrice' => DB::select('SELECT price FROM products ORDER BY price DESC LIMIT 1')[0]->price
                ]);

            } catch (Exception $e) {
                Log::error($e);
                return json_encode([
                    'status' => false,
                ]);
            }
        }
    }
    
    private static function productsDisplayOnHome($products) {
        if ($products) {
            $output = '';
            foreach ($products as $product) {
                $output .= '
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="'.Storage::url($product->productImages->first()->image).'" alt="" />
                                    <h2>$ '.$product['price'].'</h2>
                                    <p>'.$product['name'].'</p>
                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
                                </div>
                                <div class="product-overlay">
                                    <div class="overlay-content">
                                        <h2>$ '.$product['price'].'</h2>
                                        <p>'.$product['name'].'</p>
                                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
                                    </div>
                                </div>
                        </div>
                        <div class="choose">
                            <ul class="nav nav-pills nav-justified">
                                <li><a href="#"><i class="fa fa-plus-square"></i>Thêm vào wishlist</a></li>
                            </ul>
                        </div>
                    </div>
                </div>';
            }
        }
        return $output;
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

    public function productDetails()
    {
        return view('shopping.pages.shop.product-details');
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
