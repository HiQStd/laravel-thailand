<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThaiAddressTables extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableNames = config('thai_address.table_names');

        Schema::create($tableNames['province'], function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create($tableNames['district'], function (Blueprint $table) use ($tableNames) {
            $table->increments('id');
            $table->string('name');
            $table->integer('province_id')->unsigned();
            $table->timestamps();

            $table->foreign('province_id')->references('id')->on($tableNames['province'])
                ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create($tableNames['sub_district'], function (Blueprint $table) use ($tableNames) {
            $table->increments('id');
            $table->string('name');
            $table->integer('district_id')->unsigned();
            $table->timestamps();

            $table->foreign('district_id')->references('id')->on($tableNames['district'])
                ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create($tableNames['postal_code'], function (Blueprint $table) use ($tableNames) {
            $table->increments('id');
            $table->integer('code');
            $table->integer('sub_district_id')->unsigned();
            $table->integer('district_id')->unsigned();
            $table->integer('province_id')->unsigned();
            $table->timestamps();

            $table->foreign('sub_district_id')->references('id')->on($tableNames['sub_district'])
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('district_id')->references('id')->on($tableNames['district'])
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('province_id')->references('id')->on($tableNames['province'])
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $tableNames = config('thai_address.table_names');

        Schema::dropIfExists($tableNames['province']);
        Schema::dropIfExists($tableNames['district']);
        Schema::dropIfExists($tableNames['sub_district']);
        Schema::dropIfExists($tableNames['postal_code']);
    }

}
