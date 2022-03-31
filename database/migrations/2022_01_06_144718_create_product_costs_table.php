<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_costs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('supplier_id');
            $table->decimal('cost', 5, 2);
            $table->decimal('unit_cost', 5, 2);
            $table->decimal('discount', 5, 2);
            $table->decimal('total_value', 5, 2);
            $table->decimal('base_iva_cost', 5, 2);
            $table->decimal('unit_base_iva_cost', 5, 2);
            $table->decimal('pvp_unit_porcent', 5, 2);
            $table->decimal('gain_unit_porcent', 5, 2);
            $table->decimal('pvp_unit_real', 5, 2);
            $table->decimal('gain_box_real', 5, 2);
            $table->decimal('pvp_box_porcent', 5, 2);
            $table->decimal('gain_box_porcent', 5, 2);
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('supplier_id')->references('id')->on('suppliers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_costs');
    }
}
