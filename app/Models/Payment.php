<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_kartu',
        'jenis_langganan',
        'harga',
        'status',
        'tanggal_pembayaran',
    ];

    protected $casts = [
        'tanggal_pembayaran' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'no_kartu', 'no_kartu');
    }

    public function laporan()
    {
        return $this->hasOne(Laporan::class, 'payment_id');
    }
}