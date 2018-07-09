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

    public function assignRoleToUsertype() {
        //check if user role is found on 
        $role_id = 0;
        $role_type_id = 0;
        $checker = user_role::where(['role_id' => $role_id, 'role_type_id' => $role_type_id])->get();

        if (count($checker) > 0) {
            $message = "error  this role assigned pefore";
            return;
        } else {
            $createNewUserRole = user_role::create([
                        'role_id' => $role_id,
                        'role_type_id' => $role_type_id
            ]);
            $result = $createNewUserRole->id;
        }
    }

    public function unAssignRoleFromUser() {
        $role_id = 0;
        $role_type_id = 0;
        $checker = user_role::where(['role_id' => $role_id, 'role_type_id' => $role_type_id])->get();
        if (count($checker) > 0) {
            $checker->delete();
        } return;
    }

    private function loadRoleOfCurruntUser() {

        $curruntUserRole = admin()->user()->user_role;
        $checkUserRoleCred = user_role_cred::where(['role_id' => $curruntUserRole])->get();
        return $checkUserRoleCred;
    }

}
