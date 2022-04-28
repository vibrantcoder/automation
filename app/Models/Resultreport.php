<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Session;
use Route;

class Resultreport extends Model
{
    use HasFactory;
    protected $table = 'result_reports';

    public function getdatatable($employee_list = "")
    {
        // ccd($employee_list);
        $requestData = $_REQUEST;
        $columns = array(
            0 => 'result_reports.id',
            1 => 'result_reports.event_time',
            2 => 'result_reports.result_value',
            3 => 'result_reports.sender_from',
            4 => 'result_reports.sender_address',
            5 => 'result_reports.recipient_code',
            6 => 'result_reports.text_body',

        );
        $query = Audittrails ::from('result_reports');

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
                    ->select('result_reports.id', 'result_reports.event_time', 'result_reports.result_value', 'result_reports.sender_from', 'result_reports.sender_address', 'result_reports.recipient_code', 'result_reports.text_body')
                    ->get();

        $data = array();
        $i = 0;

        foreach ($resultArr as $row) {

            $actionhtmlagent = '<span class="btn btn-icon"><i class="fa fa-'.strtolower($row['agent']).' text-success" ></i></span>';
            $actionhtml  = '';
            $actionhtml =  $actionhtml. '<a href="javscript:;" data-toggle="modal" data-target="#viewAuditTrails" data-id="'.$row['id'].'" class="btn btn-icon viewdata"><i class="fa fa-eye text-info"> </i></a>';

            // $actionhtml = '<a href="javscript:;" data-toggle="modal" data-target="#viewAuditTrails" data-id="'.$row['id'].'" class="btn btn-icon viewdata"><i class="fa fa-eye text-info"> </i></a>';

            //
            $i++;
            $nestedData = array();
            $nestedData[] = $i;
            // $nestedData[] = $row['id'];
            $nestedData[] = $row['event_time'];
            $nestedData[] = $row['result_value'];
            $nestedData[] = $row['sender_from'];
            $nestedData[] = $row['sender_address'];
            $nestedData[] = $row['recipient_code'];
            $nestedData[] = $row['text_body'];
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

    public function update_report(){

        $xmlString = file_get_contents(public_path('xml/sample.xml'));
        $xmlObject = simplexml_load_string($xmlString);
                   
        $json = json_encode($xmlObject);
        $dataArray = json_decode($json, true); 
        $resultArr = [];
        foreach($dataArray['event'] as $key => $value){
            $count =  Resultreport::where('result_reports.event_time', date("Y-m-d H:i:s", strtotime($value['@attributes']['eventTimestamp'])))
                            ->where('result_reports.result_value', $value['result']['@attributes']['value'])
                            ->where('result_reports.sender_from', $value['sender']['@attributes']['from'])
                            ->where('result_reports.sender_address', $value['recipients']['recipient']['@attributes']['sccpAddress'])
                            ->where('result_reports.recipient_code', $value['recipients']['recipient']['@attributes']['code'])
                            ->count();
            if($count == 0){
                $resultArr[] = [
                    'event_time' => date("Y-m-d H:i:s", strtotime($value['@attributes']['eventTimestamp'])),
                    'result_value' => $value['result']['@attributes']['value'],
                    'sender_from' => $value['sender']['@attributes']['from'],
                    'sender_address' => $value['recipients']['recipient']['@attributes']['sccpAddress'],
                    'recipient_code' => $value['recipients']['recipient']['@attributes']['code'],
                    'text_body' => $value['payload']['message']['textBody'],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]; 
            }
            
        }
       
        if(Resultreport::insert($resultArr)){
            $currentRoute = Route::current()->getName();
            $inputData = $resultArr;    
            unset($inputData['_token']);
            $objAudittrails = new Audittrails();
            $res = $objAudittrails->add_audit('Insert','admin/'. $currentRoute , json_encode($inputData) ,'Brand Entry' );            
            return 'true';
        }else{
            return 'false';
        }
    }
}
