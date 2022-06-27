<?php

namespace App\Http\Controllers\backend\user_report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usersreport;
use Config;

class UserreportController extends Controller
{
    function __construct()
    {
        $this->middleware('admin');    
    }

    public function list(){
        $data['title'] = Config::get('constants.SYSTEM_NAME') . ' || User reports histroy' ;
        $data['description'] = Config::get('constants.SYSTEM_NAME') . ' || User reports histroy' ;
        $data['keywords'] = Config::get('constants.SYSTEM_NAME') . ' || User reports histroy' ;
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
            'userreport.js',
        );
        $data['funinit'] = array(
            'Userreport.init()',
        );
        $data['header'] = array(
            'title' => 'User reports histroy',
            'breadcrumb' => array(
                'Reports ' => route('my-report'),
                'User reports histroy' => 'User reports histroy',
            )
        );
        return view('backend.pages.users_report.list', $data);
    }

    
    public function ajaxcall(Request $request){
        $action = $request->input('action');

        switch ($action) {

            case 'getdatatable':
                $objUsersreport = new Usersreport();
                $list = $objUsersreport->getdatatable();
                echo json_encode($list);
                break;


            case 'view-user-report-histroy':                
                $objUsersreport = new Usersreport();
                $data['report_details'] = $objUsersreport->view_user_report_histroy($request->input('data')['data_id']);                

                return view('backend.pages.users_report.report_details', $data);
            }
        }
}
