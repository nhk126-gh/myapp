<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConnectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('connects', function (Blueprint $table) {
            $table->id();
            $table->string('comment');
            $table->char('before', 5);
            $table->char('after', 5);
            $table->timestamps();

            $table->foreign('before')->references('address')->on('products')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('after')->references('address')->on('products')->onUpdate('CASCADE')->onDelete('CASCADE');

            $table->unique(['before', 'after']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('connects');
    }
}
