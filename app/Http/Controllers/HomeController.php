<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::all(); 
        $categories = Category::all(); 

        $cartItems = []; // Initialize cart items array
        if (Auth::check()) {
            // If the user is authenticated, retrieve their cart items
            $userId = Auth::id();
            $cartItems = Cart::where('user_id', $userId)->with('product')->get(); // Eager load products
        }

        return view('home.index', compact('products', 'cartItems', 'categories')); // Pass products and cart items to the view

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
    
    public function decrease_cart(Request $request, $id)
    {
        $userId = Auth::id(); // Get authenticated user ID
        
        // Check if product exists in cart
        $existingCartItem = Cart::where('user_id', $userId)->where('product_id', $id)->first();
        
        if ($existingCartItem) {
            if ($existingCartItem->quantity > 1) {
                // Decrease quantity if more than 1
                $existingCartItem->quantity -= 1;
                $existingCartItem->save();
                return redirect()->back()->with('message', 'Product quantity decreased in the cart.');
            } else {
                // Remove the product from the cart if the quantity is 1 or less
                $existingCartItem->delete();
                return redirect()->back()->with('message', 'Product removed from the cart.');
            }
        } else {
            return redirect()->back()->with('error', 'Product not found in the cart.');
        }
    }

    public function cash_order()
    {
        $products=Product::all();
        return view('home.index',compact('products'));
    }
}
