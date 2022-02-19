<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Menu;
use App\Models\Order;

class Detail extends Model
{
    protected $fillable = [
        'idetail', 'idmenu', 'idorder',
        'jumlah', 'hargajual',
    ];

    // public function Menu()
    // {
    //     return $this->belongsTo(Menu::class, 'idmenu', 'idmenu');
    // }

    // public function Order()
    // {
    //     return $this->belongsTo(Order::class, 'idorder', 'idorder');
    // }
}
