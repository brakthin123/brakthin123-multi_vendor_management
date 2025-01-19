<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function list_page($name)
    {
        // Fetch the vendor
        $vendor = Vendor::where('shop_name', $name)->firstOrFail();

        $products = Product::where('vendor_id', Auth::id())->get();

        return view('user.shop.home', compact('products', 'vendor'));
    }

    public function shoping($name)
    {
        $vendor = Vendor::where('shop_name', $name)->firstOrFail();

        $products = Product::where('vendor_id', Auth::id())->get();

        return view('user.shop.shop' , compact('products', 'vendor'));
    }

}
