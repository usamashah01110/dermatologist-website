<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
$appointments = App\Models\Appointment::with(['patient.user','dermatologist.user'])->get();
echo 'COUNT=' . $appointments->count() . "\n";
foreach ($appointments as $appt) {
    echo implode('|', [
        $appt->id,
        $appt->patient_name,
        $appt->patient_email,
        $appt->patient_phone,
        $appt->dermatologist?->user?->name ?? 'NULL',
        $appt->dermatologist_id,
        $appt->status,
        $appt->appointment_date->format('Y-m-d'),
        $appt->appointment_time,
    ]) . "\n";
}
