<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public function scopeProductsActive($query, $search)
    {
        return $query->leftJoin('laboratories', function ($join) {
            $join->on('laboratories.id', '=', 'products.laboratorie_id');
        })
            ->where(function ($query) use ($search) {
                $query->where('products.description', 'like', '%' . $search . '%')
                    ->orWhere('products.utility', 'like', '%' . $search . '%')
                    ->orWhere('laboratories.name', 'like', '%' . $search . '%');
            });
    }

    public function laboratory()
    {
        return $this->belongsTo(Laboratory::class, 'laboratorie_id', 'id');
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
    public function detailSales()
    {
        return $this->hasMany(DetailSale::class, 'product_id', 'id');
    }
}
