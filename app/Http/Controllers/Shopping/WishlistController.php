<?php

namespace App\Http\Controllers\Shopping;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function addToFavorite(Request $request) {
        $params = request()->all();
        $params['user_id'] = Auth::user()->id;
        $request->session()->put('user.id', Auth::user()->id);
        $request->session()->push('user.favorite_product_ids', $params['product_id']);

        // $request->session()->flush();
        $product = Product::where('id', $params['product_id'])->first();
        
        if ($product) {
            return [
                'status' => true,
                'product' => $product
            ];
        }

        return ['status' => false];
    }

    public function removeFromFavorite() {

    }
}
