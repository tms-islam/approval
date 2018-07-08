<?php


namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
 use Mail;
// use DB;
// use App\notifications;
// use App\approvel_project;
// use App\Admin;

class Notification_controller extends Controller
{
    //

    public function newNotification() {

    }

    public function makeNotificationIsReaded(){

    }

    public function loadAllNotification(){

    }

    //                        ||||||||||||  MAILS  ||||||||||||


    public function SendMailNotify($Mailmessage , $name , $mailtitle , $email ){


    	$data = array(
    		'title' => $mailtitle, 
    		'message'=>$Mailmessage
    		
    	);
    	 Mail::send('emails.mailNotify', $data, function($message)use ($email, $name) {

                $message->to($email, $name)
                        ->subject('Approval system  Notification');
                $message->from('Admin@system.com', 'Approval project Admin');
            });
    }
}
