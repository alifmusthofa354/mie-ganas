<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
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
        $this->authorize('viewAny', Category::class);

        $query = Category::query();

        // Handle search - sanitize input to prevent any injection
        if ($request->has('search') && $request->search !== '') {
            $searchTerm = strip_tags($request->search); // Sanitize input
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('description', 'LIKE', "%{$searchTerm}%");
            });
        }

        $categories = $query->orderBy('display_order')->paginate(6)->withQueryString();

        return view('admin.categories', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Category::class);
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $validated = $request->validated();
        $slug = Str::slug($validated['name']);

        $category = Category::create([
            'name' => $validated['name'],
            'slug' => $slug,
            'description' => $validated['description'],
            'icon' => $validated['icon'],
            'display_order' => $validated['display_order'] ?? 0,
            'is_active' => $validated['is_active'],
        ]);

        // Sanitize category name to prevent XSS in flash messages
        $categoryName = e($category->name);
        return redirect()->route('admin.categories.index')->with('success', "Category {$categoryName} created successfully.");
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
        $this->authorize('update', $category);
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $validated = $request->validated();
        $slug = Str::slug($validated['name']);

        $category->update([
            'name' => $validated['name'],
            'slug' => $slug,
            'description' => $validated['description'],
            'icon' => $validated['icon'],
            'display_order' => $validated['display_order'] ?? 0,
            'is_active' => $validated['is_active'],
        ]);

        // Sanitize category name to prevent XSS in flash messages
        $categoryName = e($request->name);
        return redirect()->route('admin.categories.index')->with('success', "Category {$categoryName} updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $this->authorize('delete', $category);

        // 1. Retrieve the category name before deletion
        $categoryName = $category->name;

        // 2. Delete the category from the database
        $category->delete();

        // 3. Redirect and display the category name in the success message
        return redirect()->route('admin.categories.index')->with('success', "Category '{$categoryName}' deleted successfully.");
    }
}