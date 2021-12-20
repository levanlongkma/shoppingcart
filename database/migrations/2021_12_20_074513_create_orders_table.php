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
            $table->text('type')->nullable();
            $table->string('payment_type')->nullable();
            $table->integer('checkout_status')->nullable();
            $table->longText('details_address')->nullable();
            $table->string('time_confirmed_at')->nullable();
            $table->string('time_delivered_at')->nullable();
            $table->string('time_started_deliver')->nullable();
            $table->string('time_deleted_at')->nullable();
            $table->string('problems')->nullable();
            $table->boolean('is_read')->nullable();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('ward_id')->references('id')->on('wards');
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
