<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    use HasFactory;
    public function products()
    {
        return $this->belongsToMany(products::class, 'inventory_movements', 'movement_id', 'product_id');
    }
}
