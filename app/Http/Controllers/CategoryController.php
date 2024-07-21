<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\ParentCategory;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::get();
        return view('categories.index', compact('categories'));
    }

   public function add(Request $request)
    {
        $parent_categories = ParentCategory::all();
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
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

       if ($request->id) {
            $category = Category::find($request->id);
        } else {
            $category = new Category;
        }
        $category->name = $request->name;
        $category->parent_id = $request->parent_id;
        $category->save();

        return redirect('categories')->with('success', 'Category saved successfully!');
    }

    public function delete(Request $request)
    {
        $category = Category::findOrFail($request->category);
        $category->delete();

        return redirect()->back()->with('success', 'Category deleted successfully!');
    }

    public function tree(Request $request)
    {
        $parent_categories = ParentCategory::all();

        return view('tree.index', compact('parent_categories'));
    }
}
