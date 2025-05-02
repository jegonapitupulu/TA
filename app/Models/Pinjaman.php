<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model
{
    protected $fillable = [
        'user_id',
        'admin_id',
        'jenis_pinjaman',
        'tanggal_pinjam',
        'jumlah_pinjaman',
    ];

    /**
     * Relationship with the User model (borrower).
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relationship with the User model (admin).
     */
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    /**
     * Relationship with the Angsuran model.
     */
    public function angsuran()
    {
        return $this->hasMany(Angsuran::class, 'pinjaman_id');
    }
}
