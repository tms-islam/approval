<!DOCTYPE html>
<html>

    <head>
        <title> <?php $isTouch = isset($title);
            if ($isTouch) {
                echo $title;
            } else {
                echo 'Change password';
            }
            ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- global level css -->
        <link href="{{ url('/')}}/design/admin/css/bootstrap.min.css" rel="stylesheet" />
        <!-- end of global level css -->
        <link href="{{ url('/')}}/design/admin/vendors/iCheck/css/square/blue.css" rel="stylesheet" type="text/css" />
        <link href="{{ url('/')}}/design/admin/vendors/bootstrapvalidator/css/bootstrapValidator.min.css" rel="stylesheet" />
        <!-- page level css -->
        <link rel="stylesheet" type="text/css" href="{{ url('/')}}/design/admin/css/pages/login.css" />
        <!-- end of page level css -->
    </head>

    <body>
        <div class="container">
            <div class="row vertical-offset-100">
                <div class="col-sm-6 col-sm-offset-3  col-md-5 col-md-offset-4 col-lg-4 col-lg-offset-4">
                    <div id="container_demo">
                        <a class="hiddenanchor" id="toregister"></a>
                        <a class="hiddenanchor" id="tologin"></a>
                        <a class="hiddenanchor" id="toforgot"></a>
                        <div id="wrapper">
                            <div id="login" class="animate form">
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
                                <form  id="authentication" autocomplete="on" action="{{aurl('confrimNewPass')}}"  method="post">
                                    {!! csrf_field() !!}
                                    <h3 class="black_bg">

                                        <br>Change password</h3>
                                  
                                    <div class="form-group ">
                                        <label style="margin-bottom:0;" for="password" class="youpasswd"> <i class="livicon" data-name="key" data-size="16" data-loop="true" data-c="#3c8dbc" data-hc="#3c8dbc"></i> Password
                                        </label>
                                        <input type="password" name="newpassword" placeholder="New Password" value="" />
                                        <input type="hidden" name="keys" value="{{$key}}"/>
                                        <div class="col-sm-12">
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label style="margin-bottom:0;" for="password" class="youpasswd"> <i class="livicon" data-name="key" data-size="16" data-loop="true" data-c="#3c8dbc" data-hc="#3c8dbc"></i> Password
                                        </label>
                                        <input type="password" id="password" name="cpassword" placeholder="Enter a confirm password" />
                                        <div class="col-sm-12">
                                        </div>
                                    </div>
                                    
                                    <p class="login button">
                                        <input type="submit" value="change" class="btn btn-success" />
                                    </p>
                                 
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- global js -->
        <script src="{{ url('/')}}/design/admin/js/app.js" type="text/javascript"></script>
        <!-- end of global js -->
        <script src="{{ url('/')}}/design/admin/vendors/bootstrapvalidator/js/bootstrapValidator.min.js" type="text/javascript"></script>
        <script src="{{ url('/')}}/design/admin/vendors/iCheck/js/icheck.js" type="text/javascript"></script>
        <script src="{{ url('/')}}/design/admin/js/pages/login.js" type="text/javascript"></script>
    </body>

</html>
