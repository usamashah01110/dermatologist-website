<?php

namespace Tests\Feature;

use App\Models\Appointment;
use App\Models\Dermatologist;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class BookingTest extends TestCase
{
    use DatabaseTransactions; // every test rolls back — seeded data stays clean

    private User $patient;
    private Dermatologist $doctor;

    protected function setUp(): void
    {
        parent::setUp();
        $this->patient = User::where('email', 'patient@derma.com')->firstOrFail();
        $this->doctor  = Dermatologist::where('status', 'approved')->with('user')->firstOrFail();
    }

    /** Next future date that falls on one of the doctor's working days. */
    private function workingDate(): string
    {
        $date = Carbon::tomorrow();
        while (! in_array($date->format('l'), $this->doctor->availability_days, true)) {
            $date->addDay();
        }
        return $date->toDateString();
    }

    /** Next future date the doctor does NOT work. */
    private function offDate(): ?string
    {
        $date = Carbon::tomorrow();
        for ($i = 0; $i < 14; $i++) {
            if (! in_array($date->format('l'), $this->doctor->availability_days, true)) {
                return $date->toDateString();
            }
            $date->addDay();
        }
        return null;
    }

    private function payload(array $overrides = []): array
    {
        return array_merge([
            'dermatologist_id'  => $this->doctor->id,
            'patient_name'      => 'Test Patient',
            'patient_email'     => 'test@example.com',
            'patient_phone'     => '+92 300 1234567',
            'preferred_contact' => 'phone',
            'appointment_type'  => 'consultation',
            'appointment_date'  => $this->workingDate(),
            'appointment_time'  => '11:15',
        ], $overrides);
    }

    public function test_valid_booking_is_created(): void
    {
        $this->actingAs($this->patient)
            ->post(route('appointments.store'), $this->payload())
            ->assertRedirect(route('home.page'))
            ->assertSessionHas('success');
    }

    public function test_booking_on_a_non_working_day_is_rejected(): void
    {
        $offDate = $this->offDate();
        if (! $offDate) {
            $this->markTestSkipped('Doctor works every day this fortnight.');
        }

        $this->actingAs($this->patient)
            ->post(route('appointments.store'), $this->payload(['appointment_date' => $offDate]))
            ->assertSessionHas('error');

        $this->assertDatabaseMissing('appointments', [
            'dermatologist_id' => $this->doctor->id,
            'appointment_date' => $offDate,
        ]);
    }

    public function test_duplicate_time_slot_is_rejected(): void
    {
        $date = $this->workingDate();

        Appointment::create($this->payload([
            'appointment_date' => $date,
            'appointment_time' => '14:00',
        ]) + ['patient_id' => $this->patient->patient->id, 'status' => 'pending']);

        $this->actingAs($this->patient)
            ->post(route('appointments.store'), $this->payload([
                'appointment_date' => $date,
                'appointment_time' => '14:00',
            ]))
            ->assertSessionHas('error');
    }

    public function test_day_is_capped_at_fifteen(): void
    {
        $date = $this->workingDate();

        // Fill 15 distinct slots.
        for ($i = 0; $i < 15; $i++) {
            Appointment::create($this->payload([
                'appointment_date' => $date,
                'appointment_time' => sprintf('%02d:%02d', 8 + intdiv($i, 2), ($i % 2) * 30),
            ]) + ['patient_id' => $this->patient->patient->id, 'status' => 'confirmed']);
        }

        $this->actingAs($this->patient)
            ->post(route('appointments.store'), $this->payload([
                'appointment_date' => $date,
                'appointment_time' => '17:45',
            ]))
            ->assertSessionHas('error');
    }
}
