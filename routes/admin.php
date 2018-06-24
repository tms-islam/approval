<?php

Route::pattern('id', '[0-9]+');
Route::pattern('url', '[0-9a-zA-Z]+');
Route::pattern('key', '[0-9a-zA-Z]+');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function() {
//ajax
    
    Route::post('/ajax','HomeControle@ajax');
    Route::get('/ajax','HomeControle@ajaxview');
    //end
    Route::get('send', 'Approval_projects@sendMail');
    Config::set('auth.defines', 'admin');
    //complete account login 
    // completeCreateAccount
    Route::get('log/{key}', 'AdminController@completeCreateAccount');
    Route::post('/confrimNewPass', 'AdminController@dochangepass');

    //login
    Route::get('login', 'AdminAuth@login');
//        Route::get('/new', function () {
//    return view('admin.users.newUser');
//});
    Route::post('login', 'AdminAuth@dologin');

//forgot password
    Route::get('forgot', 'AdminAuth@forgotPassword');
    Route::post('forgot', 'AdminAuth@doforgot');
//reset password
    Route::get('reset/password/{token}', 'AdminAuth@reset_password');
    Route::get('reset/password/{token}', 'AdminAuth@reset_password_final');
    Route::group(['middleware' => 'admin:admin'], function() {
        Route::resource('admin', 'AdminController');
        Route::get('/', function() {
            return view('admin.home');
        });
        Route::get('/users/newUser', 'AdminController@createNewUserView');
        Route::get('/users', 'AdminController@Users');

        Route::post('/addNewUser', 'AdminController@addNewUser');
        Route::any('logout', 'AdminAuth@logout');

        //projects
        Route::get('/projects/AddNewProject', 'Approval_projects@addNewProjectView');
        Route::post('/AddNewProjects', 'Approval_projects@addNewProject');
        Route::get('/Approval/{encoded_url}/{id}', 'Approval_projects@saveproject_comment')->where('encoded_url', '.*');
        Route::get('/project/update/{id}' ,'Approval_projects@updateProjectView' );
        Route::post('/project/ConfirmUpdate' ,'Approval_projects@updateProject' );

        Route::get('/projects/All', 'Approval_projects@projects');
        Route::get('/project/{id}', 'Approval_projects@project');
        Route::get('/project/delc/{id}', 'Approval_projects@deleteComment');

        //status 
        Route::get('projects/status/{type}', 'Approval_projects@projectsstatus');

        Route::get('projects/updatestatus/{id}/{status}', 'Approval_projects@updateprojectstatus')->where('status', '[0-9]+');
//notification 
        
        Route::get('notify' , 'HomeControle@notificationPage');

        ///new version
        Route::get('project/NewVersion/{id}', 'Approval_projects@NewProjectVersionView');
        Route::post('project/NewVersion/add', 'Approval_projects@newProjectVersion');

        // admin pages 
        // ProfilePage

        Route::get('/profile', 'AdminController@ProfilePage');
         Route::get('/profile/{id}', 'AdminController@userprofile');
         Route::post('/profile/update', 'AdminController@updateuserprofile');
        Route::post('/changepassword', 'AdminController@changepassword');
        Route::get('/profile/updatestatus/{id}', 'AdminController@updateUsersStatus');

//        Route::get('/Approval/{encoded_url}', function($encoded_url)
//{
//    return 'The URL is: '.rawurldecode($encoded_url);
//})->where('encoded_url', '.*');
    });
});


