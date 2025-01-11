<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FeatureSection;
use Illuminate\Http\Request;
use Exception;

class FeatureSectionController extends Controller
{



    public function index()
    {
        try {
            $features = FeatureSection::all();
            return view('dashboard.landing.feature_sections.index', compact('features'));
        } catch (Exception $e) {
            return view('errors.general', ['message' => $e->getMessage()]);
        }
    }

    public function create()
    {
        return view('dashboard.landing.feature_sections.create');
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
                $folderPath = 'images/featureSections/';
                $image->move(public_path($folderPath), $filename);
                $validatedData['image'] = $filename;
            }

            FeatureSection::create($validatedData);

            return redirect()->route('feature-sections.index')->with('success', 'featureSection created successfully.');
        } catch (Exception $e) {
        }
    }

    public function show(string $id)
    {
        try {
            $featureSection = FeatureSection::findOrFail($id);
            return view('feature-sections.show', compact('featureSection'));
        } catch (Exception $e) {
            return view('errors.general', ['message' => $e->getMessage()]);
        }
    }

    public function edit(string $id)
    {
        try {
            $featureSection = FeatureSection::findOrFail($id);
            return view('feature-sections.edit', compact('featureSection'));
        } catch (Exception $e) {
            return view('errors.general', ['message' => $e->getMessage()]);
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $featureSection = FeatureSection::findOrFail($id);
            $validatedData = $request->all();

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $extension = $image->getClientOriginalExtension();
                $filename = time() . '_' . uniqid() . '.' . $extension;
                $folderPath = 'images/featureSections/';
                $image->move(public_path($folderPath), $filename);
                $validatedData['image'] = $filename;

                // Delete old image
                $oldImagePath = public_path('images/featureSections/' . $featureSection->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $featureSection->update($validatedData);
            return redirect()->route('feature-sections.index')->with('success', 'featureSection updated successfully.');
        } catch (Exception $e) {
            return redirect()->route('feature-sections.edit', $id)->with('error', $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        try {
            $feature = FeatureSection::findOrFail($id);

            $imagePath = public_path('images/featureSections/' . $feature->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            $feature->delete();

            return redirect()->route('feature-sections.index')->with('success', 'featureSection deleted successfully.');
        } catch (Exception $e) {
            return redirect()->route('feature-sections.index')->with('error', $e->getMessage());
        }
    }


}
