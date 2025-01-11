<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PartnerSection;
use Illuminate\Http\Request;
use Exception;

class PartnerSectionController extends Controller
{


    public function showWelcome(string $locale)
    {
        try {
            if (!in_array($locale, ['en', 'ar'])) {
                return redirect()->back();
            }
            \App::setLocale($locale);
            $partnerSection = PartnerSection::inRandomOrder()->first();

            return view('welcome', compact('partnerSection'));
        } catch (Exception $e) {
            return view('errors.general', ['message' => $e->getMessage()]);
        }
    }



    public function index()
    {
        try {
            $partners = PartnerSection::all();
            return view('dashboard.landing.partner_sections.index', compact('partners'));
        } catch (Exception $e) {
            return view('errors.general', ['message' => $e->getMessage()]);
        }
    }

    public function create()
    {
        return view('dashboard.landing.partner_sections.create');
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
                $folderPath = 'images/partnerSections/';
                $image->move(public_path($folderPath), $filename);
                $validatedData['image'] = $filename;
            }

            PartnerSection::create($validatedData);

            return redirect()->route('partner-sections.index')->with('success', 'partnerSection created successfully.');
        } catch (Exception $e) {
        }
    }

    public function show(string $id)
    {
        try {
            $partnerSection = PartnerSection::findOrFail($id);
            return view('partner-sections.show', compact('partnerSection'));
        } catch (Exception $e) {
            return view('errors.general', ['message' => $e->getMessage()]);
        }
    }

    public function edit(string $id)
    {
        try {
            $partnerSection = PartnerSection::findOrFail($id);
            return view('partner-sections.edit', compact('partnerSection'));
        } catch (Exception $e) {
            return view('errors.general', ['message' => $e->getMessage()]);
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $partnerSection = PartnerSection::findOrFail($id);
            $validatedData = $request->all();

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $extension = $image->getClientOriginalExtension();
                $filename = time() . '_' . uniqid() . '.' . $extension;
                $folderPath = 'images/partnerSections/';
                $image->move(public_path($folderPath), $filename);
                $validatedData['image'] = $filename;

                // Delete old image
                $oldImagePath = public_path('images/partnerSections/' . $partnerSection->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $partnerSection->update($validatedData);
            return redirect()->route('partner-sections.index')->with('success', 'partnerSection updated successfully.');
        } catch (Exception $e) {
            return redirect()->route('partner-sections.edit', $id)->with('error', $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        try {
            $partner = PartnerSection::findOrFail($id);

            $imagePath = public_path('images/partnerSections/' . $partner->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            $partner->delete();

            return redirect()->route('partner-sections.index')->with('success', 'partnerSection deleted successfully.');
        } catch (Exception $e) {
            return redirect()->route('partner-sections.index')->with('error', $e->getMessage());
        }
    }


}