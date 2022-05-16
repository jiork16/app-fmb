<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->integer('unit');
            $table->boolean('iva')->default(0);
            $table->boolean('generic')->default(1);
            $table->decimal('pvp', 5, 2);
            $table->decimal('pvpu', 5, 2);
            $table->decimal('pvpu_discount', 5, 2);
            $table->decimal('pvpc_discount', 5, 2);
            $table->decimal('porcen_gain', 5, 2);
            $table->decimal('porcen_discount', 5, 2);
            $table->boolean('buy_by_box')->default(1);
            $table->boolean('take_pvpr')->default(1);
            $table->string('utility')->default(1);
            $table->unsignedBigInteger('product_type_id');
            $table->unsignedBigInteger('type_public_id');
            $table->unsignedBigInteger('laboratorie_id');
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->foreign('product_type_id')->references('id')->on('product_types');
            $table->foreign('type_public_id')->references('id')->on('publics');
            $table->foreign('laboratorie_id')->references('id')->on('laboratories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
