<?php

namespace App\Http\Controllers\backend\user_management;

use App\Http\Controllers\Controller;
use App\Models\Users;
use Illuminate\Http\Request;
use Config;

class UserManagementController extends Controller
{
    function __construct()
    {
            $this->middleware('admin');
    }

    public function list(){
        $data['title'] = Config::get('constants.SYSTEM_NAME') . ' || User Management List' ;
        $data['description'] = Config::get('constants.SYSTEM_NAME') . ' || User Management List' ;
        $data['keywords'] = Config::get('constants.SYSTEM_NAME') . ' || User Management List' ;
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
            'usermanagement.js',
        );
        $data['funinit'] = array(
            'Usermanagement.init()',
        );
        $data['header'] = array(
            'title' => 'User Management List',
            'breadcrumb' => array(
                'Reports ' => route('my-report'),
                'User Management List' => 'User Management List',
            )
        );
        return view('backend.pages.user_management.list', $data);
    }

    public function add(){
        
        $data['title'] = Config::get('constants.SYSTEM_NAME') . ' || Add User Management';
        $data['description'] = Config::get('constants.SYSTEM_NAME') . ' || Add User Management';
        $data['keywords'] = Config::get('constants.SYSTEM_NAME') . ' || Add User Management';
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
            'usermanagement.js',
        );
        $data['funinit'] = array(
            'Usermanagement.add()'
        );
        $data['header'] = array(
            'title' => 'Add User Management',
            'breadcrumb' => array(
                'Reports ' => route('my-report'),
                'User Management List' => route('user-management-list'),
                'Add User Management' => 'Add User Management',
            )
        );
        return view('backend.pages.user_management.add', $data);
    }

    public function add_user_management(Request $request){
        
        $objUsers = new Users();
        $result = $objUsers->add_user_management($request);

        if ($result == "true") {
            $return['status'] = 'success';
            $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
            $return['message'] = 'User Management successfully added.';
            $return['redirect'] = route('user-management-list');
        }else{
            if ($result == "email_exits") {
                $return['status'] = 'warning';
                $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
                $return['message'] = 'User email already exits';
            }elseif($result == "number_exits"){
                $return['status'] = 'warning';
                $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
                $return['message'] = 'User mobile number already exits';
            }
            else{
                $return['status'] = 'error';
                $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
               $return['message'] = 'Something goes to wrong';
            }

        }
        echo json_encode($return);
        exit;
    }

    public function edit($editId){
        $objUsers = new Users();
        $data['user_details'] = $objUsers->get_user_details($editId);
        // ccd($data['user_details']);

        $data['title'] = Config::get('constants.SYSTEM_NAME') . ' || Edit User Management';
        $data['description'] = Config::get('constants.SYSTEM_NAME') . ' || Edit User Management';
        $data['keywords'] = Config::get('constants.SYSTEM_NAME') . ' || Edit User Management';
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
            'usermanagement.js',
        );
        $data['funinit'] = array(
            'Usermanagement.edit()'
        );
        $data['header'] = array(
            'title' => 'Edit User Management',
            'breadcrumb' => array(
                'Reports ' => route('my-report'),
                'User Management List' => route('user-management-list'),
                'Edit User Management' => 'Edit User Management',
            )
        );
        return view('backend.pages.user_management.edit', $data);
    }

    public function edit_user_management(Request $request){
        $objUsers = new Users();
        $result = $objUsers->edit_user_management($request);

        if ($result == "true") {
            $return['status'] = 'success';
            $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
            $return['message'] = 'User management successfully updated.';
            $return['redirect'] = route('user-management-list');
        }else{
            if ($result == "email_exits") {
                $return['status'] = 'warning';
                $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
                $return['message'] = 'User email already exits';
            }
            elseif($result == "number_exits"){
                $return['status'] = 'warning';
                $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
                $return['message'] = 'User mobile number already exits';
            }
            else{
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

                $objUsers = new Users();
                $list = $objUsers->getdatatable();

                echo json_encode($list);
                break;

                case 'delete-user-management':

                    $objUsers = new Users();
                    $result = $objUsers->common_activity_user($request->input('data'), 0);

                    if ($result) {
                        $return['status'] = 'success';
                        $return['message'] = 'User management successfully deleted';
                        $return['redirect'] = route('user-management-list');
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
