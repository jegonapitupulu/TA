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
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->nullable(); // Kolom role
            $table->string('alamat')->nullable(); // Kolom alamat
            $table->string('hp')->nullable(); // Kolom nomor hp
            $table->date('tmt')->nullable(); // Kolom tanggal mulai kerja (tmt)
            $table->boolean('status')->default(true); // Kolom status (aktif/tidak), default aktif
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'alamat', 'hp', 'tmt', 'status']);
        });
    }
};
