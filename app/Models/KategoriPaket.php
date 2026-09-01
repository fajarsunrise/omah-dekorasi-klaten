<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriPaket extends Model
{
    protected $table = 'kategori_paket';

    protected $fillable = [
        'nama_kategori'
    ];

    public function pakets()
{
    return $this->hasMany(Paket::class, 'kategori_id');
}
}
