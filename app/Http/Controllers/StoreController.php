<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;

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

    public function edit($id): View
    {
        $product = Product::find($id);
        if ($product) {
            return view('store.edit', ['product' => $product]);
        } else {
            // Handle the case where the product doesn't exist
            return redirect()->back()->withErrors('Product not found.');
        }
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
            'price' => ['required', 'regex:/^\d+(\.\d{1,2})?$/'],
            'stock_saldo' => 'required|string|max:999'
        ]);

        Log::info('Validated data:', $validated);

        // Assign values to product attributes
        $product->name = $validated['name'];
        $product->image_path = $validated['image_path'];
        $product->description = $validated['description'];
        $product->price = $validated['price'];
        $product->stock_saldo = $validated['stock_saldo'];

        // Save the product
        if ($product->save()) {
            Log::info('Product saved successfully.');
        } else {
            Log::error('Product could not be saved.');
        }

        // Redirect to the index route for the products
        return redirect()->route('store.index')->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->back()->with('message', 'Product deleted!');
    }
}
