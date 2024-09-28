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
        return view('admin.product.create');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
        ]);

        // Create a new product
        $product = new Product;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;

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

    // add products
    // public function add_product(Request $request){
    //     $image = $request->image;
    //     $image_name = time() . '.' . $image->getClientOriginalExtension();
    //     $request->image->move('product', $image_name);
    
    //     DB::table('products')->insert([
    //         'title' => $request->title,
    //         'description' => $request->description,
    //         'price' => $request->price,
    //         'quantity' => $request->quantity,
    //         'discount_price' => $request->discount_price,
    //         'category' => $request->category,
    //         'image' => $image_name,
    //         'created_at' => now(),  // optional, if you want to track creation time
    //         'updated_at' => now()   // optional, if you want to track update time
    //     ]);
    
    //     return redirect()->back()->with('message', 'Product Added Successfully');
    // }

        //delete product
       public function delete_product($id){
        $product=Product::find($id);
        $product->delete();
        return redirect()->back()->with('message','product Deleted successfully');
       }
    
       public function edit($id)
{
    $product = Product::findOrFail($id); // Find the product by ID
    return view('products.edit', compact('product'));
}


       public function update_product_confirm(Request $request, $id){
        $product = Product::find($id);
        $product->title=request()->title;
        $product->description=request()->description;
        $product->price=request()->price;
        $product->quantity=request()->quantity;
        $product->discount_price=request()->discount_price;
        $product->category=request()->category;
    
        if(request()->hasFile('image')){
            $image=$request->image;
            $image_name=time().'.'.$image->getClientOriginalExtension();
            $request->image->move('product',$image_name);
            $product->image=$image_name;
        }
    
        $product->save();
        return redirect()->back()->with('message', 'Product updated successfully!');
    }
}
