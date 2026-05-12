<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('patient_id')
                ->constrained('patients')
                ->onDelete('cascade');

            $table->foreignId('dermatologist_id')
                ->constrained('dermatologists')
                ->onDelete('cascade');

            $table->string('patient_name');
            $table->string('patient_email');
            $table->string('patient_phone');
            $table->enum('preferred_contact', ['phone', 'email', 'whatsapp'])->default('phone');
            $table->boolean('is_new_patient')->default(false);

            $table->enum('appointment_type', ['consultation', 'follow_up', 'treatment', 'emergency']);
            $table->date('appointment_date');
            $table->time('appointment_time');

            $table->string('concern_category')->nullable();
            $table->text('notes')->nullable();

            $table->enum('status', ['pending', 'confirmed', 'completed', 'cancelled'])
                ->default('pending');

            $table->timestamps();

            $table->index(['dermatologist_id', 'appointment_date']);
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
