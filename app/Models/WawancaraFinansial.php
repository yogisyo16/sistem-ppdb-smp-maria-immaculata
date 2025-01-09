<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WawancaraFinansial extends Model
{
    protected $table = 'wawancara_finansial';
    protected $primaryKey = 'wawancara_finansial_id';

    protected $fillable = [
        'user_id',
        'wawancara_id',
        'hsl_udp',
        'hsl_spp',
        'hsl_ups',
        'hsl_uang_seragam',
        'hsl_uang_kegiatan',
        'hsl_uang_alat',
        'pembayaran_udp',
        'pembayaran_spp',
        'pembayaran_ups',
        'pembayaran_uang_seragam',
        'pembayaran_uang_kegiatan',
        'pembayaran_uang_alat',
        'total_tunai',
        'total_dibayar',
        'total_uang',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function wawancara(): BelongsTo
    {
        return $this->belongsTo(Wawancara::class);
    }
}
