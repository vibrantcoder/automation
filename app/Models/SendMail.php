<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use Config;
use Illuminate\Support\Facades\DB;
use Mail;

class SendMail extends Model
{
    use HasFactory;


    public function sendMailltesting(){
        $mailData['data']='';
        $mailData['subject'] = 'Automation Testing System';
        $mailData['attachment'] = array();
        $mailData['template'] ="emailtemplate.test";
        $mailData['mailto'] = 'parthkhunt12@gmail.com';

        $sendMail = new Sendmail;
        return $sendMail->sendSMTPMail($mailData);
    }

    public function sendSMTPMail($mailData)
    {
        $pathToFile = $mailData['attachment'];
        $mailsend = Mail::send($mailData['template'], ['data' => $mailData['data']], function ($m) use ($mailData,$pathToFile) {
            $m->from('info@automation.vibrantcoders.in', 'Automation');
            $m->to($mailData['mailto'], "Automation")->subject($mailData['subject']);
            if($pathToFile != ""){
            }
        });

        if($mailsend){
            return true;
        }else{
            return false;
        }
    }
}
