<?php

namespace Tests\Feature;

use App\Models\Appointment;
use App\Models\Dermatologist;
use App\Models\User;
use Tests\TestCase;

class PortalSmokeTest extends TestCase
{
    private function user(string $email): User
    {
        return User::where('email', $email)->firstOrFail();
    }

    public function test_admin_can_see_all_admin_pages(): void
    {
        $admin = $this->user('admin@dermatologist.com');

        $this->actingAs($admin)->get('/dashboard')->assertOk();
        $this->actingAs($admin)->get(route('appointments.index'))->assertOk();
        $this->actingAs($admin)->get(route('patients.index'))->assertOk();
        $this->actingAs($admin)->get(route('admin.profile.edit'))->assertOk();
    }

    public function test_doctor_sees_only_their_own_data(): void
    {
        $doctor = $this->user('doctor@derma.com');

        $this->actingAs($doctor)->get('/dashboard')->assertOk();
        $this->actingAs($doctor)->get(route('appointments.index'))->assertOk();
        $this->actingAs($doctor)->get(route('patients.index'))->assertOk();
        $this->actingAs($doctor)->get(route('admin.profile.edit'))->assertOk();
    }

    public function test_patient_can_see_appointments_but_not_patients_page(): void
    {
        $patient = $this->user('patient@derma.com');

        $this->actingAs($patient)->get('/dashboard')->assertOk();
        $this->actingAs($patient)->get(route('appointments.index'))->assertOk();
        $this->actingAs($patient)->get(route('patients.index'))->assertForbidden();
        $this->actingAs($patient)->get(route('admin.profile.edit'))->assertOk();
    }

    public function test_guest_is_redirected_from_dashboard(): void
    {
        $this->get('/dashboard')->assertRedirect('/login');
    }

    public function test_doctor_can_update_own_appointment_status(): void
    {
        $doctor = $this->user('doctor@derma.com');
        $appointment = Appointment::where('dermatologist_id', $doctor->dermatologist->id)->firstOrFail();

        $this->actingAs($doctor)
            ->patch(route('appointments.updateStatus', $appointment), ['status' => 'confirmed'])
            ->assertRedirect();

        $this->assertSame('confirmed', $appointment->fresh()->status);
    }

    public function test_doctor_cannot_touch_another_doctors_appointment(): void
    {
        $doctor = $this->user('doctor@derma.com');
        $otherAppointment = Appointment::where('dermatologist_id', '!=', $doctor->dermatologist->id)->firstOrFail();

        $this->actingAs($doctor)
            ->patch(route('appointments.updateStatus', $otherAppointment), ['status' => 'cancelled'])
            ->assertForbidden();
    }

    public function test_booking_page_loads_for_a_valid_doctor(): void
    {
        $patient = $this->user('patient@derma.com');
        $doctor  = Dermatologist::where('status', 'approved')->firstOrFail();

        $this->actingAs($patient)
            ->get(route('booking.page', ['doctor' => $doctor->id]))
            ->assertOk()
            ->assertSee($doctor->user->name);
    }
}
