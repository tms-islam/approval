<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;
use DB;
use App\notifications;
use App\approvel_project;
use App\Admin;

class HomeControle extends Controller {

    //
    

    public function __construct() {
      
    }

    public function checkUserRole() {
        $role = admin()->user()->user_role;
        if ($role != 1 || $role != 2) {
            return back();
        }
    }
    
    public function checkCurruntUserRole($roleID){
        $role = admin()->user()->user_role;
        if($role != $roleID ){
            return back();
        }
        return TRUE;
    }

// Notifications 

    public function createNewNotify($data) {

        $create = notifications::create($data);
        if ($create->id > 0) {
            return true;
        }
        return FALSE;
    }

    public function setNotificationisViewd($id) {

        $notify = notifications::find($id);
        $notify->is_view = 1;
        $notify->save();
    }

    public function getAllNotifyByView($url, $isview) {
        $notifications = notifications::where(['url' => $url, 'is_view' => $isview])->get();
        return $notifications;
    }

    public function notificationPage() {
        $role = admin()->user()->user_role;
       
        $newList = array();
        if ($role == 1 || $role == 2) {
                       $notify =  $this->getAllNotifyByView('admin', 0);

            $notification = notifications::where(['url' => 'admin'])->get();
            foreach ($notification as $val) {
                $projectid = $val['projectid'];

                $projectinfo = approvel_project::find($projectid);
                $creatorproject = $projectinfo->uploadedUser;
                $userinfo = Admin::find($creatorproject);
                $username = $userinfo->name;
                $userid = $userinfo->id;
                $newList[] = array(
                    'id' => $val['id'],
                    'username' => $username,
                    'userid' => $userid,
                    'projectname' => $projectinfo->title,
                    'created_at' => $val['created_at'],
                    'content' => $val['content'],
                    'is_view' => $val['is_view'],
                    'url' => $val['url'],
                    'projectid' => $projectid
                );
            }
            return view('admin.notify.all', ['allnotify'=> $newList,'notification'=>$notify]);
           //print_r($newList);
        } else {
            $notification = notifications::where(['url' => 'user'])->get();

            foreach ($notification as $val) {
                $projectid = $val['projectid'];

                $projectinfo = approvel_project::find($projectid);
                $creatorproject = $projectinfo->uploadedUser;
                $userinfo = Admin::find($creatorproject);
                $username = $userinfo->name;
                $userid = $userinfo->id;
                $newList[] = array(
                'id' => $val['id'],
                'username' => $username,
                'userid' => $userid,
                'projectname' => $projectinfo->title,
                'created_at' => $val['created_at'],
                'content' => $val['content'],
                'is_view' => $val['is_view'],
                'url' => $val['url'],
                'projectid' => $projectid
                );
            }
            $notify =  $this->getAllNotifyByView('user', 0);
            return view('admin.notify.all', ['allnotify', $newList,'notification'=>$notify]);
        }
    }
    
    
    // Activites

}
