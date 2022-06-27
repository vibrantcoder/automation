<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function sendResponse($result, $message)
    {
    	$response = [
            'success' => true,
            'message' => $message,
            'data'    => $result,
        ];
        return response()->json($response, 200);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 200)
    {
    	$response = [
            'success' => false,
            'message' => $error,
            'data' => $errorMessages,
        ];
        
        return response()->json($response, $code);
    }


    public function one_validation_message($validator){
        // To get all the error messages.
        $validation_messages = $validator->getMessageBag()->toArray();
        $validation_messages1 = array_values($validation_messages);

           $new_validation_messages = [];
           for ($i = 0; $i < count($validation_messages1); $i++) {
               $inside_element = count($validation_messages1[$i]);
                for ($j=0; $j < $inside_element; $j++) {
                   // inserting array element into new array
                   array_push($new_validation_messages,$validation_messages1[$i]);
                }
           }
      // Return only first occured message
      return implode(' ',$new_validation_messages[0]);
   }

}
