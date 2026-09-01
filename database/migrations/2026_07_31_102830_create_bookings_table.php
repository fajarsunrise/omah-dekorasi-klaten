<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {

            $table->id();

            $table->foreignId('paket_id')
                    ->constrained('pakets')
                    ->onDelete('cascade');

            $table->string('kode_booking')->unique();

            $table->string('nama_pemesan');

            $table->string('nama_pengantin');

            $table->string('no_wa');

            $table->date('tanggal_acara');

            $table->text('lokasi_acara');

            $table->text('catatan')->nullable();

            $table->string('username_instagram')->nullable();

            $table->string('bukti_dp')->nullable();

            $table->enum('status',[
                'Menunggu Verifikasi',
                'Diterima',
                'Ditolak',
                'Selesai'
            ])->default('Menunggu Verifikasi');

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
