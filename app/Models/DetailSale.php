<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailSale extends Model
{
    use HasFactory;
    protected $table = 'detail_sales';
    public $fillable = [
        "sale_id",
        "product_id",
        "unit",
        "price",
        "sub_total",
        "discount",
        "base_iva_0",
        "base_iva_12",
        "total"
    ];
    public function sales()
    {
        return $this->belongsTo(Sale::class, 'sale_id', 'id');
    }
    public function products()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
