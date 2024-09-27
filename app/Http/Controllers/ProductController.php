<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function view_product(){
        $category=Category::all();
       return view('admin.product',compact('category'));
   }
    
    // add products
    public function add_product(Request $request){
        $image = $request->image;
        $image_name = time() . '.' . $image->getClientOriginalExtension();
        $request->image->move('product', $image_name);
    
        DB::table('products')->insert([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'discount_price' => $request->discount_price,
            'category' => $request->category,
            'image' => $image_name,
            'created_at' => now(),  // optional, if you want to track creation time
            'updated_at' => now()   // optional, if you want to track update time
        ]);
    
        return redirect()->back()->with('message', 'Product Added Successfully');
    }

    // view product
    public function show_product(){
        $product=Product::all();
        return view('admin.show_product',compact('product'));
       }
//delete product
       public function delete_product($id){
        $product=Product::find($id);
        $product->delete();
        return redirect()->back()->with('message','product Deleted successfully');
       }
    
       public function edit_product($id){
        $product = Product::find($id);
        $category=Category::all();
           return view('admin.update_product', compact('product', 'category'));
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
