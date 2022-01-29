<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

<<<<<<<< HEAD:database/migrations/2022_01_19_014121_create_devvn_quanhuyen_table.php
class CreateDevvnQuanhuyenTable extends Migration
========
class CreateProvincesTable extends Migration
>>>>>>>> e649654548714bd2a9ed6578288dddb7b8895d11:database/migrations/2020_01_01_000001_create_provinces_table.php
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
<<<<<<<< HEAD:database/migrations/2022_01_19_014121_create_devvn_quanhuyen_table.php
        Schema::create('devvn_quanhuyen', function (Blueprint $table) {
            $table->id();
            $table->integer('maqh');
            $table->string('name');
            $table->string('type');
            $table->integer('matp');
========
        Schema::create(config('vietnam-zone.tables.provinces'), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('gso_id');
>>>>>>>> e649654548714bd2a9ed6578288dddb7b8895d11:database/migrations/2020_01_01_000001_create_provinces_table.php
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
<<<<<<<< HEAD:database/migrations/2022_01_19_014121_create_devvn_quanhuyen_table.php
        Schema::dropIfExists('devvn_quanhuyen');
========
        Schema::dropIfExists(config('vietnam-zone.tables.provinces'));
>>>>>>>> e649654548714bd2a9ed6578288dddb7b8895d11:database/migrations/2020_01_01_000001_create_provinces_table.php
    }
}
