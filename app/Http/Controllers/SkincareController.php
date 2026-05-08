<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skincare;

class SkincareController extends Controller
{
    public function index()
    {
        // public skincare page ke liye database se articles fetch kar raha hun
        $articles = Skincare::latest()->get();
        return view('skincare', compact('articles'));
    }

    public function adminIndex()
    {
        // admin panel ka index jahan CRUD listing hogi
        $skincares = Skincare::latest()->get();
        return view('admin.skincare.index', compact('skincares'));
    }

    public function create()
    {
        return view('admin.skincare.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image_path')) {
            $file = $request->file('image_path');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/skincares', $filename);
            $data['image_path'] = 'storage/skincares/' . $filename;
        }

        Skincare::create($data);

        return redirect()->route('skincare.index')->with('success', 'Skincare article created successfully.');
    }

    public function edit($id)
    {
        $skincare = Skincare::findOrFail($id);
        return view('admin.skincare.edit', compact('skincare'));
    }

    public function update(Request $request, $id)
    {
        $skincare = Skincare::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image_path')) {
            $file = $request->file('image_path');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/skincares', $filename);
            $data['image_path'] = 'storage/skincares/' . $filename;
        } else {
            unset($data['image_path']);
        }

        $skincare->update($data);

        return redirect()->route('skincare.index')->with('success', 'Skincare article updated successfully.');
    }

    public function delete($id)
    {
        $skincare = Skincare::findOrFail($id);
        $skincare->delete();
        return redirect()->route('skincare.index');
    }
}
