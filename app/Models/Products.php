<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    public function scopeProductsActive($query)
    {
        return $query->where('status', '=', true)
            ->select('id', 'description', 'unit', 'generic', 'pvpr', 'pvpu', 'pvpc', 'utility');
    }

    public function laboratory()
    {
        return $this->belongsTo(Laboratories::class, 'laboratorie_id', 'id');
    }
    public function public()
    {
        return $this->belongsTo(Publics::class, 'type_public_id', 'id');
    }
    public function productTypes()
    {
        return $this->belongsTo(ProductTypes::class, 'product_type_id', 'id');
    }
    public function movements()
    {
        return $this->belongsToMany(Movements::class, 'inventory_movements', 'product_id', 'movement_id');
    }
}
