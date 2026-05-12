<?php

namespace App\Http\Controllers;

use App\Models\Dermatologist;
use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:manage reviews');
    }

    public function index()
    {
        $reviews = Review::all();
        return view('admin.review.index', compact('reviews'));
    }
    public function create()
    {
        return view('admin.review.create');
    }

    public function store(Request $request, $doctorId)
    {
        $request->validate([
            'rating'      => 'required|integer|min:1|max:5',
            'review_text' => 'required|string|min:10|max:1000',
        ]);

        $doctor = Dermatologist::findOrFail($doctorId);
        $user = Auth::user();

        if (!$user->patient) {
            return back()->with('error', 'Only patients can submit reviews.');
        }

        $existingReview = Review::where('dermatologist_id', $doctor->id)
            ->where('patient_id', $user->patient->id)
            ->first();

        if ($existingReview) {
            return back()->with('error', 'You have already reviewed this doctor.');
        }

        Review::create([
            'dermatologist_id' => $doctor->id,
            'patient_id'       => $user->patient->id,
            'name'             => $user->name,
            'review_text'      => $request->review_text,
            'rating'           => $request->rating,
            'location'         => $user->patient->address ?? 'Pakistan'
        ]);

        return back()->with('success', 'Thank you! Your review has been published successfully.');
    }

    public function destroy($id)
    {
        $review=Review::find($id);
        $review->delete();
        return redirect()->route('review.index')->with('success', 'Review Deleted Successfully!');
    }

    public function edit($id)
    {
        $review=Review::find($id);
       return view('admin.review.edit', compact('review'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'review_text' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $review = Review::find($id);
        $data = $request->all();

        if($request->hasFile('image')){
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/reviews', $filename);
            $data['image_path'] =  'reviews/' . $filename;
        }

        $review->update($data);

        return redirect()->route('review.index')->with('success', 'Review Updated Successfully!');

    }
}
