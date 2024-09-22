<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function product_list()
    {
        $products = Product::where('vendor_id', Auth::id())->get();
        return view('vendor.product.list', compact('products'));
    }

    // Display the form for creating a new product
    public function product_create()
    {
        $categories = Category::where('vendor_id', Auth::id())->get(); // Only show categories belonging to the vendor
        return view('vendor.product.create', compact('categories'));
    }

    // Store the product in the database
    public function product_store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Image validation
        ]);

        // Upload the product image if it exists
        $imagePath = $request->file('image') ? $request->file('image')->store('product_images', 'public') : null;

        // Create the product with the authenticated vendor's ID
        Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'image_url' => $imagePath, // Store image path
            'vendor_id' => Auth::id(), // Store the vendor's ID
        ]);

        // Redirect to the product list with success message
        return redirect()->route('vendor.product.list')->with('success', 'Product created successfully!');
    }


}
