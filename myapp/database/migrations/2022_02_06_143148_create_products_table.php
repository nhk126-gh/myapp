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
            $table->char('address', 5)->unique();
            $table->string('supplier_code')->nullable();
            $table->string('seban')->nullable();
            $table->string('hinban');
            $table->bigInteger('quantity');
            $table->string('store')->nullable();
            $table->string('box_type')->nullable();

            $table->foreign('supplier_code')->references('supplier_code')->on('suppliers')->onUpdate('SET NULL')->onDelete('SET NULL');
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
