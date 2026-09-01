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
        Schema::create('rekap_pembayaran', function (Blueprint $table) {

            $table->id();

            $table->foreignId('booking_id')
                ->constrained('bookings')
                ->onDelete('cascade');

            // DP yang sudah dibayar customer
            $table->decimal('nominal_dp',12,2)->default(0);

            // Opsional
            $table->decimal('nominal_pelunasan',12,2)->nullable();

            $table->date('tanggal_pelunasan')->nullable();

            $table->enum('status_pelunasan',[
                'Belum Lunas',
                'Lunas'
            ])->default('Belum Lunas');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekap_pembayaran');
    }
};
