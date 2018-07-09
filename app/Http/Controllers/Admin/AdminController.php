<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\DataTables\AdminDataTable;
use Illuminate\Http\Request;
use App\Admin;
use App\users_role;
use Mail;
use Hash;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class AdminController extends HomeControle {

    protected $notifydata = array();

    /**
     * construct function 
     * load objects when called this classf
     */
    public function __construct() {
        // $this->middleware('admin');
        $this->notifydata = $this->getAllNotifyByView('admin', 0);
//        if(count($this->notifydata) ==0){
//            $this->notifydata = 1;
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index(AdminDataTable $admin) {
        return $admin->render('admin.admins.index', ['title' => 'Dashboard', 'notification' => $this->notifydata]);
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function createNewUserView() {
        $this->checkUserRole();
        // $roles = DB::table('users_role')->get();
        $roles = users_role::all();
        $licenses = Admin::where(['user_role' => 2])->get();
        return view('admin.users.newUser', ['roles' => $roles, 'title' => 'Add New User', 'notification' => $this->notifydata, 'licenses' => $licenses]);
    }

    /**
     * add new User to the system 
     * @return type
     */
    public function addNewUser() {
        $name = request('name');
        $email = request('email');
        $role = request('select');
        $license = request('licenses');
        $key = md5(microtime());
        $created_userID = admin()->user()->id;
        $users = Admin::where('email', $email)->get();
        if (count($users) > 0) {
            Session::flash('message', 'this email already on the system');
            Session::flash('alert-class', 'alert-danger');
            return back();
        } else {
            Admin::create(['name' => $name, 'email' => $email, 'password' => bcrypt('123456'), 'user_role' => $role, 'status' => 0, 'activate_key' => $key, 'created_user' => $created_userID, 'licens' => $license]);
            //send mail 
            $mTitle = "You have request for login in Approval System as  " . $name . "($email)";
            //  $mURL = base_path() . "/admin/log/" . $key;
            //$mMessage = "please click <a href='$mURL' >here </a>for complete your login to our system ";
            $data = array('title' => $mTitle, 'key' => $key);
            Mail::send('emails.email', $data, function($message)use ($email, $name) {
                $message->to($email, $name)
                        ->subject('Approval system');
                $message->from('Admin@system.com', 'Approval project Admin');
            });
            Session::flash('message', 'created successfull');
            Session::flash('alert-class', 'alert-success');
            return back();
        }
    }

    /**
     * this function return all user page 
     * for system admin only 
     * @param Request $request
     * @return type
     */
    public function Users(Request $request) {
        // print_r(session());
        // $as =   admin()->user()->user_role;
        //echo $as;
        if (admin()->user()->user_role == 1) {
            $users = Admin::all();
            return view('admin.users.users', ['users' => $users, 'title' => 'All Users', 'notification' => $this->notifydata]);
        } else {
            redirect('/admin');
        }
    }

    /**
     * Profile function 
     * 
     * this function return currunt profile page for currunt user session .
     * 
     * @return type
     */
    public function ProfilePage() {
        $userid = admin()->user()->id;
        $user = Admin::find($userid);
        return view('admin.users.profile', ['user' => $user]);
    }

    /**
     * get profile by id 
     * @param Request $request
     * @return type
     */
    public function userprofile(Request $request) {
        $id = $request->id;
        $admin = Admin::find($id);
        if (!empty($admin)) {
            $licenses = Admin::where(['user_role' => 2])->get();
            return view('admin.users.userprofile', ['admin' => $admin, 'licenses' => $licenses]);
        } else {
            return back();
        }
    }

    /**
     * update profile personal page 
     * @return type
     */
    public function updateuserprofile() {
        $id = request('uid');
        $select = request('select');
        $user = Admin::find($id);
        $user->licens = $select;
        $user->save();
        return back();
    }

    /**
     * change password for user 
     * @param Request $request
     * @return type
     */
    public function changepassword(Request $request) {
        $this->validate(request(), [
            'oldpassword' => 'required',
            'newpassword' => 'required',
            'cpassword' => 'required'
                ], [], [
            'oldpassword' => 'Old Password',
            'newpassword' => 'New Passowrd',
            'cpassword' => 'Confirm password'
        ]);
        $userId = admin()->user()->id;
        // $password = admin()->user()->password;
        $userInfo = Admin::find($userId);
        $password = $userInfo->password;
        if (Hash::check($request->get('oldpassword'), $password)) {
            if ($request->get('newpassword') != $request->get('cpassword')) {
                return redirect()->back()->with("error", "You Must enter the same password");
            } else {
                $user = admin()->user();
                $user->password = bcrypt($request->get('newpassword'));
                $user->save();
                return redirect()->back()->with("success", "Password changed successfully !");
            }
        } else {
            return redirect()->back()->with("error", "New Password cannot be same as your current password. Please choose a different password.");
        }
    }

    /**
     * this function for activate user account by mail activation
     * @param Request $request
     * @return string
     */
    public function completeCreateAccount(Request $request) {
        $key = $request->key;
        $user = Admin::where('activate_key', $key)->get();
        //   echo $key ."<br/>";
        if (count($user) > 0) {
            if ($user[0]->activate_key != $key) {
                return "you have inter an invalid url please back to your mail ";
            }
        } else {
            return "you have inter an invalid url please back to your mail ";
        }
        return view('admin.users.changepassword', ['key' => $key, 'notification' => $this->notifydata]);
        // echo $key;
    }

    /**
     * change passowrd
     * @return type
     */
    public function dochangepass() {
        //$key = $request->key;
        $this->validate(request(), [
            'newpassword' => 'required',
            'cpassword' => 'required'
                ], [], [
            'newpassword' => 'password',
            'cpassword' => 'confirmation password'
        ]);
        $password = request('newpassword');
        $Cpassword = request('cpassword');
        $key = request('keys');

        if ($password != $Cpassword) {
            return redirect()->back()->with("error", "New Password cannot be same as your current password. Please choose a different password.");
        }
        // echo $key;
        $check_token = DB::table('admins')->where('activate_key', $key)->where('created_at', '>', Carbon::now()->subHours(24))->first();
        // print_r($check_token);
        if (!empty($check_token)) {
            $akey = md5(microtime());

            Admin::where('email', $check_token->email)->update(['email' => $check_token->email, 'password' => bcrypt($password), 'activate_key' => $akey]);
            //   DB::table('password_resets')->where('email', request('email'))->delete();
            // admin()->login($admin);

            $content = $check_token->email . " is a new user on system";
            $notificationData = array(
                'userid' => $check_token->id,
                'projectid' => 0,
                'url' => 'admin',
                'content' => $content,
                'is_view' => 0
            );
            $this->createNewNotify($notificationData);
            redirect(aurl('login'));
        } else {
            redirect(aurl('login'));
        }
    }

    /**
     * Update User Status
     * @param Request $request
     * @return type
     */
    public function updateUsersStatus(Request $request) {
        $this->checkCurruntUserRole(1);
        $id = $request->id;
        $userInfo = Admin::find($id);
        if ($userInfo->user_role == 1) {
            return back();
        }
        if ($userInfo->status == 1) {
            $userInfo->status = 0;
        } else {
            $userInfo->status = 1;
        }
        $userInfo->save();
        return back();
    }

}
