<?php

namespace App\Http\Services\Admin;
use App\Models\Category;

class CategoryService
{
    public function index()
    {
        return Category::with('children','parent')->get();
    }

    public function find($id)
    {
        return Category::findOrFail($id);
    }

    public function create(array $data)
    {
        return Category::create($data);
    }

    public function update($id, array $data)
    {
        $category = $this->find($id);
        $category->update($data);
        return $category;
    }

    public function delete($id)
    {
        $category = $this->find($id);

        if ($category->children()->count() > 0) {
            throw new \Exception("can't delete this category because it has child");
        }

        return $category->delete();
    }
}