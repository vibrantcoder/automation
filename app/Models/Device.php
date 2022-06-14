<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Route;
use Session;

class Device extends Model
{
    use HasFactory;
    protected $table = 'device';

    public function getdatatable()
    {
        // $loginUser = Session::all();
        // ccd($loginUser['logindata'][0]['usertype']);
        $requestData = $_REQUEST;
        $columns = array(
            0 => 'device.id',
            1 => 'device.device_name',
            2 => DB::raw('(CASE WHEN device.status = "A" THEN "Active" ELSE "Inactive" END)'),
        );
        $query = Device ::from('device')
                        ->where('device.is_deleted','N');


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
                    ->select('device.id', 'device.device_name', 'device.status' , DB::raw('(CASE WHEN device.status = "A" THEN "Active" ELSE "Inactive" END) as statuss '))
                    ->get();

        $data = array();
        $i = 0;

        foreach ($resultArr as $row) {

            $actionhtml  = '';

              $actionhtml =  $actionhtml. '<a href="'.route('edit-device', $row['id']).'" class="btn btn-icon"><i class="fa fa-pencil-square-o text-warning" title="Edit Device"> </i></a>';


              if($row['status'] == 'A'){
                $status = '<span class="badge badge-md badge-success">'.$row['statuss'].'</span>';

                  $actionhtml =  $actionhtml. '<a href="#" data-toggle="modal" data-target="#deactiveModel" class="btn btn-icon  deactive-device" data-id="' . $row["id"] . '" title="Inactive Device" ><i class="fa fa-times text-danger" ></i></a>';

              }else{
                $status = '<span class="badge badge-md badge-danger">'.$row['statuss'].'</span>';

                  $actionhtml =  $actionhtml. '<a href="#" data-toggle="modal" data-target="#activeModel" class="btn btn-icon  active-device" data-id="' . $row["id"] . '" title="Active Device" ><i class="fa fa-check text-success" ></i></a>';

              }

             $actionhtml =  $actionhtml. '<a href="#" data-toggle="modal" data-target="#deleteModel" class="btn btn-icon  delete-device" data-id="' . $row["id"] . '"  title="Delete Device"><i class="fa fa-trash text-danger" ></i></a>';


            $i++;
            $nestedData = array();
            $nestedData[] = $i;
            // $nestedData[] = $row['id'];
            $nestedData[] = $row['device_name'];
            $nestedData[] = $status;
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

    public function add_device($request){
        $count = Device::from('device')
                    ->where("device.device_name", $request->input('device_name'))
                    ->where("device.is_deleted", 'N')
                    ->count();

        if($count == 0){
                $loginUser = Session::all();
                $objDevice = new Device();
                $objDevice->device_name = $request->input('device_name');
                $objDevice->status = $request->input('status');
                $objDevice->add_by = $loginUser['logindata'][0]['id'];
                $objDevice->updated_by = $loginUser['logindata'][0]['id'];
                $objDevice->is_deleted = 'N';
                $objDevice->created_at = date('Y-m-d H:i:s');
                $objDevice->updated_at = date('Y-m-d H:i:s');
                if($objDevice->save()){

                    // $destinationPath = public_path('/upload/systemsetting/');
                    $currentRoute = Route::current()->getName();
                    $inputData = $request->input();
                    unset($inputData['_token']);
                    $objAudittrails = new Audittrails();
                    $res = $objAudittrails->add_audit('Insert','admin/'. $currentRoute , json_encode($inputData) ,'Device' );
                    return 'true';
                }else{
                    return 'false';
                }

        }
        return 'device_name_exits';
    }

    public function get_device_detail($editId){
        return Device::from('device')
                     ->where('device.id', $editId)
                     ->where('device.is_deleted', 'N')
                     ->select('device.id', 'device.device_name', 'device.status')
                     ->get()
                     ->toArray();
    }

    public function edit_device($request){
        $count = Device::from('device')
                    ->where("device.device_name", $request->input('device_name'))
                    ->where('device.id', '!=', $request->input('editId'))
                    ->where("device.is_deleted", 'N')
                    ->count();

        if($count == 0){
                $loginUser = Session::all();
                $objDevice = Device::find($request->input('editId'));
                $objDevice->device_name = $request->input('device_name');
                $objDevice->status = $request->input('status');
                $objDevice->updated_by = $loginUser['logindata'][0]['id'];
                $objDevice->is_deleted = 'N';
                $objDevice->updated_at = date('Y-m-d H:i:s');
                if($objDevice->save()){

                    // $destinationPath = public_path('/upload/systemsetting/');
                    $currentRoute = Route::current()->getName();
                    $inputData = $request->input();
                    unset($inputData['_token']);
                    $objAudittrails = new Audittrails();
                    $res = $objAudittrails->add_audit('Edit','admin/'. $currentRoute , json_encode($inputData) ,'Device' );
                    return 'true';
                }else{
                    return 'false';
                }

        }
        return 'device_name_exits';
    }

    public function common_activity_user($data ,$type){
        $loginUser = Session::all();

        $objDevice = Device::find($data['id']);
        if($type == 0){
            $objDevice->is_deleted = "Y";
            $event = 'Delete Device';
        }
        if($type == 1){
            $objDevice->status = "A";
            $event = 'Active Device';
        }
        if($type == 2){
            $objDevice->status = "I";
            $event = 'Deactive Device';
        }
        $objDevice->updated_by = $loginUser['logindata'][0]['id'];
        $objDevice->updated_at = date("Y-m-d H:i:s");
        if($objDevice->save()){
            $currentRoute = Route::current()->getName();
            $objAudittrails = new Audittrails();
            $res = $objAudittrails->add_audit($event, 'admin/'.$currentRoute, json_encode($data), 'Device');
            return true;
        }else{
            return false ;
        }
    }

    public function get_device_details(){
        return Device::from('device')
                     ->where('device.status', 'A')
                     ->where('device.is_deleted', 'N')
                     ->select('device.id', 'device.device_name')
                     ->get()
                     ->toArray();
    }

    public function get_divice_name($id){
        return Device::from('device')
                    ->where('device.id', $id)
                    ->select('device.id', 'device.device_name')
                    ->get()
                    ->toArray();
    }
}
