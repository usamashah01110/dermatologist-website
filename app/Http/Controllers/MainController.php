<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Dermatologist;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Disease;
use App\Models\Review;

class MainController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['booking']);
    }

    public function home()
    {
        $diseases = Disease::all();
        $reviews = Review::all();
        return view('home', compact('diseases', 'reviews'));

    }

    public function about()
    {
        return view('aboutus');
    }

    public function contact()
    {
        return view('contactus');
    }


    public function dermatologists()
    {
        $doctors = Dermatologist::with('user')->where('status', 'approved')->get();

        return view('dermatologist', compact('doctors'));
    }

    public function booking(Request $request)
    {
        // The booking link passes the dermatologist id (names are not unique).
        if (! $request->filled('doctor')) {
            return redirect()
                ->route('dermatologists.page')
                ->with('error', 'Please choose a dermatologist to book with.');
        }

        $dermatologist = Dermatologist::with('user')
            ->where('status', 'approved')
            ->find($request->doctor);

        if (! $dermatologist || ! $dermatologist->user) {
            return redirect()
                ->route('dermatologists.page')
                ->with('error', 'Doctor not found. Please choose another specialist.');
        }

        // The view reads $selectedDoctor->name and $selectedDoctor->dermatologist->*,
        // so hand it the user with the dermatologist relation attached.
        $selectedDoctor = $dermatologist->user;
        $selectedDoctor->setRelation('dermatologist', $dermatologist);

        return view('booking', compact('selectedDoctor'));
    }
}
