<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMsProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ms_products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('comment');
            $table->Integer('price');
            $table->unsignedInteger('category_id');
            $table->string('image')->nullable();
            $table->unsignedInteger('sort');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ms_products');
    }
}
