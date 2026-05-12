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
        $selectedDoctor = User::where('name', $request->doctor)
            ->with('dermatologist')
            ->first();

        if (!$selectedDoctor || !$selectedDoctor->dermatologist) {
            return back()->with('error', 'Doctor not found. Please choose another specialist.');
        }

        $todayBooked = Appointment::where('dermatologist_id', $selectedDoctor->dermatologist->id)
            ->whereDate('appointment_date', \Carbon\Carbon::today())
            ->whereIn('status', ['pending', 'confirmed'])
            ->count();

        if ($todayBooked >= 15) {
            return back()->with('error', "Dr. {$selectedDoctor->name} has reached the maximum 15 appointments for today. Please try another doctor or come back tomorrow.");
        }

        return view('booking', compact('selectedDoctor'));
    }
}
