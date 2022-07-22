<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usersreport;
use Validator;
use Config;

class UserreportController extends Controller
{
   public function save_user_report(Request $request){
    // json_response
    $messages = [
        'json_response.required' => 'Please enter json response string',
    ];

    $validator = Validator::make($request->all(), [
        'json_response' => 'required',
    ],$messages);

    if ($validator->fails()) {
        $error = $validator->errors();
        return $this->sendError($this->one_validation_message($validator), json_decode("{}"), 200);
    }else{
        $userId = $request->input('user_id');
        $systemNo = Config::get( 'constants.SYSTEM_NO');
        // ccd($userId);
        // ccd($systemNo);

        $objUsersreport  = new Usersreport();
        $res =  $objUsersreport->add_user_report($userId, $request->input('json_response'), $systemNo);
        if($res){
            return $this->sendResponse([], "User report successsfully added.");
        }else{
            return $this->sendError('Something goes to wrong.', json_decode("{}"), 200); 
        }
    }
   }
}
