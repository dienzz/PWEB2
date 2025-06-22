<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'no_kartu', 'nama', 'jk', 'alamat', 'tgl_lahir',
        'tgl_mulai', 'tgl_akhir', 'no_hp', 'photo'
    ];

    public function visitors()
    {
        return $this->hasMany(Visitor::class, 'no_kartu', 'no_kartu');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'no_kartu', 'no_kartu');
    }
}