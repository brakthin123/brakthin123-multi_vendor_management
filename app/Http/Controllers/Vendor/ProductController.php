<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

    public function product_edit($id)
    {
        // Fetch the product by its ID
        $product = Product::findOrFail($id);

        // Fetch the list of categories to show in the category dropdown
        $categories = Category::all();

        // Return the view for editing the product with the product and categories data
        return view('vendor.product.edit', compact('product', 'categories'));
    }


    public function product_update(Request $request, $id)
    {
        // Find the product by ID
        $product = Product::findOrFail($id);

        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Image validation (optional)
        ]);

        // Check if a new image was uploaded
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($product->image_url) {
                Storage::disk('public')->delete($product->image_url);
            }

            // Store the new image and update the image path
            $product->image_url = $request->file('image')->store('product_images', 'public');
        }

        // Update the product details using mass assignment
        $product->update($request->only('name', 'category_id', 'price', 'quantity'));

        // Redirect to the product list with a success message
        return redirect()->route('vendor.product.list')->with('success', 'Product updated successfully!');
    }

    public function product_destroy($id)
    {
        // Find the product by ID
        $product = Product::findOrFail($id);

        // Delete the product's image if it exists
        if ($product->image_url) {
            Storage::disk('public')->delete($product->image_url);
        }

        // Delete the product
        $product->delete();

        // Redirect to the product list with a success message
        return redirect()->route('vendor.product.list')->with('success', 'Product deleted successfully!');
    }

    public function list_page(){
        $products = Product::where('vendor_id', Auth::id())->get();
        return view('user/shop/shop', compact('products'));
    }

}
