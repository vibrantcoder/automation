<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Models\Mobilenumber;
use App\Models\Brandentry;
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
            case 'change-mobile-number':

                $details = $request->input('data');

                $objMobilenumber = new Mobilenumber();
                $mobile_operator_list = $objMobilenumber->get_mobile_operator_list($details['mobileId']);

                echo json_encode($mobile_operator_list);
                exit;
        }
    }
}
