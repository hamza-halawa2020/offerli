<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('dashboard.categories.categories', compact('categories'));
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.categories.create-category');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|min:2|unique:categories',
            'name_ar' => 'required|min:2|unique:categories',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $image = $request->file('logo');
        $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        $folderPath = 'images/category/' . $request->id . '/';
        $image->move(public_path($folderPath), $filename);

        Category::create([
            'name' => $request['name'],
            'name_ar' => $request['name_ar'],
            'slug' => Str::slug($request['name']),
            'logo' => $filename,

        ]);
        $categories = Category::all();
        return view('dashboard.categories.categories', compact('categories'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('dashboard.categories.show-category', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('dashboard.categories.edit-category', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'min:2',
            'name_ar' => 'min:2',
            'logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $image = $request->file('logo');
        $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        $folderPath = 'images/category/' . $request->id . '/';
        $image->move(public_path($folderPath), $filename);

        $category->update([
            'name' => $request['name'],
            'name_ar' => $request['name_ar'],
            'slug' => Str::slug($request['name']),
            'logo' => $filename,

        ]);
        $categories = Category::all();
        return redirect()->route('categories.index', compact('categories'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        foreach ($category->subcategories as $item) {
            $item->delete();
        }
        $category->delete();
        return redirect()->back();
    }
}
