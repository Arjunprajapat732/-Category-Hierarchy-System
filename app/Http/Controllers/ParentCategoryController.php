<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ParentCategory;
use Illuminate\Support\Facades\Validator;

class ParentCategoryController extends Controller
{
    public function index(Request $request)
    {
        $parent_categories = ParentCategory::get();
        return view('parent_categories.index', compact('parent_categories'));
    }

    public function add(Request $request)
    {
        if ($request->id) {
            $parent_category = ParentCategory::findOrFail($request->id);
        } else {
            $parent_category = new ParentCategory();
        }
        return view('parent_categories.edit', compact('parent_category'));
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
            $parent_category = ParentCategory::find($request->id);
        } else {
            $parent_category = new ParentCategory;
        }
        $parent_category->name = $request->name;
        $parent_category->save();

        return redirect('parent_categories')->with('success', 'Parent category saved successfully!');
    }

    public function delete(Request $request)
    {
        $parent_category = ParentCategory::findOrFail($request->parent_category);
        $parent_category->delete();

        return redirect()->back()->with('success', 'Parent category deleted successfully!');
    }
}
