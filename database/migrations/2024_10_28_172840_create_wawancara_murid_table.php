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
        Schema::create('wawancara_murid', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('user_id')->unsigned()->index()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->bigInteger('wawancara_id')->unsigned()->index()->nullable();
            $table->foreign('wawancara_id')->references('id')->on('wawancara')->onDelete('cascade');
            
            $table->string('penilaian_wawancara_anak');
            $table->text('catatan_wawancara_anak');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wawancara_murid');
    }
};
