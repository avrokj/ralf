<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StoreController extends Controller
{
    public function index()
    {
        $products = Product::get();

        $cart = session()->get('cart');
        if ($cart == null)
            $cart = [];

        return view('store.index')->with('products', $products)->with('cart', $cart);
    }

    public function addToCart(Request $request)
    {
        session()->put('cart', $request->post('cart'));

        return response()->json([
            'status' => 'added'
        ]);
    }

    public function edit(Product $product): View
    {
        return view('store.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image_path' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => ['required', 'regex:/^\d+(,\d$|,\d{2})?$/i'],
            'stock_saldo' => 'required|string|max:45'
        ]);

        // Update the product with validated data
        $product->update($validated);

        // Check for errors
        if ($product->errors()->any()) {
            // Handle errors, such as redirecting back with errors
            return redirect()->back()->withErrors($product->errors())->withInput();
        }

        // Redirect to the show route for the product
        return redirect()->route('products.show', $product);
    }
}
