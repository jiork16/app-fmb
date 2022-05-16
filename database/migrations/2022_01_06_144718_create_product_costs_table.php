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
            $table->decimal('base_iva_cost', 5, 2);
            $table->decimal('unit_base_iva_cost', 5, 2);
            $table->decimal('gain_percentage', 5, 2);
            $table->decimal('real_gain_unit', 5, 2);
            $table->decimal('real_gain_box', 5, 2);
            $table->decimal('real_gain_unit_desc', 5, 2);
            $table->decimal('real_gain_box_desc', 5, 2);
            $table->decimal('date_cal_cost', 5, 2);
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
