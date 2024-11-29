<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sistem extends Model
{
    protected $table = 'sistem';
    protected $primaryKey = 'sistem_id';

    protected $fillable = [
        'user_id',
        'pendaftaran_id',
        'dokumen_id',
        'pembayaran_id',
        'seleksi_id',
        'periodic_id',
        
    ];
    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class);
    }

    public function dokumen()
    {
        return $this->belongsTo(Dokumen::class);
    }

    public function pembayaran()
    {
        return $this->belongsTo(Pembayaran::class);
    }

    public function seleksi()
    {
        return $this->belongsTo(Seleksi::class);
    }

    public function periodic()
    {
        return $this->belongsTo(Periodic::class);
    }
}
