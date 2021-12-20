<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('price')->nullable();
            $table->string('initial_price')->nullable();
            $table->string('sizes')->nullable();
            $table->text('design')->nullable();
            $table->text('details')->nullable();
            $table->text('material')->nullable();
            $table->text('color')->nullable();
            $table->foreignId('product_id')->references('id')->on('products'); 
            $table->foreignId('promotion_id')->references('id')->on('promotions')->nullable();
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
        Schema::dropIfExists('types');
    }
}
