<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sale_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('unit');
            $table->decimal('price', 5, 2);
            $table->decimal('sub_total', 5, 2);
            $table->decimal('discount', 5, 2);
            $table->decimal('base_iva_0', 5, 2);
            $table->decimal('base_iva_12', 5, 2);
            $table->decimal('total', 5, 2);
            $table->timestamps();
            $table->boolean('status')->default(true);
            $table->foreign('sale_id')->references('id')->on('sales');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_sales');
    }
}
