<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Models\Mobilenumber;
use Illuminate\Http\Request;

class CommonController extends Controller

{

    function __construct()
    {
        $this->middleware('admin');
    }

    public function ajaxcall(Request $request){

        $action = $request->input('action');

        switch ($action) {
            case 'get-device-name':

                $objDevice = new Device();
                $data['device_list'] = $objDevice->get_device_details();

                $objMobilenumber = new Mobilenumber();
                $data['mobile_number_list'] = $objMobilenumber->get_mobile_number_list();


                echo json_encode($data);
                exit;

                case 'change-mobile-number':

                    $details = $request->input('data');

                    $objMobilenumber = new Mobilenumber();
                    $mobile_operator_list = $objMobilenumber->get_mobile_operator_list($details['mobileId']);

                    echo json_encode($mobile_operator_list);
                    exit;



            }

    }
}
