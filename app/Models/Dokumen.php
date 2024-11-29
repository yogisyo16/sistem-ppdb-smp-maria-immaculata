<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Dokumen extends Model
{
    protected $table = 'dokumen';
    protected $primaryKey = 'dokumen_id';


    protected $fillable = [
        'user_id',

        'pendaftaran_id',

        'pembayaran_id',

        'file_foto_terbaru',
    
        'file_kartu_keluarga',
    
        'file_akta_kelahiran',
    
    
        // Kebutuhan Dokumen Ortu dan Wali
        'file_ktp_orang_tua_ayah',
    
        'file_ktp_orang_tua_ibu',
        
        'file_ktp_orang_tua_wali',
        
        // Kebutuhan Sekolah
        'file_rapor_kelasv_semester1',
        
        'file_rapor_kelasv_semester2',
    
        // File yang perlu diupload setelah kelulusan dan mendapatkan berkasnya
        'file_surat_keterangan_lulus',
    
        'file_ijazah',
    
            // Informasi ASPD jika di DIY
        'file_sertifikat_aspd',
    
        // Kebutuhan Pemilihan Jalur Pendaftaran maupun yang memiliki banyak file sertifikat
        'file_sertifikat_kejuaraan',
        
        // File jika Punya
        'file_kms_kip',
    ];

    protected $casts = [
        'file_sertifikat_kejuaraan' => 'array', // This ensures 'file_sertifikat_kejuaraan' is automatically cast to an array
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function pendaftaran(): BelongsTo
    {
        return $this->belongsTo(Pendaftaran::class);
    }
    public function pembayaran(): BelongsTo
    {
        return $this->belongsTo(Pembayaran::class);
    }
}
