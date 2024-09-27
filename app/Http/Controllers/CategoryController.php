<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
//category
public function view_category(){
    $data=Category::all();
    return view('admin.category',compact('data'));
}

public function add_category(Request $request){
 $data= new Category;
 $data->category_name=$request->category_input;
 $data->save();
 //
 return redirect()->back()->with('message','Category Added Successfully');
}

public function delete_category($id){
     $data = Category::find($id);
     $data->delete();
     return redirect()->back()->with('message','Category Deleted Successfully');
}}
