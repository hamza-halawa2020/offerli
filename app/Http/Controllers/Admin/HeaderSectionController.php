<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutSection;
use App\Models\FeatureSection;
use App\Models\PartnerSection;
use Exception;
use Illuminate\Http\Request;
use App\Models\HeaderSection;
use Illuminate\Support\Facades\DB;

class HeaderSectionController extends Controller
{


    public function showWelcome(string $locale)
    {
        try {
            if (!in_array($locale, ['en', 'ar'])) {
                return redirect()->back();
            }
            \App::setLocale($locale);

            $headerSection = HeaderSection::inRandomOrder()->first();

            $featureSection = FeatureSection::inRandomOrder()->limit(3)->get();
            $aboutSection = AboutSection::inRandomOrder()->first();
            $aboutSections = AboutSection::inRandomOrder()->limit(4)->get();
            $partnerSection = PartnerSection::all();

            return view('welcome', compact('headerSection', 'featureSection', 'aboutSections', 'aboutSection', 'partnerSection'));
        } catch (Exception $e) {
            return response($e->getMessage());
        }
    }



    public function index()
    {
        try {
            $headers = HeaderSection::all();
            return view('dashboard.landing.header_sections.index', compact('headers'));
        } catch (Exception $e) {
            return view('errors.general', ['message' => $e->getMessage()]);
        }
    }

    public function create()
    {
        return view('dashboard.landing.header_sections.create');
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
                $folderPath = 'images/HeaderSections/';
                $image->move(public_path($folderPath), $filename);
                $validatedData['image'] = $filename;
            }

            HeaderSection::create($validatedData);

            return redirect()->route('header-sections.index')->with('success', 'HeaderSection created successfully.');
        } catch (Exception $e) {
        }
    }

    public function show(string $id)
    {
        try {
            $HeaderSection = HeaderSection::findOrFail($id);
            return view('header-sections.show', compact('HeaderSection'));
        } catch (Exception $e) {
            return view('errors.general', ['message' => $e->getMessage()]);
        }
    }

    public function edit(string $id)
    {
        try {
            $HeaderSection = HeaderSection::findOrFail($id);
            return view('header-sections.edit', compact('HeaderSection'));
        } catch (Exception $e) {
            return view('errors.general', ['message' => $e->getMessage()]);
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $HeaderSection = HeaderSection::findOrFail($id);
            $validatedData = $request->all();

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $extension = $image->getClientOriginalExtension();
                $filename = time() . '_' . uniqid() . '.' . $extension;
                $folderPath = 'images/HeaderSections/';
                $image->move(public_path($folderPath), $filename);
                $validatedData['image'] = $filename;

                // Delete old image
                $oldImagePath = public_path('images/HeaderSections/' . $HeaderSection->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $HeaderSection->update($validatedData);
            return redirect()->route('header-sections.index')->with('success', 'HeaderSection updated successfully.');
        } catch (Exception $e) {
            return redirect()->route('header-sections.edit', $id)->with('error', $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        try {
            $header = HeaderSection::findOrFail($id);

            $imagePath = public_path('images/HeaderSections/' . $header->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            $header->delete();

            return redirect()->route('header-sections.index')->with('success', 'HeaderSection deleted successfully.');
        } catch (Exception $e) {
            return redirect()->route('header-sections.index')->with('error', $e->getMessage());
        }
    }


}