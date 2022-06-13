<?php

namespace App\Http\Controllers\backend\device;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\Request;
use Config;

class DiviceController extends Controller
{
    function __construct()
    {
            $this->middleware('admin');
    }

    public function list(){
        $data['title'] = Config::get('constants.SYSTEM_NAME') . ' || Device List' ;
        $data['description'] = Config::get('constants.SYSTEM_NAME') . ' || Device List' ;
        $data['keywords'] = Config::get('constants.SYSTEM_NAME') . ' || Device List' ;
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
            'device.js',
        );
        $data['funinit'] = array(
            'Device.init()',
        );
        $data['header'] = array(
            'title' => 'Device List',
            'breadcrumb' => array(
                'Reports ' => route('my-report'),
                'Device List' => 'Device List',
            )
        );
        return view('backend.pages.device.list', $data);
    }

    public function add(){
        $data['title'] = Config::get('constants.SYSTEM_NAME') . ' || Add Device';
        $data['description'] = Config::get('constants.SYSTEM_NAME') . ' || Add Device';
        $data['keywords'] = Config::get('constants.SYSTEM_NAME') . ' || Add Device';
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
            'device.js',
        );
        $data['funinit'] = array(
            'Device.add()'
        );
        $data['header'] = array(
            'title' => 'Add Device',
            'breadcrumb' => array(
                'Reports ' => route('my-report'),
                'Device List' => route('device-list'),
                'Add Device' => 'Add Device',
            )
        );
        return view('backend.pages.device.add', $data);
    }

    public function add_device(Request $request){
        $objDevice = new Device();
        $result = $objDevice->add_device($request);

        if ($result == "true") {
            $return['status'] = 'success';
            $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
            $return['message'] = 'Device successfully added.';
            $return['redirect'] = route('device-list');
        }else{
            if ($result == "device_name_exits") {
                $return['status'] = 'warning';
                $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
                $return['message'] = 'Device name already exits';
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

        $objDevice = new Device();
        $data['device_detail'] = $objDevice->get_device_detail($editId);
        // ccd($data['device_detail']);

        $data['title'] = Config::get('constants.SYSTEM_NAME') . ' || Edit Device';
        $data['description'] = Config::get('constants.SYSTEM_NAME') . ' || Edit Device';
        $data['keywords'] = Config::get('constants.SYSTEM_NAME') . ' || Edit Device';
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
            'device.js',
        );
        $data['funinit'] = array(
            'Device.edit()'
        );
        $data['header'] = array(
            'title' => 'Edit Device',
            'breadcrumb' => array(
                'Reports ' => route('my-report'),
                'Device List' => route('device-list'),
                'Edit Device' => 'Edit Device',
            )
        );
        return view('backend.pages.device.edit', $data);
    }

    public function edit_device(Request $request){
        $objDevice = new Device();
        $result = $objDevice->edit_device($request);

        if ($result == "true") {
            $return['status'] = 'success';
            $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
            $return['message'] = 'Device successfully updated.';
            $return['redirect'] = route('device-list');
        }else{
            if ($result == "device_name_exits") {
                $return['status'] = 'warning';
                $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
                $return['message'] = 'Device name already exits';
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

                $objDevice = new Device();
                $list = $objDevice->getdatatable();

                echo json_encode($list);
                break;

                case 'delete-device':

                    $objDevice = new Device();
                    $result = $objDevice->common_activity_user($request->input('data'), 0);

                    if ($result) {
                        $return['status'] = 'success';
                        $return['message'] = 'Device successfully deleted';
                        $return['redirect'] = route('device-list');
                    } else {
                        $return['status'] = 'error';
                        $return['jscode'] = '$("#loader").hide();';
                        $return['message'] = 'Something goes to wrong';
                    }
                    echo json_encode($return);
                    exit;

                case 'active-device':

                    $objDevice = new Device();
                    $result = $objDevice->common_activity_user($request->input('data'), 1);

                    if ($result) {
                        $return['status'] = 'success';
                        $return['message'] = 'Device successfully actived';
                        $return['redirect'] = route('device-list');
                    } else {
                        $return['status'] = 'error';
                        $return['jscode'] = '$("#loader").hide();';
                        $return['message'] = 'Something goes to wrong';
                    }
                    echo json_encode($return);
                    exit;


                case 'deactive-device':

                    $objDevice = new Device();
                    $result = $objDevice->common_activity_user($request->input('data'), 2);

                    if ($result) {
                        $return['status'] = 'success';
                        $return['message'] = 'Device successfully inactived';
                        $return['redirect'] = route('device-list');
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
