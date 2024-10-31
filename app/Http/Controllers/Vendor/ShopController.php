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

        // Fetch the products for that vendor
        // $products = Product::where('vendor_id', Auth::user()->vendor->id)->get();
        $products = Product::where('vendor_id', Auth::id())->get();

        // dd($products);

        // Pass products to the view
        return view('user.shop.home', compact('products'));
    }

    public function shoping($name)
    {
        // Fetch the vendor based on the shop name
        $vendor = Vendor::where('shop_name', $name)->firstOrFail();

        // Retrieve products for the specific vendor
        $products = Product::where('vendor_id', $vendor->id)->get();

        // Return the view for this vendor's shop
        return view('', compact('vendor', 'products')); // Passing both vendor and products
    }

}
