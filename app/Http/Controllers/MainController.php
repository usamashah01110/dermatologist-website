<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function home() {
        return view('home');
    }

    public function about() {
        return view('aboutus');
    }

    public function contact() {
        return view('contactus');
    }

    protected function doctorList() {
        return [
            [
                'name' => 'Dr. Ayesha Farooq',
                'specialty' => 'Clinical Dermatology',
                'focus' => 'Acne, Pigmentation & Skin Health',
                'clinic' => 'Lahore',
                'rating' => 4.9,
                'experience' => '12 years',
                'image' => 'https://images.unsplash.com/photo-1524504388940-b1c1722653e1?w=500&q=80&fit=crop',
            ],
            [
                'name' => 'Dr. Omar Khurshid',
                'specialty' => 'Cosmetic Dermatology',
                'focus' => 'Skin Rejuvenation & Laser Therapy',
                'clinic' => 'Karachi',
                'rating' => 4.8,
                'experience' => '10 years',
                'image' => 'https://images.unsplash.com/photo-1537368910025-700350fe46c7?w=500&q=80&fit=crop',
            ],
            [
                'name' => 'Dr. Sana Iqbal',
                'specialty' => 'Paediatric Dermatology',
                'focus' => 'Eczema, Rashes & Baby Skin Care',
                'clinic' => 'Islamabad',
                'rating' => 4.7,
                'experience' => '8 years',
                'image' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=500&q=80&fit=crop',
            ],
            [
                'name' => 'Dr. Ahmed Rehman',
                'specialty' => 'Medical Dermatology',
                'focus' => 'Psoriasis, Vitiligo & Skin Allergy',
                'clinic' => 'Faisalabad',
                'rating' => 4.9,
                'experience' => '14 years',
                'image' => 'https://images.unsplash.com/photo-1579154203451-62f82f40f024?w=500&q=80&fit=crop',
            ],
            [
                'name' => 'Dr. Maryam Zafar',
                'specialty' => 'Cosmetic Dermatology',
                'focus' => 'Anti-Aging & Skin Brightening',
                'clinic' => 'Multan',
                'rating' => 4.8,
                'experience' => '11 years',
                'image' => 'https://images.unsplash.com/photo-1537368910025-700350fe46c7?w=500&q=80&fit=crop',
            ],
            [
                'name' => 'Dr. Bilal Ahmad',
                'specialty' => 'Surgical Dermatology',
                'focus' => 'Mole Removal & Skin Surgery',
                'clinic' => 'Peshawar',
                'rating' => 4.8,
                'experience' => '9 years',
                'image' => 'https://images.unsplash.com/photo-1524504388940-b1c1722653e1?w=500&q=80&fit=crop',
            ],
        ];
    }

    public function dermatologists() {
        $doctors = $this->doctorList();

        return view('dermatologist', compact('doctors'));
    }

    public function booking(Request $request) {
        $doctors = $this->doctorList();
        $selectedDoctor = null;

        if ($doctorName = $request->query('doctor')) {
            $selectedDoctor = collect($doctors)->firstWhere('name', $doctorName);
        }

        return view('booking', compact('selectedDoctor'));
    }
}
