<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Usersreport extends Model
{
    use HasFactory;
    protected $table = 'users_report';

    public function add_user_report($userId, $response, $systemno){
        $objUsersreport = new Usersreport();
        $objUsersreport->user_id = $userId;
        $objUsersreport->response = $response;
        $objUsersreport->system_no = $systemno;
        $objUsersreport->created_at = date('Y-m-d H:i:s');
        $objUsersreport->updated_at = date('Y-m-d H:i:s');
        return $objUsersreport->save();
    }


    public function getdatatable($data){

        $date = date("Y-m-d", strtotime($data['date']));

        $requestData = $_REQUEST;
        $columns = array(
            0 => 'users_report.id',
            1 => DB::raw('CONCAT(users.first_name, " ", users.last_name)'),
            2 => 'users_report.created_at',
        );
        $query = Usersreport ::from('users_report')
                        ->join('users', 'users.id', '=', 'users_report.user_id');

                        if( $data['user_name'] != "all" ){
                            $query->where('users.id', $data['user_name']);
                        }
                        if( $data['date'] != "All" ){
                            $query->whereDate('users_report.created_at', $date);
                        }


        if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
            $searchVal = $requestData['search']['value'];
            $query->where(function($query) use ($columns, $searchVal, $requestData) {
                $flag = 0;
                foreach ($columns as $key => $value) {
                    $searchVal = $requestData['search']['value'];
                    if ($requestData['columns'][$key]['searchable'] == 'true') {
                        if ($flag == 0) {
                            $query->where($value, 'like', '%' . $searchVal . '%');
                            $flag = $flag + 1;
                        } else {
                            $query->orWhere($value, 'like', '%' . $searchVal . '%');
                        }
                    }
                }
            });
        }

        $temp = $query->orderBy($columns[$requestData['order'][0]['column']], $requestData['order'][0]['dir']);

        $totalData = count($temp->get());
        $totalFiltered = count($temp->get());

        $resultArr = $query->skip($requestData['start'])
                    ->take($requestData['length'])
                    ->select('users_report.id', 'users_report.created_at',  DB::raw('CONCAT(users.first_name, " ", users.last_name) as user_name'))
                    ->get();

        $data = array();
        $i = 0;

        foreach ($resultArr as $row) {

            $actionhtml  = '';
            $actionhtml =  $actionhtml. '<a href="#" data-toggle="modal" data-target="#view_report_details" class="btn btn-icon  view-report-details" data-id="' . $row["id"] . '"  title="view Users report"><i class="fa fa-eye text-info" ></i></a>';


            $i++;
            $nestedData = array();
            $nestedData[] = $i;
            $nestedData[] = $row['user_name'];
            $nestedData[] = date_time_formate($row['created_at']);
            $nestedData[] = $actionhtml;
            $data[] = $nestedData;
        }
        $json_data = array(
            "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal" => intval($totalData), // total number of records
            "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data   // total data array
        );
        return $json_data;
    }

    public function view_user_report_histroy($reportId){
        return  Usersreport ::from('users_report')
                            ->join('users', 'users.id', '=', 'users_report.user_id')
                            ->where('users_report.id', $reportId)
                            ->select('users_report.id', 'users_report.created_at',  'users_report.response', DB::raw('CONCAT(users.first_name, " ", users.last_name) as user_name'))
                            ->get()
                            ->toArray();
    }
}
