<?php

namespace App\Http\Controllers\backend\import_data;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Config;
use App\Models\Importdata;
use App\Imports\ImportBrands;
use Excel;
class ImportdataController extends Controller
{
    function __construct()
    {
            $this->middleware('admin');
    }

    public function import_brands(){
        $data['title'] = Config::get('constants.SYSTEM_NAME') . ' || Import Brand Details';
        $data['description'] = Config::get('constants.SYSTEM_NAME') . ' || Import Brand Details';
        $data['keywords'] = Config::get('constants.SYSTEM_NAME') . ' || Import Brand Details';
        $data['css'] = array(
            'toastr/toastr.min.css'
        );
        $data['plugincss'] = array(
        );
        $data['pluginjs'] = array(
            'toastr/toastr.min.js',
            'plugins/validate/jquery.validate.min.js',            
        );
        $data['js'] = array(
            'comman_function.js',
            'ajaxfileupload.js',
            'jquery.form.min.js',
            'import_brands.js',
        );
        $data['funinit'] = array(
            'Import_brands.init()'
        );
        $data['header'] = array(
            'title' => 'Import Brand Details',
            'breadcrumb' => array(
                'Reports ' => route('my-report'),
                'Mobile Number List' => route('mobile-number-list'),
                'Import Brand Details' => 'Import Brand Details',
            )
        );
        return view('backend.pages.import_brand.list', $data);
    }


    public function import_brands_save(Request $request){
        
        $path = $request->file('file')->store('temp');
        $data = Excel::import(new ImportBrands($request->input('file')),$path);
        
        $return['status'] = 'success';
        $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");';
        $return['message'] = 'Brand entry list added successfully.';
        $return['redirect'] = route('brand-entry-list');

        echo json_encode($return);
        exit;
    }
}
