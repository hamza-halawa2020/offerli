<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\SubCategoryResource;
use App\Models\Category;
use App\Models\Subcategory;
use Exception;

class CategoryController extends Controller
{
    public function index()
    {
        try {
            $categories = Category::all();
            return CategoryResource::collection($categories);
        } catch (Exception $e) {
            return response()->json($e, 500);
        }
    }

    public function show(string $id)
    {
        try {
            $category = Category::findOrFail($id);
            return new CategoryResource($category);
        } catch (Exception $e) {
            return response()->json($e, 500);
        }
    }

    public function getAllSubCategories()
    {
        try {
            $subCategories = Subcategory::all();
            return SubCategoryResource::collection($subCategories);
        } catch (Exception $e) {
            return response()->json($e, 500);
        }
    }

    public function getOneSubCategory(string $id)
    {
        try {
            $subCategory = Subcategory::findOrFail($id);
            return new SubCategoryResource($subCategory);
        } catch (Exception $e) {
            return response()->json($e, 500);
        }
    }

}
