<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->string('payment_type');
            $table->integer('checkout_status');
            $table->string('phone_number');
            $table->string('ward');
            $table->string('city');
            $table->string('district');
            $table->integer('user_id');
            $table->text('details_address');
            $table->text('note_shipping');
            $table->string('name');
            $table->string('subtotal');
            $table->softDeletes();
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
        Schema::dropIfExists('orders');
    }
}
