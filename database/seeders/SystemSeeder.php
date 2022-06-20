<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class SystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('system_setting')->insert([
                'system_name' =>'Systemname',
                'website_keywords' =>'abc' ,
                'author_name' =>'metronic' ,
                'date_formate' =>'1',
                'decimal_point' => '2',
                'footer_text' =>'metronic',
                'footer_link' => 'metronic',
                'website_description' =>'metronic',
                'website_logo' =>'logo-new.png',
                'favicon_icon' => 'favicon-new.png',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
