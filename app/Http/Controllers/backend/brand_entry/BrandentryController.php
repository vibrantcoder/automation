<?php

namespace App\Http\Controllers\backend\brand_entry;

use App\Http\Controllers\Controller;
use App\Models\Brandentry;
use Illuminate\Http\Request;
use Config;
class BrandentryController extends Controller
{
    function __construct()
    {
            $this->middleware('admin');
    }

    public function list(){
        $data['title'] = Config::get('constants.SYSTEM_NAME') . ' || Brand Entry List' ;
        $data['description'] = Config::get('constants.SYSTEM_NAME') . ' || Brand Entry List' ;
        $data['keywords'] = Config::get('constants.SYSTEM_NAME') . ' || Brand Entry List' ;
        $data['css'] = array(
        );
        $data['plugincss'] = array(
            'plugins/custom/datatables/datatables.bundle.css'
        );
        $data['pluginjs'] = array(
            'plugins/custom/datatables/datatables.bundle.js',
            'js/pages/crud/datatables/data-sources/html.js'
        );
        $data['js'] = array(
            'comman_function.js',
            'ajaxfileupload.js',
            'jquery.form.min.js',
            'brandentry.js',
        );
        $data['funinit'] = array(
            'Brandentry.init()',
        );
        $data['header'] = array(
            'title' => 'Brand Entry List',
            'breadcrumb' => array(
                'My Dashboard' => route('dashboard'),
                'Brand Entry List' => 'Brand Entry List',
            )
        );
        return view('backend.pages.brandentry.list', $data);
    }

    public function add(){
        $data['title'] = Config::get('constants.SYSTEM_NAME') . ' || Add Brand Entry';
        $data['description'] = Config::get('constants.SYSTEM_NAME') . ' || Add Brand Entry';
        $data['keywords'] = Config::get('constants.SYSTEM_NAME') . ' || Add Brand Entry';
        $data['css'] = array(
            'toastr/toastr.min.css'
        );
        $data['plugincss'] = array(
        );
        $data['pluginjs'] = array(
            'toastr/toastr.min.js',
            'plugins/validate/jquery.validate.min.js',
            // 'pages/crud/forms/widgets/bootstrap-switch.js',
        );
        $data['js'] = array(
            'comman_function.js',
            'ajaxfileupload.js',
            'jquery.form.min.js',
            'brandentry.js',
        );
        $data['funinit'] = array(
            'Brandentry.add()'
        );
        $data['header'] = array(
            'title' => 'Add Brand Entry',
            'breadcrumb' => array(
                'My Dashboard' => route('dashboard'),
                'Brand Entry List' => route('brand-entry-list'),
                'Add Brand Entry' => 'Add Brand Entry',
            )
        );
        return view('backend.pages.brandentry.add', $data);
    }

    public function add_brand_entry(Request $request){
        $objBrandentry = new Brandentry();
        $result = $objBrandentry->add_brand_entry($request);

        if ($result == "true") {
            $return['status'] = 'success';
            $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
            $return['message'] = 'Brand entry successfully added.';
            $return['redirect'] = route('brand-entry-list');
        }else{
            if ($result == "record_exits") {
                $return['status'] = 'warning';
                $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
                $return['message'] = 'Brand entry record already exits';
            }else{
                $return['status'] = 'error';
                $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
               $return['message'] = 'Something goes to wrong';
            }

        }
        echo json_encode($return);
        exit;
    }

    public function edit($editId){
        $objBrandentry = new Brandentry();
        $data['brand_entry_details'] = $objBrandentry->get_brand_entry_details($editId);

        $data['title'] = Config::get('constants.SYSTEM_NAME') . ' || Edit Brand Entry';
        $data['description'] = Config::get('constants.SYSTEM_NAME') . ' || Edit Brand Entry';
        $data['keywords'] = Config::get('constants.SYSTEM_NAME') . ' || Edit Brand Entry';
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
            'brandentry.js',
        );
        $data['funinit'] = array(
            'Brandentry.edit()'
        );
        $data['header'] = array(
            'title' => 'Edit Brand Entry',
            'breadcrumb' => array(
                'My Dashboard' => route('dashboard'),
                'Brand Entry List' => route('brand-entry-list'),
                'Edit Brand Entry' => 'Edit Brand Entry',
            )
        );
        return view('backend.pages.brandentry.edit', $data);
    }

    public function edit_brand_entry(Request $request){
        $objBrandentry = new Brandentry();
        $result = $objBrandentry->edit_brand_entry($request);

        if ($result == "true") {
            $return['status'] = 'success';
            $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
            $return['message'] = 'Brand entry successfully updated.';
            $return['redirect'] = route('brand-entry-list');
        }else{
            if ($result == "record_exits") {
                $return['status'] = 'warning';
                $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
                $return['message'] = 'Brand entry record already exits';
            }else{
                $return['status'] = 'error';
                $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
               $return['message'] = 'Something goes to wrong';
            }

        }
        echo json_encode($return);
        exit;
    }


    public function ajaxcall(Request $request){
        $action = $request->input('action');

        switch ($action) {

            case 'getdatatable':

                $objBrandentry = new Brandentry();
                $list = $objBrandentry->getdatatable();

                echo json_encode($list);
                break;

                case 'addMember':
                    $details =  view('backend.pages.brandentry.add_brand');

                    echo $details;
                    break;

            case 'delete-brand-entry':

                $objBrandentry = new Brandentry();
                $result = $objBrandentry->common_activity_user($request->input('data'), 0);

                if ($result) {
                    $return['status'] = 'success';
                    $return['message'] = 'Brand entry successfully deleted';
                    $return['redirect'] = route('brand-entry-list');
                } else {
                    $return['status'] = 'error';
                    $return['jscode'] = '$("#loader").hide();';
                    $return['message'] = 'Something goes to wrong';
                }
                echo json_encode($return);
                exit;
        }
    }
}