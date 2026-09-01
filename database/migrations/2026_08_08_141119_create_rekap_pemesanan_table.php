<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rekap_pemesanan', function (Blueprint $table) {

            $table->id();

            // Booking dari sistem boleh memiliki relasi,
            // sedangkan pesanan luar sistem boleh NULL
            $table->unsignedBigInteger('booking_id')->nullable();

            $table->string('nama_pemesan');
            $table->string('nama_pengantin')->nullable();
            $table->string('paket');
            $table->date('tanggal_acara');
            $table->text('lokasi_acara')->nullable();

            $table->decimal('total_harga', 12, 2)->default(0);
            $table->decimal('nominal_dp', 12, 2)->default(0);
            $table->decimal('nominal_pelunasan', 12, 2)->default(0);

            $table->enum('status', ['Selesai'])->default('Selesai');

            $table->timestamps();

            $table->foreign('booking_id')
                ->references('id')
                ->on('bookings')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rekap_pemesanan');
    }
};
