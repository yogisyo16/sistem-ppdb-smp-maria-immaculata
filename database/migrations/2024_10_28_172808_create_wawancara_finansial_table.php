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
        Schema::create('wawancara_finansial', function (Blueprint $table) {
            $table->id();
            
            $table->bigInteger('user_id')->unsigned()->index()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->bigInteger('wawancara_id')->unsigned()->index()->nullable();
            $table->foreign('wawancara_id')->references('id')->on('wawancara')->onDelete('cascade');

            $table->text('hsl_udp')->nullable();
            $table->text('hsl_spp')->nullable();
            $table->text('hsl_ups')->nullable();
            $table->text('hsl_uang_seragam')->nullable();
            $table->text('hsl_uang_kegiatan')->nullable();
            $table->text('hsl_uang_alat')->nullable();
            $table->text('pembayaran_udp')->nullable();
            $table->text('pembayaran_spp')->nullable();
            $table->text('pembayaran_ups')->nullable();
            $table->text('pembayaran_uang_seragam')->nullable();
            $table->text('pembayaran_uang_kegiatan')->nullable();
            $table->text('pembayaran_uang_alat')->nullable();
            $table->text('total_tunai')->nullable();
            $table->text('total_dibayar')->nullable();
            $table->text('total_uang')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wawancara_finansial');
    }
};
