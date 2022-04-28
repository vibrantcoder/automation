<?php

namespace App\Http\Controllers\backend\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Resultreport;
use Config;
use LDAP\Result;

class DashboardController extends Controller
{
    function __construct()
    {
        $this->middleware('admin');
    }

    public function dashboard(Request $request){

        $data['title'] =  Config::get('constants.SYSTEM_NAME') . ' || dashboard';
        $data['description'] =  Config::get('constants.SYSTEM_NAME') . ' || dashboard';
        $data['keywords'] =  Config::get('constants.SYSTEM_NAME') . ' || dashboard';
        $data['css'] = array(
            'toastr/toastr.min.css'
        );
        $data['plugincss'] = array(
            'plugins/custom/datatables/datatables.bundle.css'
        );
        $data['pluginjs'] = array(
            'toastr/toastr.min.js',
            'plugins/custom/datatables/datatables.bundle.js',
            'pages/crud/datatables/data-sources/html.js',
            'pages/features/charts/apexcharts.js'
        );
        $data['js'] = array(
            'comman_function.js',
            'dashboard.js',
        );
        $data['funinit'] = array(
            'Dashboard.init()'
        );
        $data['header'] = array(
            'title' => 'Reports ',
            'breadcrumb' => array(
                'Reports ' => 'Reports ',
            )
        );
        return view('backend.pages.dashboard.dashboard', $data);
    }


    public function update_profile(Request $request){

        $data['title'] = Config::get('constants.SYSTEM_NAME') . ' || Update Profile';
        $data['description'] = Config::get('constants.SYSTEM_NAME') . ' || Update Profile';
        $data['keywords'] = Config::get('constants.SYSTEM_NAME') . ' || Update Profile';
        $data['css'] = array(
            'toastr/toastr.min.css'
        );
        $data['plugincss'] = array(
        );
        $data['pluginjs'] = array(
            'toastr/toastr.min.js',
            'plugins/validate/jquery.validate.min.js',
            'pages/crud/file-upload/image-input.js'
        );
        $data['js'] = array(
            'comman_function.js',
            'ajaxfileupload.js',
            'jquery.form.min.js',
            'dashboard.js',
        );
        $data['funinit'] = array(
            'Dashboard.edit_profile()'
        );
        $data['header'] = array(
            'title' => 'Update Profile',
            'breadcrumb' => array(
                'Reports ' => route('my-report'),
                'Update Profile' => 'Update Profile',
            )
        );
        return view('backend.pages.dashboard.update_profile', $data);
    }

    public function save_profile(Request $request){

        $objUsers = new Users();
        $result = $objUsers->update_profile($request);
        if ($result == "true") {
            $return['status'] = 'success';
             $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
            $return['message'] = 'Your profile successfully updated.';
            $return['redirect'] = route('admin-update-profile');
        } else {
            if ($result == "email_exist") {
                $return['status'] = 'error';
                 $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
                $return['message'] = 'The email address has already been registered.';
            }else{
                $return['status'] = 'error';
                 $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
                $return['message'] = 'Something goes to wrong';
            }
        }
        echo json_encode($return);
        exit;
    }

    public function change_password(Request $request){
        $data['title'] = 'Petrol Station Web Software || Change Password';
        $data['description'] = 'Petrol Station Web Software || Change Password';
        $data['keywords'] = 'Petrol Station Web Software || Change Password';
        $data['css'] = array(
            'toastr/toastr.min.css'
        );
        $data['plugincss'] = array(
        );
        $data['pluginjs'] = array(
            'toastr/toastr.min.js',
            'plugins/validate/jquery.validate.min.js',
            'pages/crud/file-upload/image-input.js'
        );
        $data['js'] = array(
            'comman_function.js',
            'ajaxfileupload.js',
            'jquery.form.min.js',
            'dashboard.js',
        );
        $data['funinit'] = array(
            'Dashboard.change_password()'
        );
        $data['header'] = array(
            'title' => 'Change Password',
            'breadcrumb' => array(
                'Reports ' => route('my-report'),
                'Change Password' => 'Change Password',
            )
        );
        return view('backend.pages.dashboard.change_password', $data);
    }

    public function save_password(Request $request){
        $objUsers = new Users();
        $result = $objUsers->changepassword($request);

        if ($result == "true") {
            $return['status'] = 'success';
            $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
            $return['message'] = 'Your password has been updated successfully.';
            $return['redirect'] = route('admin-change-password');
        } else {
            if ($result == "password_not_match") {
                $return['status'] = 'warning';
                $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
                $return['message'] = 'Your old password is not match.';

                $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';

            }else{
                $return['status'] = 'error';
                $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
                $return['message'] = 'Something goes to wrong';
            }
        }
        echo json_encode($return);
        exit;
    }

    public function update_report(Request $request){

        $objResultreport = new Resultreport();
        $res = $objResultreport->update_report();
        return redirect()->route('my-report');
        
    }

    public function ajaxcall(Request $request){
        $action = $request->input('action');
        switch ($action) {
            case 'getdatatable':
                $objResultreport = new Resultreport();
                $list = $objResultreport->getdatatable();

                echo json_encode($list);
                break;
            
            case 'sender-chat':
                $objResultreport = new Resultreport();
                $data = $objResultreport->get_sender_chat();
                
                echo json_encode($data);
                break;

            case 'result-chat':
                $objResultreport = new Resultreport();
                $data = $objResultreport->get_sender_chat();

                echo json_encode($data);
                break;
        }
    }
}
