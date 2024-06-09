<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductsController extends Controller
{
    public function showCartTable()
    {
        $products = Product::all();

        return view('cart', compact('products'));
    }


    public function addToCart($id, Request $request)
    {
        $product = Product::find($id);

        if (!$product) {
            abort(404);
        }

        $quantity = $request->input('quantity');

        $cart = session()->get('cart');

        if (!$cart) {
            $cart = [
                $id => [
                    "name" => $product->name,
                    "quantity" => $quantity,
                    "price" => $product->price,
                    "photo" => $product->image_path
                ]
            ];

            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity; // Correctly increment the quantity
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => $quantity,
                "price" => $product->price,
                "photo" => $product->image_path
            ];
        }

        session()->put('cart', $cart);

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Product added to cart successfully!']);
        }

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }


    public function removeCartItem(Request $request)
    {
        if ($request->input('id')) {

            $cart = session()->get('cart');

            if (isset($cart[$request->input('id')])) {

                unset($cart[$request->input('id')]);

                session()->put('cart', $cart);
            }

            session()->flash('success', 'Product removed successfully');
        }
    }


    public function clearCart()
    {
        session()->forget('cart');
        return redirect()->back();
    }

    public function showProducts()
    {
        $products = Product::all();
        return view('welcome', compact('products'));
    }
}
