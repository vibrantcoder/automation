<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Session;
use Route;

class Systemsetting extends Model
{
    use HasFactory;
    protected $table = 'system_setting';

    public function update_system_setting($request){

        $count = Systemsetting::where('system_setting.id', '!=', $request->input('editid'))
               ->count();

        if($count == 0){

            $objSystemsetting = Systemsetting::find($request->input('editid'));
            $objSystemsetting->system_name = $request->input('system_name');
            $objSystemsetting->website_keywords = $request->input('website_keywords');
            $objSystemsetting->author_name = $request->input('author');
            $objSystemsetting->date_formate = $request->input('date_formate');
            $objSystemsetting->decimal_point = $request->input('decimal_point');
            $objSystemsetting->footer_text = $request->input('footer_text');
            $objSystemsetting->footer_link = $request->input('footer_link');
            $objSystemsetting->website_description = $request->input('website_description');


            if($request->file('website_logo')){
                $image = $request->file('website_logo');
                $imagename = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/upload/systemsetting/');
                $image->move($destinationPath, $imagename);
                $objSystemsetting->website_logo = $imagename;

            }
            if($request->file('favicon_icon')){
                $image = $request->file('favicon_icon');
                $imagename = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/upload/systemsetting/');
                $image->move($destinationPath, $imagename);
                $objSystemsetting->favicon_icon = $imagename;

            }

            // if($request->file('login_image')){
            //     $image = $request->file('login_image');
            //     $imagename = time().'.'.$image->getClientOriginalExtension();
            //     $destinationPath = public_path('/upload/systemsetting/');
            //     $image->move($destinationPath, $imagename);
            //     $objSystemsetting->login_logo = $imagename;

            // }

            $objSystemsetting->theme_color = $request->input('theme_color');
            $objSystemsetting->sidebar_color = $request->input('sidebar_color');
            $objSystemsetting->sidebar_menu_color = $request->input('sidebar_menu_color');
            $objSystemsetting->sidebar_menu_active_color = $request->input('sidebar_active_menu_color');
            // $objSystemsetting->login_background_color = $request->input('login_background_color');
            $objSystemsetting->sidebar_navbar_background_color = $request->input('sidebar_navbar_background_color');
            $objSystemsetting->sidebar_navbar_font_color = $request->input('sidebar_navbar_font_color');
            $objSystemsetting->header_navbar_background_color = $request->input('header_navbar_background_color');
            $objSystemsetting->header_navbar_font_color = $request->input('header_navbar_font_color');

            $objSystemsetting->updated_at = date("Y-m-d H:i:s");
            if($objSystemsetting->save()){

                $currentRoute = Route::current()->getName();
                $inputData = $request->input();
                unset($inputData['_token']);
                $objAudittrails = new Audittrails();
                $res = $objAudittrails->add_audit('Edit','admin/'. $currentRoute , json_encode($inputData) ,' Systemsetting' );
                return "true";
            }
            return "false";
        }
        return "false" ;
    }

    public function get_system_setting_details(){
            return Systemsetting::select('system_setting.id', 'system_setting.sidebar_navbar_background_color', 'system_setting.sidebar_navbar_font_color', 'system_setting.header_navbar_background_color', 'system_setting.header_navbar_font_color','system_setting.system_name','system_setting.login_background_color','system_setting.login_logo','system_setting.sidebar_menu_active_color','system_setting.theme_color','system_setting.sidebar_color','system_setting.sidebar_menu_color','system_setting.website_keywords','system_setting.author_name','system_setting.footer_text','system_setting.footer_link','system_setting.website_description','system_setting.website_logo','system_setting.favicon_icon','system_setting.decimal_point','system_setting.date_formate')
            ->get()
            ->toArray();
        }

    public function get_system_setting_detail(){
        return Systemsetting::select('system_setting.system_name','system_setting.sidebar_navbar_background_color', 'system_setting.sidebar_navbar_font_color', 'system_setting.header_navbar_background_color', 'system_setting.header_navbar_font_color','system_setting.sidebar_menu_active_color','system_setting.login_background_color','system_setting.login_logo', 'system_setting.website_keywords','system_setting.theme_color','system_setting.sidebar_color','system_setting.sidebar_menu_color', 'system_setting.author_name', 'system_setting.footer_text', 'system_setting.footer_link', 'system_setting.website_logo', 'system_setting.favicon_icon', 'system_setting.website_description', 'system_setting.id')
        ->first();
    }
}
