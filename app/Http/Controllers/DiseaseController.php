<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disease;

class DiseaseController extends Controller
{
    public function index(){
        $diseases = Disease::paginate(10);
        return view('admin.disease.index', compact('diseases'));
    }

    public function store(Request $request){
       
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'tag' => 'required|string|max:255',
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        
        if ($request->hasFile('image_path')) {
            $file = $request->file('image_path');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/diseases', $filename);
            $data['image_path'] = 'storage/diseases/' . $filename;
        }

        Disease::create($data);

        return redirect()->route('disease.index')->with('success', 'Disease created successfully.');
    }

    public function create(){
        return view('admin.disease.create');
    }

    public function edit(Disease $disease){
        return view('admin.disease.edit', compact('disease'));
    }

    public function update(Request $request, Disease $disease){
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'tag' => 'required|string|max:255',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        
        // Handle image upload
        if ($request->hasFile('image_path')) {
            $file = $request->file('image_path');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/diseases', $filename);
            $data['image_path'] = 'storage/diseases/' . $filename;
        }

        $disease->update($data);

        return redirect()->route('disease.index')->with('success', 'Disease updated successfully.');
    }

    public function destroy(Disease $disease){
        $disease->delete();

        return redirect()->route('disease.index')->with('success', 'Disease deleted successfully.');
    }
}
