<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function viewVendorProducts($vendorId)
    {
        // Find the vendor by their ID
        $vendor = User::find($vendorId);

        if (!$vendor || $vendor->role !== 'vendor') {
            abort(404, 'Vendor not found');
        }

        // Fetch the products for this vendor
        $products = Product::where('vendor_id', $vendorId)->get();

        // Return the view to display products for this vendor
        return view('customer.vendor_products', compact('vendor', 'products'));
    }
}

