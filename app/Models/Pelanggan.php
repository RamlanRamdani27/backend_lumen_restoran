<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class Pelanggan extends Model
{
    protected $fillable = [
        'pelanggan', 'alamat', 'telp',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'idpelanggan', 'idpelanggan');
    }
}
