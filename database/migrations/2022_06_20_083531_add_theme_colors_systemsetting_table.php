<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddThemeColorsSystemsettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('system_setting', function (Blueprint $table) {
            $table->string('login_logo')->after('favicon_icon')->nullable();
            $table->string('theme_color')->after('login_logo')->nullable();
            $table->string('sidebar_color')->after('theme_color')->nullable();
            $table->string('sidebar_menu_color')->after('sidebar_color')->nullable();
            $table->string('sidebar_menu_active_color')->after('sidebar_menu_color')->nullable();
            $table->string('login_background_color')->after('sidebar_menu_active_color')->nullable();
            $table->string('sidebar_navbar_background_color')->after('login_background_color')->nullable();
            $table->string('sidebar_navbar_font_color')->after('sidebar_navbar_background_color')->nullable();
            $table->string('header_navbar_background_color')->after('sidebar_navbar_font_color')->nullable();
            $table->string('header_navbar_font_color')->after('header_navbar_background_color')->nullable();
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
