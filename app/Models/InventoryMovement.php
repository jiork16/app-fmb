<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InventoryMovement extends Model
{
    use HasFactory;
    public $fillable = [
        "product_id",
        "movement_id",
        "box",
        "unit",
        "total",
        "date_movement"
    ];
    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function scopeMaxiInvent($query)
    {
        return $query->select(DB::raw('max(inventory_movements.date_movement) AS fecha'))
            ->where('movement_id', '=', '7');
    }
    public function scopeStock($query, $fecha, $search = '', $idProducto = 0, $orderBy = 'products.description', $orderAsc = true)
    {
        $movimientoS = InventoryMovement::join('movements', 'movements.id', '=', 'inventory_movements.movement_id')
            ->join('products', 'products.id', '=', 'inventory_movements.product_id')
            ->where([
                ["movements.action", "=", "S"],
                ['products.status', '=', true],
                ['inventory_movements.date_movement', '>=', $fecha],
                ['inventory_movements.status', '=', true]
            ])->when($idProducto > 0, function ($query)  use ($idProducto) {
                return $query->where('inventory_movements.product_id', $idProducto);
            })
            ->select(
                'inventory_movements.product_id',
                DB::raw('sum(inventory_movements.box) AS sbox, sum(inventory_movements.total) AS sunit')
            )
            ->groupBy(
                'inventory_movements.product_id',
                'inventory_movements.date_movement',
            );
        $movimientoR = InventoryMovement::join('movements', 'movements.id', '=', 'inventory_movements.movement_id')
            ->join('products', 'products.id', '=', 'inventory_movements.product_id')
            ->where([
                ["movements.action", "=", "R"],
                ['products.status', '=', true],
                ['inventory_movements.date_movement', '>=', $fecha],
                ['inventory_movements.status', '=', true]
            ])->when($idProducto > 0, function ($query)  use ($idProducto) {
                return $query->where('inventory_movements.product_id', $idProducto);
            })
            ->select(
                'inventory_movements.product_id',
                DB::raw('sum(inventory_movements.box) AS rbox, sum(inventory_movements.total) AS runit')
            )
            ->groupBy(
                'inventory_movements.product_id',
                'inventory_movements.date_movement',
            );
        $query = $query->join('products', 'products.id', '=', 'inventory_movements.product_id')
            ->joinSub($movimientoS, 'movimientoS', function ($join) {
                $join->on('inventory_movements.product_id', '=', 'movimientoS.product_id');
            })
            ->leftJoinSub($movimientoR, 'movimientoR', function ($join) {
                $join->on('inventory_movements.product_id', '=', 'movimientoR.product_id');
            })->select(
                'inventory_movements.product_id',
                'products.pvp',
                'products.pvpu',
                'products.pvpu_discount',
                'products.pvpc_discount',
                'products.description',
                DB::raw('
                ((movimientoS.sunit - IFNULL(movimientoR.runit,0)) % products.unit)AS totalStockUnidad,
                CASE 
                    WHEN (movimientoS.sunit - IFNULL(movimientoR.runit,0))<products.unit THEN 
                        0 
                    ELSE
                        TRUNCATE(ABS((movimientoS.sunit - ifnull(movimientoR.runit,0))/products.unit),0) 
                END AS totalStockCaja')
            )
            ->where(function ($query2) use ($search) {
                $query2->where('products.description', 'like', '%' . $search . '%')
                    ->orWhere('products.utility', 'like', '%' . $search . '%');
            })->groupBy(
                'inventory_movements.product_id',
                'products.pvp',
                'products.pvpu',
                'products.pvpu_discount',
                'products.pvpc_discount',
                'products.description',
            );
        return $query->orderBy($orderBy, $orderAsc ? 'asc' : 'desc');
    }
}
