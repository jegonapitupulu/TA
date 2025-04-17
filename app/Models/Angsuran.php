<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Angsuran extends Model
{
    protected $fillable = [
        'pinjaman_id',
        'jumlah_angsuran',
        'tanggal_angsuran',
    ];

    /**
     * Define a relationship to the Pinjaman model.
     */
    public function pinjaman()
    {
        return $this->belongsTo(Pinjaman::class, 'pinjaman_id');
    }
}
