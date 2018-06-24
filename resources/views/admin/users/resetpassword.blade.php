<!DOCTYPE html>
<html>

<head>
    <title>Login | Josh Admin Template</title>
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
                            <form  id="authentication" autocomplete="on" method="post">
                                {!! csrf_field() !!}
                                <h3 class="black_bg">
                                  
                                    <br>Resset password</h3>
                                                                      @if(Session::has('error'))
<p class="alert alert-class">{{ Session::get('error') }}</p>
@endif
                                <div class="form-group ">
                                    <label style="margin-bottom:0;" for="email1" class="uname control-label"> <i class="livicon" data-name="mail" data-size="16" data-loop="true" data-c="#3c8dbc" data-hc="#3c8dbc"></i> E-mail
                                    </label>
                                    <input id="email1" name="email" placeholder="E-mail" value="{{$data->email}}" />
                                    <div class="col-sm-12">
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label style="margin-bottom:0;" for="password" class="youpasswd"> <i class="livicon" data-name="key" data-size="16" data-loop="true" data-c="#3c8dbc" data-hc="#3c8dbc"></i> Password
                                    </label>
                                    <input type="password" id="password" name="password" placeholder="Enter a password" />
                                    <div class="col-sm-12">
                                    </div>
                                </div>
                                 <div class="form-group ">
                                    <label style="margin-bottom:0;" for="password" class="youpasswd"> <i class="livicon" data-name="key" data-size="16" data-loop="true" data-c="#3c8dbc" data-hc="#3c8dbc"></i> Password
                                    </label>
                                    <input type="password" id="password" name="passwordc" placeholder="Enter a confirm password" />
                                    <div class="col-sm-12">
                                    </div>
                                </div>
                               @if($errors->all())
                               @foreach($errors as $error)
<li>{{$error}}
</li>
                               @endforeach

                               @endif
                                <p class="login button">
                                    <input type="submit" value="Log In" class="btn btn-success" />
                                </p>
                                <p class="change_link">
                                    <a href="{{aurl('forgot')}}" class="btn btn-responsive botton-alignment btn-warning btn-sm">Forgot password
                                    </a>
                                    
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
