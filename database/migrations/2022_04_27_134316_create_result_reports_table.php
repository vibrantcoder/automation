<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('result_reports', function (Blueprint $table) {
            $table->id();
            $table->dateTime('event_time');
            $table->string('result_value');
            $table->string('sender_from');
            $table->string('sender_address');
            $table->string('recipient_code');
            $table->text('text_body');
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
        Schema::dropIfExists('result_reports');
    }
}
