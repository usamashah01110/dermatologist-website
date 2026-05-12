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
        Schema::table('reviews', function (Blueprint $table) {
            $table->foreignId('dermatologist_id')
                ->nullable()
                ->after('id')
                ->constrained('dermatologists')
                ->onDelete('cascade');

            $table->foreignId('patient_id')
                ->nullable()
                ->after('dermatologist_id')
                ->constrained('patients')
                ->onDelete('set null');

            $table->unsignedTinyInteger('rating')->default(5)->after('patient_id');

            $table->enum('status', ['pending', 'approved', 'rejected'])
                ->default('approved')
                ->after('location');

            $table->index(['dermatologist_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeign(['dermatologist_id']);
            $table->dropForeign(['patient_id']);
            $table->dropColumn(['dermatologist_id', 'patient_id', 'rating', 'status']);
        });
    }
};
