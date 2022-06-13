<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsDeletedMobileNumberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mobile_number', function (Blueprint $table) {
            $table->enum('status',['A','I'])->default("A")->comment("A for Active, I for not Inactive")->after('updated_by');
            $table->enum('is_deleted',['Y','N'])->default("N")->comment("Y for deleted, N for not deleted")->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
