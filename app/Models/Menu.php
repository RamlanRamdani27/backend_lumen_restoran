<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Kategori;
use App\Models\Detail;

class Menu extends Model
{
    protected $fillable = [
        'idkategori', 'menu', 'gambar',
        'harga',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'idkategori', 'idkategori');
    }

    // public function detailOrders()
    // {
    //     return $this->belongsToMany(Detail::class, 'idorder', 'idorder');
    // }
}
