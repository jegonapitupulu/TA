<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Angsuran extends Model
{
    protected $fillable = [
        'pinjaman_id',
        'nominal_angsuran', // Mengganti 'jumlah_angsuran' menjadi 'nominal_angsuran' agar konsisten dengan field di form
        'tanggal_angsuran',
        'angsuran_ke', // Menambahkan field 'angsuran_ke'
        'admin_id', // Menambahkan field 'admin_id'
    ];

    /**
     * Define a relationship to the Pinjaman model.
     */
    public function pinjaman()
    {
        return $this->belongsTo(Pinjaman::class, 'pinjaman_id');
    }

    /**
     * Define a relationship to the Admin/User model.
     */
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
