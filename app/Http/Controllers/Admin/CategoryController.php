<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Category::query();
        
        // Handle search
        if ($request->has('search') && $request->search !== '') {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }
        
        $categories = $query->orderBy('display_order')->get();
        
        return view('admin.categories', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:categories,name',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:50',
            'display_order' => 'nullable|integer|min:0',
            'is_active' => 'required|boolean',
        ]);

        $slug = Str::slug($request->name);

        Category::create([
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'icon' => $request->icon,
            'display_order' => $request->display_order ?? 0,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category ' . $request->name . ' created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return redirect()->route('admin.categories.index')->with('success', '');
        //return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:categories,name,' . $category->id, // The 'unique' rule is ignored if the name belongs to the current category
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:50',
            'display_order' => 'nullable|integer|min:0',
            'is_active' => 'required|boolean',
        ]);

        $slug = Str::slug($request->name);

        $category->update([
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'icon' => $request->icon,
            'display_order' => $request->display_order ?? 0,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category ' . $request->name . ' updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // 1. Retrieve the category name before deletion
        $categoryName = $category->name;

        // 2. Delete the category from the database
        $category->delete();

        // 3. Redirect and display the category name in the success message
        return redirect()->route('admin.categories.index')->with('success', "Category '{$categoryName}' deleted successfully.");
    }
}