<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Middleware\VendorMiddleware;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function category_create()
    {
        return view('vendor.category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'vendor_id' => Auth::id(),
        ]);

        return redirect()->route('vendor.category.list')->with('success', 'Category created successfully!');
    }

    public function category_list()
    {
        $categories = Category::where('vendor_id', Auth::id())->get();
        return view('vendor.category.list', compact('categories'));
    }

    public function category_edit($id)
    {
        $category = Category::findOrFail($id);
        return view('vendor.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $category = Category::findOrFail($id);
        $category->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('vendor.category.list')->with('success', 'Category updated successfully!');
    }
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('vendor.category.list')->with('success', 'Category deleted successfully!');
    }

}
