<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WawancaraMurid extends Model
{
    protected $table = 'wawancara_murid';
    protected $primaryKey = 'wawancara_murid_id';

    protected $fillable = [
        'user_id',
        'wawancara_id',
        'penilaian_wawancara_anak',
        'catatan_wawancara_anak',
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
