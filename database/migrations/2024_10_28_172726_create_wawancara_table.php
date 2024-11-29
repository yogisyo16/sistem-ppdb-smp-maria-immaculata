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
        Schema::create('wawancara', function (Blueprint $table) {
            $table->id();
            
            $table->bigInteger('user_id')->unsigned()->index()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->bigInteger('seleksi_id')->unsigned()->index()->nullable();
            $table->foreign('seleksi_id')->references('id')->on('seleksi')->onDelete('cascade');

            $table->string('nama_pewawancara');
            $table->time('waktu_wawancara');
            $table->date('tgl_wawancara');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wawancara');
    }
};
