<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Dermatologist;
use App\Models\Patient;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DummyDataSeeder extends Seeder
{
    /**
     * Seed demo dermatologists, patients and a spread of appointments
     * (past, today and upcoming) so every role has data to look at.
     */
    public function run(): void
    {
        if (Dermatologist::count() > 0 || Patient::count() > 0) {
            $this->command->warn('Dummy data already present — skipping DummyDataSeeder.');
            return;
        }

        $weekdays  = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        $cities    = ['Lahore', 'Karachi', 'Islamabad', 'Rawalpindi', 'Faisalabad'];
        $specs     = ['Acne & Scars', 'Cosmetic Dermatology', 'Pediatric Dermatology', 'Skin Cancer', 'Hair & Scalp'];
        $concerns  = ['acne', 'eczema', 'psoriasis', 'rosacea', 'hair_loss', 'pigmentation', 'aging', 'allergy', 'other'];
        $contacts  = ['phone', 'email', 'whatsapp'];
        $types     = ['consultation', 'follow_up', 'treatment', 'emergency'];

        // ── 1. Dermatologists (first one is a fixed demo login) ──
        $dermatologists = [];

        $demoDoctor = $this->makeDoctor('Dr. Ayesha Khan', 'doctor@derma.com', $weekdays, $cities, $specs, true);
        $dermatologists[] = $demoDoctor;

        for ($i = 0; $i < 4; $i++) {
            $dermatologists[] = $this->makeDoctor(
                'Dr. ' . fake()->name(),
                fake()->unique()->safeEmail(),
                $weekdays, $cities, $specs, false
            );
        }

        // ── 2. Patients (first one is a fixed demo login) ──
        $patients = [];

        $patients[] = $this->makePatient('Sara Ahmed', 'patient@derma.com');

        for ($i = 0; $i < 14; $i++) {
            $patients[] = $this->makePatient(fake()->name(), fake()->unique()->safeEmail());
        }

        // ── 3. Appointments across a date window ──
        $slotPool = [];
        for ($h = 9; $h <= 16; $h++) {
            $slotPool[] = sprintf('%02d:00', $h);
            $slotPool[] = sprintf('%02d:30', $h);
        }

        $today = Carbon::today();

        foreach ($dermatologists as $doctor) {
            $availability = $doctor->availability_days;

            // From 10 days ago to 7 days ahead.
            for ($offset = -10; $offset <= 7; $offset++) {
                $date = (clone $today)->addDays($offset);

                // Only book on days the doctor actually works.
                if (! in_array($date->format('l'), $availability, true)) {
                    continue;
                }

                // 2–9 appointments that day (always under the 15/day cap).
                $count = random_int(2, 9);
                $slots = $slotPool;
                shuffle($slots);
                $slots = array_slice($slots, 0, $count);

                foreach ($slots as $time) {
                    $patient = $patients[array_rand($patients)];
                    $status  = $this->statusForDate($offset);

                    Appointment::create([
                        'patient_id'        => $patient->id,
                        'dermatologist_id'  => $doctor->id,
                        'patient_name'      => $patient->user->name,
                        'patient_email'     => $patient->user->email,
                        'patient_phone'     => $patient->phone_number,
                        'preferred_contact' => $contacts[array_rand($contacts)],
                        'is_new_patient'    => (bool) random_int(0, 1),
                        'appointment_type'  => $types[array_rand($types)],
                        'appointment_date'  => $date->toDateString(),
                        'appointment_time'  => $time,
                        'concern_category'  => $concerns[array_rand($concerns)],
                        'notes'             => fake()->boolean(40) ? fake()->sentence(10) : null,
                        'status'            => $status,
                    ]);
                }
            }
        }

        $this->command->info('Seeded ' . count($dermatologists) . ' doctors, ' . count($patients) . ' patients and ' . Appointment::count() . ' appointments.');
        $this->command->info('Demo logins → doctor@derma.com / patient@derma.com (password: password123)');
    }

    private function makeDoctor(string $name, string $email, array $weekdays, array $cities, array $specs, bool $isDemo): Dermatologist
    {
        $user = User::firstOrCreate(
            ['email' => $email],
            ['name' => $name, 'password' => Hash::make('password123')]
        );
        $user->assignRole('dermatologist');

        // Pick 3–5 working days for this doctor.
        $days = $weekdays;
        shuffle($days);
        $days = array_slice($days, 0, random_int(3, 5));

        return Dermatologist::create([
            'user_id'           => $user->id,
            'qualification'     => 'MBBS, FCPS (Dermatology)',
            'experience_year'   => random_int(2, 20) . ' years',
            'specialization'    => $specs[array_rand($specs)],
            'phone_number'      => fake()->phoneNumber(),
            'clinic_address'    => fake()->streetAddress(),
            'city'              => $cities[array_rand($cities)],
            'availability_days' => array_values($days),
            'profile_image'     => null,
            'status'            => 'approved',
        ]);
    }

    private function makePatient(string $name, string $email): Patient
    {
        $user = User::firstOrCreate(
            ['email' => $email],
            ['name' => $name, 'password' => Hash::make('password123')]
        );
        $user->assignRole('patient');

        return Patient::create([
            'user_id'      => $user->id,
            'phone_number' => fake()->phoneNumber(),
            'age'          => random_int(16, 70),
            'gender'       => ['Male', 'Female', 'Other'][array_rand(['Male', 'Female', 'Other'])],
            'address'      => fake()->address(),
            'skin_type'    => ['Normal', 'Oily', 'Dry', 'Combination', 'Sensitive', 'Not sure'][array_rand(range(0, 5))],
        ]);
    }

    /**
     * Past days are completed/cancelled; today & future are pending/confirmed.
     */
    private function statusForDate(int $offset): string
    {
        if ($offset < 0) {
            return random_int(0, 100) < 80 ? 'completed' : 'cancelled';
        }

        return random_int(0, 100) < 60 ? 'confirmed' : 'pending';
    }
}
