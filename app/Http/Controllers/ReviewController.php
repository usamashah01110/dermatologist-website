<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
class ReviewController extends Controller
{
    public function index()
    {
        // databse se data lany k lie
        $reviews = Review::all();
        // ae hue data ko index page pr show krawany k lie yh line likhi hai
        return view('admin.review.index', compact('reviews'));
    }
    public function create()
    {
        return view('admin.review.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'location' => 'required',
        'review_text' => 'required',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $data = $request->all();

    if($request->hasFile('image')){
        $file = $request->file('image');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/reviews', $filename);
        $data['image_path'] =  'reviews/' . $filename;
    }

    Review::create($data);

    return redirect()->route('review.index')->with('success', 'Review Added Successfully!');
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