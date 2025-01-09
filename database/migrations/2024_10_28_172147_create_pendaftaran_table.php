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
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->index()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Informasi Pribadi
            $table->string('nama_lengkap')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->string('nohp')->nullable();
            $table->string('anak_ke')->nullable();
            $table->string('jumlah_saudara')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('agama')->nullable();
            $table->string('jalur_pendaftaran')->nullable();

            // Alamat
            $table->string('alamat_tinggal_c1_kk')->nullable();
            $table->string('alamat_tmpt_tinggal')->nullable();

            // Informasi Sekolah
            $table->string('nisn')->nullable();
            $table->string('nama_sekolah_sd')->nullable();
            $table->string('alamat_sekolah_sd')->nullable();
            $table->string('status_sekolah_sd')->nullable();
            $table->boolean('is_diy')->default('0');
            $table->float('nilai_rapot_matematika_klsv_smt1')->nullable();
            $table->float('nilai_rapot_bhsindo_klsv_smt1')->nullable();
            $table->float('nilai_rapot_ipa_klsv_smt1')->nullable();
            $table->float('nilai_rapot_ips_klsv_smt1')->nullable();
            $table->float('nilai_rapot_matematika_klsv_smt2')->nullable();
            $table->float('nilai_rapot_bhsindo_klsv_smt2')->nullable();
            $table->float('nilai_rapot_ipa_klsv_smt2')->nullable();
            $table->float('nilai_rapot_ips_klsv_smt2')->nullable();
            $table->float('nilai_rapot_matematika_klsvi_smt1')->nullable();
            $table->float('nilai_rapot_bhsindo_klsvi_smt1')->nullable();
            $table->float('nilai_rapot_ipa_klsvi_smt1')->nullable();
            $table->float('nilai_rapot_ips_klsvi_smt1')->nullable();

            // Jika bersekolah di DIY
            $table->float('nilai_literasi_membaca_aspd')->nullable();
            $table->float('nilai_literasi_numerasi_aspd')->nullable();
            $table->float('nilai_literasi_sains_aspd')->nullable();

            // Informasi Orang Tua dan Wali

            // Informasi Ayah
            $table->string('nama_ayah')->nullable();
            $table->string('email_ayah')->nullable();
            $table->string('alamat_ayah')->nullable();
            $table->string('no_telpon_ayah')->nullable();
            $table->string('pendidikan_terakhir_ayah')->nullable();
            $table->string('pekerjaan_ayah')->nullable();
            $table->string('penghasilan_ayah')->nullable();

            // Informasi Ibu
            $table->string('nama_ibu')->nullable();
            $table->string('email_ibu')->nullable();
            $table->string('alamat_ibu')->nullable();
            $table->string('no_telpon_ibu')->nullable();
            $table->string('pendidikan_terakhir_ibu')->nullable();
            $table->string('pekerjaan_ibu')->nullable();
            $table->string('penghasilan_ibu')->nullable();

            //Informasi Wali
            $table->string('nama_wali')->nullable();
            $table->string('alamat_wali')->nullable();
            $table->string('no_telpon_wali')->nullable();
            $table->string('pendidikan_terakhir_wali')->nullable();
            $table->string('pekerjaan_wali')->nullable();
            $table->string('penghasilan_wali')->nullable();

            //Upload File Pembayaran
            $table->string('file_bukti_pembayaran_pendaftaran')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran');
    }
};
