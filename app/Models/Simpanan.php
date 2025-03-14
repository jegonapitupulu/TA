<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Simpanan extends Model
{
    protected $fillable = [
        'user_id',
        'jenis_simpan_id',
        'tanggal_simpan',
        'admin_id',
    ];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    // Define the relationship with the JenisSimpanan model
    public function jenisSimpanan()
    {
        return $this->belongsTo(jenis_simpanan::class, 'jenis_simpan_id');
    }
}
