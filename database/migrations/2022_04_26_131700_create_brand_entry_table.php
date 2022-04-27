<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandEntryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brand_entry', function (Blueprint $table) {
            $table->id();
            $table->string('brand_name');
            $table->string('url');
            $table->integer('country_code');
            $table->string('mobile_number');
            $table->enum('generate_otp',['Y','N'])->default("N")->comment("Y for yes, N for no");
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
        Schema::dropIfExists('brand_entry');
    }
}
