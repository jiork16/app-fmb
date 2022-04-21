<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
    public function scopeTotalVendido($query, $fechaDesde = '', $fechaHasta = ''){
        $query->where(
            'status',
            '=',
            true
        )->when($fechaDesde != '' && $fechaHasta == '', function ($query)  use ($fechaDesde) {
            return $query->where('date_sale', '=', date_format(Carbon::parse($fechaDesde), 'Y-m-d'));
        })->when($fechaDesde != '' && $fechaHasta != '', function ($query)  use ($fechaDesde, $fechaHasta) {
            return $query->where([
                ['date_sale', '>=', date_format(Carbon::parse($fechaDesde), 'Y-m-d')],
                ['date_sale', '<=', date_format(Carbon::parse($fechaHasta), 'Y-m-d')]
            ]);
        })->when($fechaDesde == '' && $fechaHasta == '', function ($query) {
            return $query->where(
                'date_sale',
                '=',
                date_format(Carbon::parse(now()), 'Y-m-d')
            );
        })->select(DB::raw('IFNULL(sum(total),0) totalVendido'));
        return $query;
    }
    public function scopeSales($query, $fechaDesde = '', $fechaHasta = '')
    {
        $query->where(
            'status',
            '=',
            true
        )->when($fechaDesde != '' && $fechaHasta == '', function ($query)  use ($fechaDesde) {
            return $query->where('date_sale', '=', date_format(Carbon::parse($fechaDesde), 'Y-m-d'));
        })->when($fechaDesde != '' && $fechaHasta != '', function ($query)  use ($fechaDesde, $fechaHasta) {
            return $query->where([
                ['date_sale', '>=', date_format(Carbon::parse($fechaDesde), 'Y-m-d')],
                ['date_sale', '<=', date_format(Carbon::parse($fechaHasta), 'Y-m-d')]
            ]);
        })->when($fechaDesde == '' && $fechaHasta == '', function ($query) {
            return $query->where(
                'date_sale',
                '=',
                date_format(Carbon::parse(now()), 'Y-m-d')
            );
        });
        return $query;
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
