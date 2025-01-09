<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Wawancara extends Model
{
    protected $table = 'wawancara';
    protected $primaryKey = 'wawancara_id';

    protected $fillable = [
        'user_id',
        'seleksi_id',
        'nama_pewawancara',
        'waktu_wawancara',
        'tgl_wawancara',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function seleksi(): BelongsTo
    {
        return $this->belongsTo(Seleksi::class);
    }
}
