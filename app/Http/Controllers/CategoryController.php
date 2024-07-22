<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all(); // Get only parent categories
        return view('categories.index', compact('categories'));
    }

    public function add(Request $request)
    {
        $parent_categories = Category::whereNull('parent_id')->get(); // Get parent categories for the dropdown
        if ($request->id) {
            $category = Category::findOrFail($request->id);
        } else {
            $category = new Category();
        }
        
        return view('categories.edit', compact('category', 'parent_categories'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable', // Ensure parent_id is valid if provided
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->id) {
            $category = Category::findOrFail($request->id);
        } else {
            $category = new Category();
        }
        $category->name = $request->name;
        $category->parent_id = $request->parent_id == '0' ? null : $request->parent_id; // Set parent_id
        $category->save();

        return redirect('categories')->with('success', 'Category saved successfully!');
    }

    public function delete(Request $request)
    {
        $category = Category::findOrFail($request->category);

        if ($category->children()->count() > 0) {
            return redirect()->back()->with('error', 'Cannot delete a category with child categories.');
        }

        $category->delete();

        return redirect()->back()->with('success', 'Category deleted successfully!');
    }

    public function tree()
    {
        $categories = Category::with('children')->whereNull('parent_id')->get();

        return view('tree.index', compact('categories'));
    }
}
