@extends('admin.index')
@section('content')


 @section('css')
   <link href="vendors/jasny-bootstrap/css/jasny-bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="vendors/x-editable/css/bootstrap-editable.css" rel="stylesheet" type="text/css" />
    <link href="css/pages/user_profile.css" rel="stylesheet" type="text/css" />
  @endsection
  
  @section('js')
  <!-- Bootstrap WYSIHTML5 -->
    <script src="vendors/jasny-bootstrap/js/jasny-bootstrap.js" type="text/javascript"></script>
    <script src="vendors/jquery-mockjax/js/jquery.mockjax.js" type="text/javascript"></script>
    <script src="vendors/x-editable/js/bootstrap-editable.js" type="text/javascript"></script>
    <script src="js/pages/user_profile.js" type="text/javascript"></script>
    <!-- end of page level js -->
  @endsection
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <!--section starts-->
        <h1>Account Setting</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{aurl()}}">
                    <i class="livicon" data-name="home" data-size="14" data-loop="true"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="#">User</a>
            </li>
            <li class="active">User Profile</li>
        </ol>
    </section>
    <!--section ends-->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <ul class="nav  nav-tabs ">
                  
                  
                </ul>
                <div class="tab-content mar-top">
                    <div id="tab1" class="tab-pane fade active in">
                <div class="row">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                    
                            <div class="col-md-12 pd-top">
                                
                                  
                                <form action="{{aurl('changepassword')}}" method="POST" class="form-horizontal">
                                    <input type="hidden" name='_token' value="{{csrf_token()}}"/>
                                    <div class="form-body">
                                           <div class="form-group">
                                            <label for="inputpassword" class="col-md-3 control-label">
                                                Old Password
                                                <span class='require'>*</span>
                                            </label>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="livicon" data-name="key" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
                                                    </span>
                                                    <input type="password" id="inputpassword" name='oldpassword' placeholder="Old Password" class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputpassword" class="col-md-3 control-label">
                                                Password
                                                <span class='require'>*</span>
                                            </label>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="livicon" data-name="key" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
                                                    </span>
                                                    <input type="password" name='newpassword'  id="inputpassword" placeholder="New Password" class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputnumber" class="col-md-3 control-label">
                                                Confirm Password
                                                <span class='require'>*</span>
                                            </label>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="livicon" data-name="key" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
                                                    </span>
                                                    <input type="password" id="inputnumber" name='cpassword'  placeholder="Confirm Password" class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            &nbsp;
                                            <input type="reset" class="btn btn-default hidden-xs" value="Reset">
                                        </div>
                                    </div>
                                </form>
                            </div>
                    
                    
                        </div>
                    </div>
                  
                </div>
            </div>
        </div>
    </section>
    <!-- content -->
</aside>
<!-- right-side -->

@endsection