<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_kartu',
        'tanggal',
        'jenis_pemasukan',
        'jumlah',
        'payment_id', // Tambahkan payment_id ke fillable
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'no_kartu', 'no_kartu');
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }
}