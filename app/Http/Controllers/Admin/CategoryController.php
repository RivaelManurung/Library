<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller as BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends BaseController
{
    public function index(Request $request)
    {
        $query = Category::query();

        if ($request->has('search')) {
            $search = $request->query('search');
            $query->where('name', 'LIKE', "%{$search}%");
        }

        $categories = $query->paginate(10);

        return view('Backend.pages.category.index', compact('categories'));
    }



    public function create()
    {
        return view('Backend.pages.category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create([
            'name' => $request->name,
        ]);

        return redirect()->route('category.index')->with('success', 'Category created successfully!');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('Backend.pages.category.update', compact('category'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::findOrFail($id);

        $category->update([
            'name' => $request->name,
        ]);
        return redirect()->route('category.index')->with('success', 'Category updated successfully!');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('category.index')->with('success', 'Category deleted successfully!');
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('Backend.pages.category.show', compact('category'));
    }
}
