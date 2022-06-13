<?php

namespace App\Models;

use App\Event\UserCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Audittrails;
use DB;
use Hash;
use Route;
use Session;
use Str;
class Users extends Model
{
    use HasFactory;
    protected $table= 'users';

    public function update_profile($request){
        $countUser = Users::where("email",$request->input('email'))
                        ->where("id",'!=',$request->input('edit_id'))
                        ->count();

        if($countUser == 0){

            $objUsers = Users::find($request->input('edit_id'));
            $objUsers->first_name = $request->input('first_name');
            $objUsers->last_name = $request->input('last_name');
            $objUsers->full_name = $request->input('first_name'). ' '. $request->input('last_name');
            $objUsers->email = $request->input('email');
            if($request->file('userimage')){
                $image = $request->file('userimage');
                $imagename = 'userimage'.time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/upload/userprofile/');
                $image->move($destinationPath, $imagename);
                $objUsers->userimage  = $imagename ;
            }
            if($objUsers->save()){
                $currentRoute = Route::current()->getName();
                $inputData = $request->input();
                unset($inputData['_token']);
                unset($inputData['profile_avatar_remove']);
                unset($inputData['userimage']);
                if($request->file('userimage')){
                    $inputData['userimage'] = $imagename;
                }
                $objAudittrails = new Audittrails();
                $res = $objAudittrails->add_audit('Update','admin/'. $currentRoute , json_encode($inputData) ,'Update Profile' );
                return true;
            }else{
                return "false";
            }

        }else{
            return "email_exist";
        }
    }

    public function changepassword($request)
    {

        if (Hash::check($request->input('old_password'), $request->input('user_old_password'))) {
            $countUser = Users::where("id",'=',$request->input('editid'))->count();
            if($countUser == 1){
                $objUsers = Users::find($request->input('editid'));
                $objUsers->password =  Hash::make($request->input('new_password'));
                $objUsers->updated_at = date('Y-m-d H:i:s');
                if($objUsers->save()){
                    $currentRoute = Route::current()->getName();
                    $inputData = $request->input();
                    unset($inputData['_token']);
                    unset($inputData['user_old_password']);
                    unset($inputData['old_password']);
                    unset($inputData['new_password']);
                    unset($inputData['new_confirm_password']);
                    $objAudittrails = new Audittrails();
                    $res = $objAudittrails->add_audit('Update','admin/'. $currentRoute , json_encode($inputData) ,'Change Password' );
                    return true;
                }else{
                    return 'false';
                }
            }else{
                return "false";
            }
        }else{
            return "password_not_match";
        }
    }

    public function getdatatable()
    {

        $requestData = $_REQUEST;
        $columns = array(
            0 => 'users.id',
            1 => 'users.first_name',
            2 => 'users.last_name',
            3 => 'users.email',
            4 => 'users.mobile_no',
            5 => 'users.designation',


        );
        $query = Users ::from('users')
                        ->where('users.user_type', 'U')
                        ->where('users.is_deleted','N');


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
                    ->select('users.id', 'users.first_name', 'users.last_name', 'users.mobile_no', 'users.email', 'users.designation')
                    ->get();

        $data = array();
        $i = 0;

        foreach ($resultArr as $row) {

            $actionhtml  = '';

              $actionhtml =  $actionhtml. '<a href="'.route('edit-user-management', $row['id']).'" class="btn btn-icon"><i class="fa fa-pencil-square-o text-warning" title="Edit User Management"> </i></a>';



            // $actionhtml = '<a href="javscript:;" data-toggle="modal" data-target="#viewAuditTrails" data-id="'.$row['id'].'" class="btn btn-icon viewdata"><i class="fa fa-eye text-info"> </i></a>';


            $actionhtml =  $actionhtml. '<a href="#" data-toggle="modal" data-target="#deleteModel" class="btn btn-icon  delete-user-management" data-id="' . $row["id"] . '"  title="Delete User Management"><i class="fa fa-trash text-danger" ></i></a>';

            $i++;
            $nestedData = array();
            $nestedData[] = $i;
            // $nestedData[] = $row['id'];
            $nestedData[] = $row['first_name'];
            $nestedData[] = $row['last_name'];
            $nestedData[] = $row['email'];
            $nestedData[] = $row['mobile_no'];
            $nestedData[] = $row['designation'];
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

    public function add_user_management($request){
        $count = Users::from('users')
                    ->where("users.email", $request->input('email'))
                    ->where("users.is_deleted", 'N')
                    ->count();

        if($count == 0){

                $random_pwd = Str::random(10);
                $objUsers = new Users();
                $objUsers->first_name = $request->input('first_name');
                $objUsers->last_name = $request->input('last_name');
                $objUsers->mobile_no = $request->input('mobile_no');
                $objUsers->email = $request->input('email');
                $objUsers->designation = $request->input('designation');
                $objUsers->password = Hash::make($random_pwd);
                $objUsers->status = 'A';
                $objUsers->user_type = 'U';
                $objUsers->created_at = date('Y-m-d H:i:s');
                $objUsers->updated_at = date('Y-m-d H:i:s');
                if($objUsers->save()){
                    event (new UserCreated($request->first_name,$request->last_name,$request->email,$random_pwd));
                    $currentRoute = Route::current()->getName();
                    $inputData = $request->input();
                    unset($inputData['_token']);
                    $objAudittrails = new Audittrails();
                    $res = $objAudittrails->add_audit('Insert','admin/'. $currentRoute , json_encode($inputData) ,'User Management' );
                    return 'true';
                }else{
                    return 'false';
                }
        }
        return 'email_exits';
    }

    public function send_user_login_mail($first_name,$last_name,$email,$random_pwd){


        $mailData['data']['first_name']= $first_name;
        $mailData['data']['last_name']= $last_name;
        $mailData['data']['password']= $random_pwd;
        $mailData['data']['email']= $email;
        $mailData['subject'] = 'Welcome';
        $mailData['attachment'] = array();
        $mailData['template'] = "emailtemplate.login_mail";
        $mailData['mailto'] = $email;

        $sendMail = new SendMail();
        return $sendMail->sendSMTPMail($mailData);
    }

    public function get_user_details($editId){
        return Users::from('users')
                    ->where('users.id', $editId)
                    ->where('users.is_deleted', 'N')
                    ->select('users.id', 'users.first_name', 'users.last_name', 'users.email', 'users.mobile_no', 'users.designation')
                    ->get()
                    ->toArray();
    }

    public function edit_user_management($request){
        $count = Users::from('users')
                    ->where('users.id', '!=', $request->input('editId'))
                    ->where("users.email", $request->input('email'))
                    ->where("users.is_deleted", 'N')
                    ->count();

        if($count == 0){

                $objUsers = Users::find($request->input('editId'));
                $objUsers->first_name = $request->input('first_name');
                $objUsers->last_name = $request->input('last_name');
                $objUsers->mobile_no = $request->input('mobile_no');
                $objUsers->email = $request->input('email');
                $objUsers->designation = $request->input('designation');
                $objUsers->updated_at = date('Y-m-d H:i:s');
                if($objUsers->save()){
                    $currentRoute = Route::current()->getName();
                    $inputData = $request->input();
                    unset($inputData['_token']);
                    $objAudittrails = new Audittrails();
                    $res = $objAudittrails->add_audit('Edit','admin/'. $currentRoute , json_encode($inputData) ,'User Management' );
                    return 'true';
                }else{
                    return 'false';
                }
        }
        return 'email_exits';
    }

    public function common_activity_user($data, $type){
        $objUsers = Users::find($data['id']);
        if($type == 0){
            $objUsers->is_deleted = "Y";
            $event = 'Delete User Management';
        }

        $objUsers->updated_at = date("Y-m-d H:i:s");
        if($objUsers->save()){
            $currentRoute = Route::current()->getName();
            $objAudittrails = new Audittrails();
            $res = $objAudittrails->add_audit($event, 'admin/'.$currentRoute, json_encode($data), 'User Management');
            return true;
        }else{
            return false ;
        }
    }
}
