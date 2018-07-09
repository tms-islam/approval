<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\Notification_controller;
use App\DataTables\AdminDataTable;
use App\Admin;
use App\approvel_project;
use Illuminate\Http\Request;
use Image;
use App\comments;
use App\activites;
use Mail;
use App\projects_versions;
use Illuminate\Support\Facades\Session;

class Approval_projects extends HomeControle {

    //
    protected $notifydata = array();
    //   protected $userrole;

    private $notifyClass;

    /**
     * construct functions 
     * @param Notification_controller $notifyClass
     */
    public function __construct(Notification_controller $notifyClass) {

        // $this->middleware('admin');
        //   $this->userrole = admin()->user()->user_role;
        $this->notifydata = $this->getAllNotifyByView('admin', 0);
        $this->notifyClass = $notifyClass;
    }

    /**
     * index function 
     * 
     * it is empty function
     */
    public function index() {
        
    }

    /**
     * Add new project 
     * 
     * this function for view page of 
     * @return type
     */
    public function addNewProjectView() {
        //  if(admin()->user()->)
        if (admin()->user()->user_role == 3) {
            return view('admin.projects.newProject', ['notification' => $this->notifydata]);
        }
        return view('admin.layout.404');
    }

    /**
     * add new project 
     * @param Request $request
     * @return type
     */
    public function addNewProject(Request $request) {
        $this->validate(request(), [
            'title' => 'required|unique:approvel_projects|max:255',
            'desc' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                ], [], [
            'title' => 'Approval Project title',
            'desc' => 'Approval Project  description',
            'image' => 'Uploaded file'
        ]);

        //    $new  =   Admin::create(['name' => $name, 'email' => $email, 'password' => bcrypt('123456'), 'user_role' => $role, 'status' => 0, 'activate_key' => $key]);

        $image = $request->file('image');
        $input['imagename'] = time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('/images');
        $image->move($destinationPath, $input['imagename']);

        $new = approvel_project::create([
                    'title' => request('title'),
                    'desc' => request('desc'),
                    'fileurl' => $input['imagename'],
                    'uploadedUser' => admin()->user()->id,
                    'status' => 1,
                    'licensor' => admin()->user()->id
        ]);
        $result = $new->id;
        $content = admin()->user()->name . " Create New Project called" . request('title');
        $notificationData = array(
            'userid' => admin()->user()->id,
            'projectid' => $result,
            'url' => 'admin',
            'content' => $content,
            'is_view' => 0
        );
        $this->createNewNotify($notificationData);
        // |||||| ||| ||| send mail || |||| |||| |||| \\
          
        
        
        /**
         * start get email of licenses and user name 
         */
        $licensorid = admin()->user()->licens;
        
        $lisensor = Admin::find($licensorid);
        $lisensormail = $lisensor->email;
        $lisensesname = admin()->user()->name;
        $projectTitle = request('title');
        
        
        
        
         $data = array('title' => "create new project", 'projectid' => $result , 'licensesname'=>$lisensesname , 'projectTitle'=>$projectTitle);
            Mail::send('emails.projectsmail', $data, function($message)use ($lisensormail, $lisensesname,$projectTitle) {

                $message->to($lisensormail, $lisensesname)
                        ->subject('Approval system');
                $message->from('Admin@system.com', $lisensesname.' create project '.$projectTitle);
            });
        
        
        //|||| ||| ||| ||| end send mail         ||| |||| ||| |||| || \\



        Session::flash('message', '* Project Added successfully');
        Session::flash('alert-class', 'alert-success');

        
         return redirect('admin/project/'.$result);
        
       // return back();
    }

    /**
     * 
     * @param Request $request
     * @return type
     * 
     * 
     * Update project View
     * this function for view the update project blade file 
     */
    public function updateProjectView(Request $request) {
        $projectId = $request->id;

        $projectInfo = approvel_project::find((int) $projectId);

        return view('admin.projects.update', ['project' => $projectInfo, 'notification' => $this->notifydata]);
    }

    /**
     * 
     * @return type
     * 
     * Update project this function for update 
     * project
     */
    public function updateProject() {
        $this->validate(request(), [
            'title' => 'required|unique:approvel_projects|max:255',
            'desc' => 'required'
                ], [], [
            'title' => 'Approval Project title',
            'desc' => 'Approval Project  description'
        ]);

        $id = request('pid');
        $project = approvel_project::find($id);
        $project->title = request('title');
        $project->desc = request('desc');
        $project->save();
        $content = $project->title . " is updated";
        $notificationData = array(
            'userid' => admin()->user()->id,
            'projectid' => $id,
            'url' => 'admin',
            'content' => $content,
            'is_view' => 0
        );
        $this->createNewNotify($notificationData);
        Session::flash('message', 'Project updated successfully');
        Session::flash('alert-class', 'alert-success');
        return back();
    }

    /**
     * 
     * @param Request $request
     * @return type
     * 
     * view single project with versions's project
     */
    public function project(Request $request) {
        // return view('admin.projects.project');
        $checkid = $request->id;
        $project = approvel_project::where('id', $checkid)->get();

        if (count($project) > 0) {
            $projectID = $project[0]->id;
            $commentarray = comments::where('projectid', $projectID)->get();
            $versionarray = projects_versions::where('projectid', $projectID)->get();
            $comment = $this->customArrayForComment($commentarray);
            $versions = $this->customArrayForversions($versionarray);

            return view('admin.projects.project', ['project' => $project, 'comments' => $comment, 'versions' => $versions, 'notification' => $this->notifydata]);
        }
    }

    /**
     * 
     * @param Request $request
     * @return type
     * 
     * create new project's version 
     * 
     * view page
     */
    public function NewProjectVersionView(Request $request) {
        $id = $request->id;
        return view('admin.projects.newversion', ['pid' => $id, 'notification' => $this->notifydata]);
    }

    /**
     * 
     * @param type $array
     * @return type
     * 
     * this is a helper  function for create new 
     */
    private function customArrayForversions($array) {
        $newList = array();
        $num = 1;
        foreach ($array as $listItem) {
            if ($num % 2) {
                $class = "timeline2-inverted";
            } else {
                $class = " ";
            }
            $id = $listItem['userid'];
            $user = Admin::where('id', $id)->get();
            $adminName = $user[0]->name;
            $newList[] = array(
                'uname' => $adminName,
                'url' => $listItem['fileurl'],
                'class' => $class,
                'email' => $listItem['email'],
                'content' => $listItem['comment'],
                'uid' => $id,
                'id' => $listItem['id'],
                'version' => 'version num : ' . $listItem['version']
            );
            $num++;
        }

        return $newList;
    }

    /**
     * 
     * @param Request $request
     * @return type
     * 
     * Create new project 
     */
    public function newProjectVersion(Request $request) {
        $id = request('ke');
        $project_version = projects_versions::where('projectid', $id)->get();

        if (count($project_version) > 0) {
            $version = ount($project_version) + 1;
        } else {
            $version = 1;
        }

        $this->validate(request(), [
            'desc' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                ], [], [
            'desc' => 'Approval Project  description',
            'image' => 'Uploaded file'
        ]);
        $image = $request->file('image');
        $input['imagename'] = time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('/images');
        $image->move($destinationPath, $input['imagename']);

        $new = projects_versions::create([
                    'projectid' => $id,
                    'userid' => admin()->user()->id,
                    'version' => $version,
                    'comment' => request('desc'),
                    'fileurl' => $input['imagename']
        ]);
        $result = $new->id;
        $role = admin()->user()->user_role;
        if ($role == 1 || $role == 2) {
            $url = "user";
        } else {
            $url = "admin";
        }
        $content_n = "Created New version of project ";
        $notificationData = array(
            'userid' => admin()->user()->id,
            'projectid' => $id,
            'url' => $role,
            'content' => $content_n,
            'is_view' => 0
        );
        $this->createNewNotify($notificationData);
        if ($result > 0) {
            return redirect()->back()->with("success", "created successfully !");
        } else {
            return redirect()->back()->with("error", "error on create new version ");
        }
    }

    /**
     * All Projects 
     * @return type
     */
    public function projects() {


        $role = admin()->user()->user_role;
        if ($role == 1 || $role == 2) {

            $all = approvel_project::all();
            return view('admin.projects.projects', ['all' => $all, 'title' => 'All Projects', 'notification' => $this->notifydata]);
        } else {
            $all = approvel_project::where(['uploadedUser' => admin()->user()->id])->get();
            return view('admin.projects.projects', ['all' => $all, 'title' => 'All Projects', 'notification' => $this->notifydata]);
        }
    }

    /**
     * 
     * @param Request $request
     * @return type1
     * 
     *  status 
     * 1= inprogress 
     * 2= approved
     * -1 = rejected
     * -2 = deleted
     */
    public function projectsstatus(Request $request) {
        $type = $request->type;
        $role = admin()->user()->user_role;
        if ($role == 1 || $role == 2) {
            if ($type == "rejected") {
                $all = approvel_project::where(['status' => 0])->get();
                return view('admin.projects.projects', ['all' => $all, 'title' => 'All Projects']);
            } else if ($type == "inProgress") {
                $all = approvel_project::where(['status' => 1])->get();
                return view('admin.projects.projects', ['all' => $all, 'title' => 'All Projects']);
            } else if ($type == "approved") {
                $all = approvel_project::where(['status' => 2])->get();
                return view('admin.projects.projects', ['all' => $all, 'title' => 'All Projects']);
            } else if ($type == "deleted") {
                $all = approvel_project::where(['status' => -2])->get();
                return view('admin.projects.projects', ['all' => $all, 'title' => 'All Projects']);
            } else {
                return back();
            }
        } else if ($role == 3) {
            if ($type == "rejected") {
                $all = approvel_project::where(['uploadedUser' => admin()->user()->id, 'status' => 0])->get();
                return view('admin.projects.projects', ['all' => $all, 'title' => 'All Projects']);
            } else if ($type == "inProgress") {
                $all = approvel_project::where(['uploadedUser' => admin()->user()->id, 'status' => 1])->get();
                return view('admin.projects.projects', ['all' => $all, 'title' => 'All Projects']);
            } else if ($type == "approved") {
                $all = approvel_project::where(['uploadedUser' => admin()->user()->id, 'status' => 2])->get();
                return view('admin.projects.projects', ['all' => $all, 'title' => 'All Projects']);
            } else if ($type == "deleted") {
                $all = approvel_project::where(['uploadedUser' => admin()->user()->id, 'status' => -2])->get();
                return view('admin.projects.projects', ['all' => $all, 'title' => 'All Projects']);
            } else {
                return back();
            }
        }
    }

    /**
     * 
     * @param Request $request
     * @return type
     * 
     * update project status .
     * 
     */
    public function updateprojectstatus(Request $request) {

        $id = $request->id;
        $status = $request->status;
        $role = admin()->user()->user_role;
        if ($role == 1 || $role == 2) {
            $project = approvel_project::find($id);

            $project->status = (int) $status;

            $project->save();
            $content = "Your project " . $project->title . " is updated";
            $notificationData = array(
                'userid' => admin()->user()->id,
                'projectid' => $id,
                'url' => 'user',
                'content' => $content,
                'is_view' => 0
            );
            $this->createNewNotify($notificationData);
            Session::flash('message', 'Project updated successfully');
            Session::flash('alert-class', 'alert-success');
            return back();
        } else {
            return back();
        }
    }

    /**
     * 
     * @param Request $request
     * @return type1
     * 
     *  status 
     * 1= inprogress 
     * 2= approved
     * 0 = rejected
     * -2 = deleted
     */
    public function projectsstatusForAdmin(Request $request) {
        $type = $request->type;

        if ($type == "rejected") {
            $all = approvel_project::where(['status' => 0])->get();
            return view('admin.projects.projects', ['all' => $all, 'title' => 'All Projects']);
        } else if ($type == "inProgress") {
            $all = approvel_project::where(['status' => 1])->get();
            return view('admin.projects.projects', ['all' => $all, 'title' => 'All Projects']);
        } else if ($type == "approved") {
            $all = approvel_project::where(['status' => 2])->get();
            return view('admin.projects.projects', ['all' => $all, 'title' => 'All Projects']);
        } else if ($type == "deleted") {
            $all = approvel_project::where(['status' => -2])->get();
            return view('admin.projects.projects', ['all' => $all, 'title' => 'All Projects']);
        } else {
            return back();
        }
    }

    /**
     * 
     * @param Request $request
     * @return type
     * Save project comment
     */
    public function saveproject_comment(Request $request) {
        $url = $request->encoded_url;
        $projectid = $request->id;
        //     echo $url ; 
        $decode = urldecode($url);
        $curruntUser = admin()->user()->id;
        $ext = pathinfo($decode, PATHINFO_EXTENSION);
        $path = $decode;
        $filename = time() . '.' . $ext;
        $file = file_get_contents($path);
        $save = file_put_contents('images/' . $filename, $file);

        $userDoComment = Admin::where('id', $curruntUser)->get();

        $UserDoCommentName = $userDoComment[0]->name;
        $UserDoCommentemail = $userDoComment[0]->email;
        $content = $UserDoCommentName . "($UserDoCommentemail)was add new comment in your project ";


        comments::create([
            'userid' => (int) $curruntUser,
            'projectid' => $projectid,
            'is_delete' => 0,
            'comment' => $filename,
            'content' => $content
        ]);
        $role = admin()->user()->user_role;
        if ($role == 1 || $role == 2) {
            $url = "user";
        } else {
            $url = "admin";
        }
        $content_n = "Your have a new comment ";
        $notificationData = array(
            'userid' => admin()->user()->id,
            'projectid' => $projectid,
            'url' => $role,
            'content' => $content_n,
            'is_view' => 0
        );
        $this->createNewNotify($notificationData);
        Session::flash('message', 'You leave Comment on this project');
        Session::flash('alert-class', 'alert-success');
        return back();
    }

    /**
     * 
     * @param type $array
     * @return type
     * 
     * this function is a helper function for create new array to load it on the blade view .
     */
    private function customArrayForComment($array) {
        $newList = array();
        $num = 1;
        foreach ($array as $listItem) {
            if ($num % 2) {
                $class = "timeline2-inverted";
            } else {
                $class = " ";
            }
            $id = $listItem['userid'];
            $user = Admin::where('id', $id)->get();
            $adminName = $user[0]->name;
            $newList[] = array(
                'uname' => $adminName,
                'url' => $listItem['comment'],
                'class' => $class,
                'email' => $listItem['email'],
                'content' => $listItem['content'],
                'uid' => $id,
                'id' => $listItem['id']
            );
            $num++;
        }

        return $newList;
    }

    /**
     * 
     * @param Request $request
     * @return type
     * 
     * delete comments 
     * 
     * 
     */
    public function deleteComment(Request $request) {
        $id = $request->id;

        $curruntUser = admin()->user()->id;

        $comment = comments::find($id);

        if ($curruntUser == $comment->id) {
            $comment->delete();
        }
        Session::flash('message', 'You delete your Comment on this project');
        Session::flash('alert-class', 'alert-success');
        return back();
    }

}
