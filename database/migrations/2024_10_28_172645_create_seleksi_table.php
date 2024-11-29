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
        Schema::create('seleksi', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('user_id')->unsigned()->index()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->bigInteger('pendaftaran_id')->unsigned()->index()->nullable();
            $table->foreign('pendaftaran_id')->references('id')->on('pendaftaran')->onDelete('cascade');
            
            $table->bigInteger('dokumen_id')->unsigned()->index()->nullable();
            $table->foreign('dokumen_id')->references('id')->on('dokumen')->onDelete('cascade');

            $table->bigInteger('pembayaran_id')->unsigned()->index()->nullable();
            $table->foreign('pembayaran_id')->references('id')->on('pembayaran')->onDelete('cascade');

            $table->string('hasil_jalur_pendaftaran')->nullable();
            $table->string('isLulus');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seleksi');
    }
};
