<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpOffice\PhpSpreadsheet\Calculation\Statistical\Distributions\F;

class Sale extends Model
{
    use HasFactory;
    public $fillable = [
        "client_id",
        "user_id",
        "form_payment_id",
        "sub_total",
        "discount",
        "base_iva_0",
        "base_iva_12",
        "total",
        "date_sale"
    ];
    public function formPayment()
    {
        return $this->hasOne(FormPayment::class, 'id', 'form_payment_id');
    }
    public function detailSales()
    {
        return $this->hasMany(DetailSale::class, 'sale_id', 'id');
    }
    public function scopeSales($query)
    {
        return $query->where('status', '=', true);
    }
    public function product()
    {
        return $this->hasManyThrough(
            Product::class,
            DetailSale::class,
            'sale_id',
            'id',
            'id',
        );
    }
}
