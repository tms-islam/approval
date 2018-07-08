<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin;
use App\Mail\AdminResetPasword;

use Carbon\Carbon;
use Mail;

class AdminAuth extends HomeControle {

    //

/*
 * Login Function , 
 * 
 * this function view . 
 */
    public function login() {
        
        return view('admin.layout.login',['title' => 'Login']);
    }
/*
 * Login function 
 * 
 * check if user is on system or not 
 */
    public function dologin() {
        $remeberme = Request('remeberme') == 1 ? true : false;
        if (admin()->attempt(['email' => request('email'), 'password' => request('password')], $remeberme)) {
            return redirect('admin');
        } else {
            session()->flash('error', 'invalid username or password');
            return redirect('admin/login');
        }
    }
/*
 * Log out 
 * 
 * do logout actions 
 * 
 * 
 */
    public function logout() {
        admin()->logout();
        return redirect('admin/login');
    }
/**
 * Forget password functions  
 * View Function
 * @return type
 * 
 */
    public function forgotPassword() {
        return view('admin.users.forgot');
    }
/**
 * Reset password 
 * @return AdminResetPasword
 */
    public function doforgot() {
        $admin = Admin::where('email', request('username2'))->first();
        if (!empty($admin)) {
            $token = app('auth.password.broker')->createToken($admin);
            $data = DB::table('password_resets')->insert([
                'email' => $admin->email,
                'token' => $token,
                'created_at' => Carbon::now()]
            );
            return new AdminResetPasword(['data' => $admin, 'token' => $token]);
//Mail::to($admin->mail)->send(new AdminResetPasword(['data'=>$admin,'token'=>$token]));
//return back();
        }
        return back();
    }
/**
 * reset passowrd
 * @param type $token
 * @return type
 */
    public function reset_password($token) {
        $check_token = DB::table('password_resets')->where('token', $token)->where('created_at', '>', Carbon::now()->subHours(2))->first();

        if (!empty($check_token)) {
            return view('admin.users.resetpassword', ['data' => $check_token]);
        } else {
            return view(aurl('forgot'));
        }
    }
/** 
 * reset password final 
 * @param type $token
 */
    function reset_password_final($token) {
        $this->validate(request(), [
            'password' => 'required|confirmed',
            'passwordc' => 'required'
                ], [], [
            'password' => 'password',
            'passwordc' => 'confirmation password'
        ]);
        $check_token = DB::table('password_resets')->where('token', $token)->where('created_at', '>', Carbon::now()->subHours(2))->first();

        if (!empty($check_token)) {
            $admin = Admin::where('email', $check_token->email)->update(['email' => $check_token->email, 'password' => bcrypt(request('password'))]);
            DB::table('password_resets')->where('email', request('email'))->delete();
            admin()->login($admin);
            redirect(aurl());
        } else {
            redirect(aurl('forgot'));
        }
    }

}
