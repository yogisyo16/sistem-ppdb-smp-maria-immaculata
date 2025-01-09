<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Seleksi extends Model
{
    protected $table = 'seleksi';
    protected $primaryKey = 'seleksi_id';

    protected $fillable = [
        'user_id',
        'pendaftaran_id',
        'dokumen_id',
        'pembayaran_id',
        'hasil_jalur_pendaftaran',
        'isLulus'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function pendaftaran(): BelongsTo
    {
        return $this->belongsTo(Pendaftaran::class);
    }
    public function dokumen(): BelongsTo
    {
        return $this->belongsTo(Dokumen::class);
    }
}
