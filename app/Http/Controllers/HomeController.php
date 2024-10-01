<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $products=Product::all();
        return view('home.index',compact('products'));
    }

    public function product_details()
    {
        $products=Product::all();
        return view('home.index',compact('products'));
    }
    public function add_cart(Request $request, $id)
    {
        $userId = Auth::id(); // Assuming you're using authentication
            // Check if product already in cart
        $existingCartItem = Cart::where('user_id', $userId)->where('product_id', $id)->first();
        
        if ($existingCartItem) {
            // Increase quantity if already exists
            $existingCartItem->quantity += 1;
            $existingCartItem->save();
        } else {
            // Create new cart item
            Cart::create([
                'user_id' => $userId,
                'product_id' => $id,
                'quantity' => 1
            ]);
        }
        return redirect()->back()->with('message', 'Product added to cart successfully');
    }
    
    public function show_cart()
    {
        $products=Product::all();
        return view('home.index',compact('products'));
    }
    public function remove_cart()
    {
        $products=Product::all();
        return view('home.index',compact('products'));
    }
    public function cash_order()
    {
        $products=Product::all();
        return view('home.index',compact('products'));
    }
}
