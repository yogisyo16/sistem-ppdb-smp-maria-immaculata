<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Periodic extends Model
{
    protected $table = 'periodic';
    protected $primaryKey = 'periodic_id';
    
    protected $fillable = [
        'tahun_ajaran',
    ];
}
