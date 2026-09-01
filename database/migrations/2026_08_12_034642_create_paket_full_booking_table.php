<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('paket_full_booking', function (Blueprint $table) {

            $table->id();

            $table->foreignId('paket_id')
                ->constrained('pakets')
                ->cascadeOnDelete();

            $table->date('tanggal_full');

            $table->timestamps();

            // Mencegah tanggal yang sama dimasukkan
            // dua kali untuk paket yang sama
            $table->unique(['paket_id', 'tanggal_full']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('paket_full_booking');
    }
};
