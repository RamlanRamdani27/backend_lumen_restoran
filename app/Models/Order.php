<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pelanggan;
use App\Models\Detail;

class Order extends Model
{
    protected $fillable = [
        'bayar', 'total', 'kembali'
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'idpelanggan', 'idpelanggan');
    }

    // public function detailMenus()
    // {
    //     return $this->belongsToMany(Detail::class, 'idmenu', 'idmenu');
    // }
}
