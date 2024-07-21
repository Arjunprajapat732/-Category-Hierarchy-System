<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class ParentCategoryController extends Controller
{
    public function index()
    {
        $parent_categories = Category::whereNull('parent_id')->get();
        return view('parent_categories.index', compact('parent_categories'));
    }

    public function add(Request $request)
    {
        $parent_category = $request->id ? Category::findOrFail($request->id) : new Category();
        return view('parent_categories.edit', compact('parent_category'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $parent_category = $request->id ? Category::findOrFail($request->id) : new Category();
        $parent_category->name = $request->name;
        $parent_category->parent_id = null;
        $parent_category->save();

        return redirect('parent_categories')->with('success', 'Parent category saved successfully!');
    }

    public function delete(Request $request)
    {
        $parent_category = Category::findOrFail($request->parent_category);

        // Optional: Check for child categories before deleting
        if ($parent_category->children()->count() > 0) {
            return redirect()->back()->with('error', 'Cannot delete a category with child categories.');
        }

        $parent_category->delete();
        return redirect('parent_categories')->with('success', 'Parent category deleted successfully!');
    }
}
