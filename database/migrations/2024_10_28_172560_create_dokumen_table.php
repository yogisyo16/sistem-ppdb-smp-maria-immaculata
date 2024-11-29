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
        Schema::create('dokumen', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->index()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->bigInteger('pendaftaran_id')->unsigned()->index()->nullable();
            $table->foreign('pendaftaran_id')->references('id')->on('pendaftaran')->onDelete('cascade');

            $table->bigInteger('pembayaran_id')->unsigned()->index()->nullable();
            $table->foreign('pembayaran_id')->references('id')->on('pembayaran')->onDelete('cascade');

            // Kebutuhan Pribadi
            $table->string('file_foto_terbaru')->nullable();

            $table->string('file_kartu_keluarga')->nullable();

            $table->string('file_akta_kelahiran')->nullable();


            // Kebutuhan Dokumen Ortu dan Wali
            $table->string('file_ktp_orang_tua_ayah')->nullable();

            $table->string('file_ktp_orang_tua_ibu')->nullable();

            $table->string('file_ktp_orang_tua_wali')->nullable();

            // Kebutuhan Sekolah
            $table->string('file_rapor_kelasv_semester1')->nullable();

            $table->string('file_rapor_kelasv_semester2')->nullable();

            // File yang perlu diupload setelah kelulusan dan mendapatkan berkasnya
            $table->string('file_surat_keterangan_lulus')->nullable();

            $table->string('file_ijazah')->nullable();

            // Informasi ASPD jika di DIY
            $table->string('file_sertifikat_aspd')->nullable();

            // Kebutuhan Pemilihan Jalur Pendaftaran
            $table->json('file_sertifikat_kejuaraan')->nullable();

            // File jika Punya
            $table->string('file_kms_kip')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen');
    }
};
