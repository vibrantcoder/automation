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

    public function sendSMTPMail($mailData)
    {
                $pathToFile = $mailData['attachment'];

                $mailsend = Mail::send($mailData['template'], ['data' => $mailData['data']], function ($m) use ($mailData,$pathToFile) {
                    $m->from('pkhunt@vibrantcoders.com', 'Automation');

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
