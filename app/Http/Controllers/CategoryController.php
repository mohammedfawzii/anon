<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Branch;
use App\Models\Category;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $categories = $this->categoryService->getAllCategories();
        return view('dashboard.categories.index', compact('categories'));
    }

    public function create()
    {
        $branches = Branch::all();
        return view('dashboard.categories.create' , compact('branches'));
    }

    public function store(StoreCategoryRequest $request)
    {
        $validatedData = $request->validated();
       $this->categoryService->createCategory($validatedData);
        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function show($id)
    {
        $category = $this->categoryService->getCategoryById($id);
        return view('dashboard.categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $this->categoryService->updateCategory($category, $request->validated());
        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        $this->categoryService->deleteCategory($category);
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
