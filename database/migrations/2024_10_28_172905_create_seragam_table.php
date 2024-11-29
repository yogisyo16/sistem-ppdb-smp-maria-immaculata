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
        Schema::create('seragam', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('user_id')->unsigned()->index()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->bigInteger('wawancara_id')->unsigned()->index()->nullable();
            $table->foreign('wawancara_id')->references('id')->on('wawancara')->onDelete('cascade');
            
            $table->date('pengambilan_seragam')->nullable();
            $table->time('waktu_pengambilan_seragam')->nullable();
            $table->boolean('seragam_senin')->nullable();
            $table->boolean('seragam_selasa')->nullable();
            $table->boolean('seragam_rabu')->nullable();
            $table->boolean('seragam_kamis')->nullable();
            $table->boolean('seragam_jumat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seragam');
    }
};
