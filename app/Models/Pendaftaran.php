<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class Pendaftaran extends Model
{
    protected $table = 'pendaftaran';
    protected $primaryKey = 'pendaftaran_id';

    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'tanggal_lahir',
        'tempat_lahir',
        'nohp',
        'anak_ke',
        'jumlah_saudara',
        'jenis_kelamin',
        'agama',
        'jalur_pendaftaran',

        // Alamat
        'alamat_tinggal_c1_kk',
        'alamat_tmpt_tinggal',

        // Informasi Sekolah
        'nisn',
        'nama_sekolah_sd',
        'alamat_sekolah_sd',
        'status_sekolah_sd',
        'is_diy',

        // Nilai Sekolah
        'nilai_rapot_matematika_klsv_smt1',
        'nilai_rapot_bhsindo_klsv_smt1',
        'nilai_rapot_ipa_klsv_smt1',
        'nilai_rapot_ips_klsv_smt1',
        'nilai_rapot_matematika_klsv_smt2',
        'nilai_rapot_bhsindo_klsv_smt2',
        'nilai_rapot_ipa_klsv_smt2',
        'nilai_rapot_ips_klsv_smt2',
        'nilai_rapot_matematika_klsvi_smt1',
        'nilai_rapot_bhsindo_klsvi_smt1',
        'nilai_rapot_ipa_klsvi_smt1',
        'nilai_rapot_ips_klsvi_smt1',

        //Jika Bersekolah di DIY
        'nilai_literasi_membaca_aspd',
        'nilai_literasi_numerasi_aspd',
        'nilai_literasi_sains_aspd',

        //Informasi Ayah
        'nama_ayah',
        'email_ayah',
        'alamat_ayah',
        'no_telpon_ayah',
        'pendidikan_terakhir_ayah',
        'pekerjaan_ayah',
        'penghasilan_ayah',

        //Informasi ibu
        'nama_ibu',
        'email_ibu',
        'alamat_ibu',
        'no_telpon_ibu',
        'pendidikan_terakhir_ibu',
        'pekerjaan_ibu',
        'penghasilan_ibu',

        //Informasi Wali
        'nama_wali',
        'alamat_wali',
        'no_telpon_wali',
        'pendidikan_terakhir_wali',
        'pekerjaan_wali',
        'penghasilan_wali',
        // Upload File
        'file_bukti_pembayaran_pendaftaran'
    ];    
    
    public function user(): BelongsTo{

        return $this->belongsTo(User::class);
    }
}
