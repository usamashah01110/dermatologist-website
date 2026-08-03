<?php

namespace App\Http\Controllers;

use App\Mail\ContactMessageMail;
use App\Models\Appointment;
use App\Models\Dermatologist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
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

        // Only published reviews, newest first — the cards read rating, name,
        // location, created_at and patient_id straight off these rows.
        $reviews = Review::approved()->latest()->take(6)->get();

        return view('home', compact('diseases', 'reviews'));

    }

    public function about()
    {
        $reviews = Review::approved()->latest()->take(3)->get();

        return view('aboutus', compact('reviews'));
    }

    public function contact()
    {
        return view('contactus');
    }

    /**
     * Deliver a contact form submission to the support inbox shown on the page.
     */
    public function sendContact(Request $request)
    {
        $data = $request->validate([
            'name'    => ['required', 'string', 'max:100'],
            'email'   => ['required', 'email', 'max:150'],
            'phone'   => ['nullable', 'string', 'max:30'],
            'subject' => ['required', 'string', 'max:150'],
            'message' => ['required', 'string', 'max:2000'],
        ]);

        $data['phone'] = $data['phone'] ?? null;

        try {
            Mail::to(config('mail.contact_to'))
                ->send(new ContactMessageMail($data));
        } catch (\Throwable $e) {
            Log::error('Contact form email failed: ' . $e->getMessage());

            return back()
                ->withInput()
                ->with('error', 'Sorry, we could not send your message right now. Please call the clinic or try again shortly.');
        }

        return back()->with('success', 'Thanks for reaching out! Our support team will get back to you soon.');
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
