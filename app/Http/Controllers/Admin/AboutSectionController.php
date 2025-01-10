<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutSection;
use Illuminate\Http\Request;
use Exception;

class AboutSectionController extends Controller
{


    public function showWelcome(string $locale)
    {
        try {
            if (!in_array($locale, ['en', 'ar'])) {
                return redirect()->back();
            }
            \App::setLocale($locale);
            $aboutSection = AboutSection::inRandomOrder()->first();

            return view('welcome', compact('aboutSection'));
        } catch (Exception $e) {
            return view('errors.general', ['message' => $e->getMessage()]);
        }
    }



    public function index()
    {
        try {
            $abouts = AboutSection::all();
            return view('dashboard.landing.about_sections.index', compact('abouts'));
        } catch (Exception $e) {
            return view('errors.general', ['message' => $e->getMessage()]);
        }
    }

    public function create()
    {
        return view('dashboard.landing.about_sections.create');
    }


    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'title' => 'required',
                'description' => 'required',
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $folderPath = 'images/aboutSections/';
                $image->move(public_path($folderPath), $filename);
                $validatedData['image'] = $filename;
            }

            AboutSection::create($validatedData);

            return redirect()->route('about-sections.index')->with('success', 'aboutSection created successfully.');
        } catch (Exception $e) {
        }
    }

    public function show(string $id)
    {
        try {
            $aboutSection = AboutSection::findOrFail($id);
            return view('about-sections.show', compact('aboutSection'));
        } catch (Exception $e) {
            return view('errors.general', ['message' => $e->getMessage()]);
        }
    }

    public function edit(string $id)
    {
        try {
            $aboutSection = AboutSection::findOrFail($id);
            return view('about-sections.edit', compact('aboutSection'));
        } catch (Exception $e) {
            return view('errors.general', ['message' => $e->getMessage()]);
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $aboutSection = AboutSection::findOrFail($id);
            $validatedData = $request->all();

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $extension = $image->getClientOriginalExtension();
                $filename = time() . '_' . uniqid() . '.' . $extension;
                $folderPath = 'images/aboutSections/';
                $image->move(public_path($folderPath), $filename);
                $validatedData['image'] = $filename;

                // Delete old image
                $oldImagePath = public_path('images/aboutSections/' . $aboutSection->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $aboutSection->update($validatedData);
            return redirect()->route('about-sections.index')->with('success', 'aboutSection updated successfully.');
        } catch (Exception $e) {
            return redirect()->route('about-sections.edit', $id)->with('error', $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        try {
            $about = AboutSection::findOrFail($id);

            $imagePath = public_path('images/aboutSections/' . $about->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            $about->delete();

            return redirect()->route('about-sections.index')->with('success', 'aboutSection deleted successfully.');
        } catch (Exception $e) {
            return redirect()->route('about-sections.index')->with('error', $e->getMessage());
        }
    }


}