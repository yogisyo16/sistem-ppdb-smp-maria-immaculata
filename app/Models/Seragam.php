<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Seragam extends Model
{
    protected $table = 'seragam';
    protected $primaryKey = 'seragam_id';

    protected $fillable = [
        'user_id',
        'wawancara_id',
        'pengambilan_seragam',
        'waktu_pengambilan_seragam',
        'seragam_senin',
        'seragam_selasa',
        'seragam_rabu',
        'seragam_kamis',
        'seragam_jumat',
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
