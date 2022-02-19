<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Menu;

class Kategori extends Model
{
    protected $fillable = [
        'kategori', 'keterangan',
    ];

    public function menus()
    {
        return $this->hasMany(Menu::class, 'idkategori', 'idkategori');
    }
}
