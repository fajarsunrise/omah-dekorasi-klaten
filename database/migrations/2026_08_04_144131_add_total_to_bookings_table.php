<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {

            $table->decimal('total_paket',12,2)->default(0);

            $table->decimal('total_addon',12,2)->default(0);

            $table->decimal('total_harga',12,2)->default(0);

            $table->decimal('nominal_dp',12,2)->default(0);

        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {

            $table->dropColumn([

                'total_paket',

                'total_addon',

                'total_harga',

                'nominal_dp'

            ]);

        });
    }
};
