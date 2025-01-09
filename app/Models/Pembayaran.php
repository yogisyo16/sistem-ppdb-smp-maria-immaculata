<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';
    protected $primaryKey = 'pembayaran_id';

    protected $fillable = [
        'pendaftaran_id',
        'user_id',
        'itHasFile',
        'isValid'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function pendaftaran():BelongsTo
    {
        return $this->belongsTo(Pendaftaran::class);
    }
}
