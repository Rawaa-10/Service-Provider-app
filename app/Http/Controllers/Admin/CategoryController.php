<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Admin\CategoryService;

class CategoryController extends Controller
{
    protected $service;

    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $categories = $this->service->index();
        return view("admin.categories.index", compact("categories"));
    }

    public function create()
    {
        //to choose category 
        $categories = Category::with('parent')->get();
        return view("admin.categories.create", compact("categories"));
    }

    public function store(StoreCategoryRequest $request)
    {
        $request->validated();
        $categories = $this->service->create($request->only(['name','parent_id']));
        return view("admin.categories.index" , compact("categories"));
    }

    public function show($id)
    {
        $category = $this->service->find($id);
        return view("admin.categories.show" , compact("category"));
    }

    public function update(UpdateCategoryRequest $request, $id)
    {
        $request->validated();
        $category = $this->service->update($id, $request->only(['name','parent_id']));
        return view('admin.categories.edit', compact('category'));
    }

    public function edit($id)
    {
        
    $category = $this->service->find($id);
    $allCategories = $this->service->index();

    return view('admin.categories.edit', compact('category', 'allCategories'));

    }


    public function delete($id)
    {
        try {
            $this->service->delete($id);
            return redirect()->route('category.index');
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
