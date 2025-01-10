<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subcategories = Subcategory::all();
        return view('dashboard.categories.subcategories', compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.categories.create-subcategory', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|unique:subcategories',
            'name_ar' => 'required|min:2|unique:subcategories',
            'category_id' => 'required',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',

        ]);

        $image = $request->file('logo');
        $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        $folderPath = 'images/sub-category/' . $request->id . '/';
        $image->move(public_path($folderPath), $filename);



        Subcategory::create([


            'name' => $request['name'],
            'name_ar' => $request['name_ar'],
            'category_id' => $request['category_id'],
            'slug' => Str::slug($request['name']),
            'logo' => $filename,

        ]);
        $subcategories = Subcategory::all();
        return redirect()->route('subcategories.index', compact('subcategories'));
    }


    /**
     * Display the specified resource.
     */
    public function show(Subcategory $subcategory)
    {
        $category = $subcategory->category;
        return redirect()->route('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subcategory $subcategory)
    {
        // dd($Subcategory);
        $categories = Category::all();
        return view('dashboard.categories.edit-subcategory', compact(['subcategory', 'categories']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubCategory $subcategory)
    {
        $request->validate([
            'name' => 'min:2',
            'name_ar' => 'min:2',
            'category_id' => 'required',
            'logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',

        ]);

        $image = $request->file('logo');
        $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        $folderPath = 'images/sub-category/' . $request->id . '/';
        $image->move(public_path($folderPath), $filename);




        $subcategory->update([
            'name' => $request['name'],
            'name_ar' => $request['name_ar'],
            'category_id' => $request['category_id'],
            'slug' => Str::slug($request['name']),
            'logo' => $filename,
        ]);
        $subcategories = Subcategory::all();
        return redirect()->route('subcategories.index', compact('subcategories'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subcategory $subcategory)
    {
        $subcategory->delete();
        $subcategories = Subcategory::all();
        return redirect()->route('subcategories.index', compact('subcategories'));
    }

    // public function new($slug)
    // {
    //     return view('dashboard.categories.create-subcategory', compact('slug'));
    // }

    // public function add(Request $request, $slug)
    // {
    //     $category = Category::where('slug', $slug)->first();
    //     $request->validate([
    //         'name'  => 'required|min:2|unique:subcategories',
    //         'name_ar'  => 'required|min:2|unique:subcategories',
    //         'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',

    //     ]);
    //     $image = $request->file('logo');
    //     $imageName = Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)) . '_' . time() . '.' . $image->getClientOriginalExtension();
    //     $imagePath = $image->storeAs('images\Subcategory', $imageName, 'public');
    //     Subcategory::create([
    //         'name' => $request['name'],
    //         'name_ar' => $request['name_ar'],
    //         'category_id' => $category->id,
    //         'slug' => Str::slug($request['name']),
    //         'logo' => $imagePath,

    //     ]);
    //     $categories = Category::all();
    //     return redirect()->route('categories.index', compact('categories'));
    // }

    // public function delete($slug)
    // {
    //     Subcategory::where('slug', $slug)->delete();
    //     $categories = Category::all();
    //     return redirect()->route('categories.index', compact('categories'));
    // }
}
