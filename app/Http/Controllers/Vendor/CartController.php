<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.cart.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Check if the user is logged in
    if (!auth()->check()) {
        return redirect()->route('register')->with('error', 'You need to register or log in to add items to the cart.');
    }

    // Validate the incoming request
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1',
    ]);

    // Add or update the cart item
    Cart::updateOrCreate(
        [
            'user_id' => auth()->id(),
            'product_id' => $request->product_id,
        ],
        [
            'quantity' => DB::raw("quantity + {$request->quantity}"),
        ]
    );

    return redirect()->back()->with('success', 'Item added to cart!');
}



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
