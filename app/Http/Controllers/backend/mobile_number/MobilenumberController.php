<?php

namespace App\Http\Controllers\backend\mobile_number;

use App\Http\Controllers\Controller;
use App\Models\Countries;
use App\Models\Mobilenumber;
use Illuminate\Http\Request;
use Config;

class MobilenumberController extends Controller
{
    function __construct()
    {
            $this->middleware('admin');
    }

    public function list(){
        $data['title'] = Config::get('constants.SYSTEM_NAME') . ' || Mobile Number List' ;
        $data['description'] = Config::get('constants.SYSTEM_NAME') . ' || Mobile Number List' ;
        $data['keywords'] = Config::get('constants.SYSTEM_NAME') . ' || Mobile Number List' ;
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
            'mobile_number.js',
        );
        $data['funinit'] = array(
            'Mobile_number.init()',
        );
        $data['header'] = array(
            'title' => 'Mobile Number List',
            'breadcrumb' => array(
                'Reports ' => route('my-report'),
                'Mobile Number List' => 'Mobile Number List',
            )
        );
        return view('backend.pages.mobile_number.list', $data);
    }

    public function add(){
        $objCountries = new Countries();
        $data['countries_details'] = $objCountries->get_countries_details();
        // ccd($data['countries_details']);

        $data['title'] = Config::get('constants.SYSTEM_NAME') . ' || Add Mobile Number';
        $data['description'] = Config::get('constants.SYSTEM_NAME') . ' || Add Mobile Number';
        $data['keywords'] = Config::get('constants.SYSTEM_NAME') . ' || Add Mobile Number';
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
            'mobile_number.js',
        );
        $data['funinit'] = array(
            'Mobile_number.add()'
        );
        $data['header'] = array(
            'title' => 'Add Mobile Number',
            'breadcrumb' => array(
                'Reports ' => route('my-report'),
                'Mobile Number List' => route('mobile-number-list'),
                'Add Mobile Number' => 'Add Mobile Number',
            )
        );
        return view('backend.pages.mobile_number.add', $data);
    }

    public function add_mobile_number(Request $request){
        $objMobilenumber = new Mobilenumber();
        $result = $objMobilenumber->add_mobile_number($request);

        if ($result == "true") {
            $return['status'] = 'success';
            $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
            $return['message'] = 'Mobile number successfully added.';
            $return['redirect'] = route('mobile-number-list');
        }else{
            if ($result == "mobile_number_exits") {
                $return['status'] = 'warning';
                $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
                $return['message'] = 'Mobile number already exits';
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
        $objCountries = new Countries();
        $data['countries_details'] = $objCountries->get_countries_details();

        $objMobilenumber = new Mobilenumber();
        $data['mobile_number_details'] = $objMobilenumber->get_mobile_number_details($editId);
        // ccd($data['mobile_number_details']);

        $data['title'] = Config::get('constants.SYSTEM_NAME') . ' || Edit Mobile Number';
        $data['description'] = Config::get('constants.SYSTEM_NAME') . ' || Edit Mobile Number';
        $data['keywords'] = Config::get('constants.SYSTEM_NAME') . ' || Edit Mobile Number';
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
            'mobile_number.js',
        );
        $data['funinit'] = array(
            'Mobile_number.edit()'
        );
        $data['header'] = array(
            'title' => 'Edit Mobile Number',
            'breadcrumb' => array(
                'Reports ' => route('my-report'),
                'Mobile Number List' => route('mobile-number-list'),
                'Edit Mobile Number' => 'Edit Mobile Number',
            )
        );
        return view('backend.pages.mobile_number.edit', $data);
    }

    public function edit_mobile_number(Request $request){
        $objMobilenumber = new Mobilenumber();
        $result = $objMobilenumber->edit_mobile_number($request);

        if ($result == "true") {
            $return['status'] = 'success';
            $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
            $return['message'] = 'Mobile number successfully updated.';
            $return['redirect'] = route('mobile-number-list');
        }else{
            if ($result == "mobile_number_exits") {
                $return['status'] = 'warning';
                $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
                $return['message'] = 'Mobile number already exits';
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

                $objMobilenumber = new Mobilenumber();
                $list = $objMobilenumber->getdatatable();

                echo json_encode($list);
                break;

                case 'delete-mobile-number':

                    $objMobilenumber = new Mobilenumber();
                    $result = $objMobilenumber->common_activity_user($request->input('data'), 0);

                    if ($result) {
                        $return['status'] = 'success';
                        $return['message'] = 'Mobile number successfully deleted';
                        $return['redirect'] = route('mobile-number-list');
                    } else {
                        $return['status'] = 'error';
                        $return['jscode'] = '$("#loader").hide();';
                        $return['message'] = 'Something goes to wrong';
                    }
                    echo json_encode($return);
                    exit;

                case 'active-mobile-number':

                    $objMobilenumber = new Mobilenumber();
                    $result = $objMobilenumber->common_activity_user($request->input('data'), 1);

                    if ($result) {
                        $return['status'] = 'success';
                        $return['message'] = 'Mobile number successfully actived';
                        $return['redirect'] = route('mobile-number-list');
                    } else {
                        $return['status'] = 'error';
                        $return['jscode'] = '$("#loader").hide();';
                        $return['message'] = 'Something goes to wrong';
                    }
                    echo json_encode($return);
                    exit;


                case 'deactive-mobile-number':

                    $objMobilenumber = new Mobilenumber();
                    $result = $objMobilenumber->common_activity_user($request->input('data'), 2);

                    if ($result) {
                        $return['status'] = 'success';
                        $return['message'] = 'Mobile number successfully inactived';
                        $return['redirect'] = route('mobile-number-list');
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
