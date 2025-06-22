<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_kartu',
        'nama',
        'photo',
        'status',
        'waktu_masuk',
        'waktu_keluar',
    ];

    protected $casts = [
        'waktu_masuk' => 'datetime',
        'waktu_keluar' => 'datetime',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'no_kartu', 'no_kartu');
    }
}