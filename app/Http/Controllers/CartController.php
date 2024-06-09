<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $product = Product::findOrFail($request->input('product_id'));
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $request->input('quantity');
        } else {
            $cart[$product->id] = [
                'name' => $product->name,
                'image_path' => $product->image_path,
                'price' => $product->price,
                'quantity' => $request->input('quantity'),
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Product added to cart!');
    }

    public function destroy($id)
    {
        $cart = session()->get('cart');

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Product removed successfully.');
    }

    public function index()
    {
        $cart = session()->get('cart');
        $totalAmount = 0;

        if ($cart) {
            foreach ($cart as $details) {
                $totalAmount += $details['price'] * $details['quantity'];
            }
        }

        return view('cart', compact('totalAmount'));
    }

    public function update(Request $request, $id)
    {
        $cart = session()->get('cart');

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);

            return redirect()->route('cart.index')->with('success', 'Cart updated successfully.');
        }

        return redirect()->route('cart.index')->with('error', 'Item not found in cart.');
    }
}
