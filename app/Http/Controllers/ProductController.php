<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        // Eager load the category relationship to avoid N+1 query problem
        $products = Product::with('category')->get();
        return view('admin.product.index', compact('products'));
    }


    public function create()
    {
        $categories = Category::get();
        return view('admin.product.create', compact('categories'));
    }


    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id', // category_id is required
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'discount' => 'nullable|numeric',
            'image' => 'nullable|image|max:2048',
        ]);

        // Create a new product
        $product = new Product;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->discount = $request->discount;
        $product->category_id = $request->category_id;// Assign category_id here

        // Handle file upload if an image is uploaded
        if ($request->hasFile('image')) {
            $fileName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(('images'), $fileName);
            $product->image = $fileName;
        }

        $product->save();

        // Redirect with a success message
        return redirect()->route('products.index')->with('message', 'Product Added Successfully');
    }

        //delete product
       public function destroy($id){
        $product=Product::find($id);
        $product->delete();
        return redirect()->back()->with('message','product Deleted successfully');
       }
    
       public function edit($id){
        $categories = Category::get();
        $product = Product::findOrFail($id); // Find the product by ID
        return view('admin.product.edit', compact('product','categories'));
}


       public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id', // category_id is required
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'discount' => 'nullable|numeric',
            'image' => 'nullable|image|max:2048',
        ]);

        // Create a new product
        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->discount = $request->discount;
        $product->category_id = $request->category_id;// Assign category_id here

        // Handle file upload if an image is uploaded
        if ($request->hasFile('image')) {
            $fileName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(('images'), $fileName);
            $product->image = $fileName;
        }

        $product->save();
        return redirect()->route('products.index')->with('message', 'Product updated successfully!');
    }
}
