<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function view_categories() {
        $categories = Category::all();
        return view('admin.category', compact('categories'));
    }

    public function add_category(Request $request) {
        $request->validate([
            'category_name' => 'required|string|max:255|unique:categories,category_name',
        ]);

        $data = new Category;
        $data->category_name = $request->category_name;
        $data->save();

        return redirect()->back()->with('message', 'Category Added Successfully');
    }

    public function edit_category($id) {
        $category = Category::findOrFail($id);
        return view('admin.edit_category', compact('category'));
    }

    public function update_category(Request $request, $id) {
        $request->validate([
            'category_name' => 'required|string|max:255|unique:categories,category_name,'.$id,
        ]);

        $data = Category::findOrFail($id);
        $data->category_name = $request->category_name;
        $data->save();

        return redirect()->route('categories')->with('message', 'Category Updated Successfully');
    }

    public function delete_category($id) {
        $data = Category::findOrFail($id);
        $data->delete();

        return redirect()->back()->with('message', 'Category Deleted Successfully');
    }
}
