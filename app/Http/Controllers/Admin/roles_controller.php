<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use users_role;
use Admin;
use user_role_cred;

//use Illuminate\Http\Request;

class roles_controller extends Controller {

    //
    /**
     *
     */
    public function __construct() {
        
    }

    public function loadAllRoles() {
        $allRoles = users_role::all();
    }

    private function checkUserRoles() {
        return admin()->user()->user_role;
    }

    public function assignRoleToUser() {
        
    }

    public function unAssignRoleFromUser() {
        
    }

    public function loadRoleOfCurruntUser() {

        $curruntUserRole = admin()->user()->user_role;
        $checkUserRoleCred =    user_role_cred::where(['role_id' =>$curruntUserRole ])->get();
        
                
    }

}
