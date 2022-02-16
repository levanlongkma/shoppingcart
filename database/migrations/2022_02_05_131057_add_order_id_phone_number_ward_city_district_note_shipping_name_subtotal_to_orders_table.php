<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrderIdPhoneNumberWardCityDistrictNoteShippingNameSubtotalToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('order_id')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('ward')->nullable();
            $table->string('city')->nullable();
            $table->string('district')->nullable();
            $table->text('note_shipping')->nullable();
            $table->string('name')->nullable();
            $table->string('subtotal')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('order_id');
            $table->dropColumn('phone_number');
            $table->dropColumn('ward');
            $table->dropColumn('city');
            $table->dropColumn('district');
            $table->dropColumn('note_shipping');
            $table->dropColumn('name');
            $table->dropColumn('subtotal');
        });
    }
}
