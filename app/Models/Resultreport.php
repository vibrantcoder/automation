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

    public function getdatatable($data_array)
    {        
       
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
        $query = Resultreport ::from('result_reports');
                if($data_array['result_value'] != 'all'){
                    $query->where("result_reports.result_value",$data_array['result_value']);
                }
               
                if($data_array['sender_from'] != 'all'){
                    $query->where("result_reports.sender_from",$data_array['sender_from']);
                }                

                if($data_array['from'] != '' || $data_array['from'] != null ){
                    $from = date("Y-m-d",strtotime($data_array['from']));
                    $query->whereDate('result_reports.event_time', '>=', $from);
                }

                if($data_array['to'] != '' || $data_array['to'] != null ){
                    $to = date("Y-m-d",strtotime($data_array['to']));
                    $query->whereDate('result_reports.event_time', '<=', $to);
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

    public function get_sender_chat(){
        $res = Resultreport::groupBy('result_reports.sender_from')
                        ->select('result_reports.sender_from', DB::raw('COUNT(result_reports.id)as count'),)
                        ->get()
                        ->toArray();
        $data['sender'] = [];
        $data['count'] = [];
        foreach($res as $key => $value){
            array_push($data['sender'], $value['sender_from']);
            array_push($data['count'], $value['count']);
        }

        return $data;
    }

    public function get_sender_chat_result(){
        $res_type = Resultreport::from('result_reports')
                        ->groupBy('result_reports.result_value')
                        ->select('result_reports.result_value')
                        ->get()
                        ->toArray();

        $data = collect(range(11, 0));
        
        $details = [];
        $month_array = [];
        $result_value = [];
        $temp_array = [];
        foreach($res_type as $res_key => $res_value){
            array_push($result_value, $res_value['result_value']);
        }

        foreach($data as $key => $value){
            $dt = today()->startOfMonth()->subMonth($value);
            $month_name = $dt->shortMonthName."-".$dt->format('Y');
            $date = '01-'.$month_name;
            array_push($month_array, $month_name);
          
           
            foreach($res_type as $res_key => $res_value){
                $count = Resultreport::from('result_reports')
                            ->where('result_reports.result_value', $res_value['result_value'])
                            ->whereMonth('result_reports.event_time', date('m', strtotime($date)))                            
                            ->count();    
            }
            
        }
        // $result_value['name'] = ["Allowed", "Not Allowed"] ;
        $result_value = [
            [
                'name'=> 'Allowed',
                'data' => ['5', '10', '15', '20', '25', '30', '35', '40', '45', '50', '55', '60'],
            ],
            [
                'name'=> 'Not Allowed',
                'data' => ['60', '55', '31', '23', '45', '77', '74', '85', '12', '45', '78', '45'],
            ],
            
        ];
        $details['month'] = $month_array;
        $details['result_value'] = $result_value;       
        return $details;
    }

    public function get_sender_sender_from(){
        return Resultreport::groupBy('result_reports.sender_from')
                        ->select('result_reports.sender_from')
                        ->get()
                        ->toArray();       
    }
   
    public function get_sender_result_value(){
        return Resultreport::groupBy('result_reports.result_value')
                        ->select('result_reports.result_value')
                        ->get()
                        ->toArray();       
    }

    public function download_excel_download($from, $to, $result_value, $sender_from){
        
        $query = Resultreport ::from('result_reports');

                if($result_value != 'all'){
                    $query->where("result_reports.result_value",$result_value);
                }
               
                if($sender_from != 'all'){
                    $query->where("result_reports.sender_from",$sender_from);
                }                

                if($from != '' || $from != null ){
                    $from = date("Y-m-d",strtotime($from));
                    $query->whereDate('result_reports.event_time', '>=', $from);
                }

                if($to != '' || $to != null ){
                    $to = date("Y-m-d",strtotime($to));
                    $query->whereDate('result_reports.event_time', '<=', $to);
                }
                
        $result = $query->select('result_reports.id', 'result_reports.event_time', 'result_reports.result_value', 'result_reports.sender_from', 'result_reports.sender_address', 'result_reports.recipient_code', 'result_reports.text_body')
                        ->get();

        return  $result;
    }
}
