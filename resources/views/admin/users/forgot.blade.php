<!DOCTYPE html>
<html>

<head>
    <title><?php $isTouch = isset($title);
            if ($isTouch) {
                echo $title;
            } else {
                echo 'Forget your password';
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
                            <form  id="reset_pw" autocomplete="on" method="post">
                                <h3 class="black_bg">
                                    <!-- <img src="{{ url('/')}}/design/admin/img/logo.png" alt="josh logo"> -->
                                    <br>FORGOT PASSWORD</h3>
                                <p>
                                    Enter your email address below and we'll send a special reset password link to your inbox.
                                </p>
                                 {!! csrf_field() !!}
                                                                                                @if(Session::has('error'))
<p class="alert alert-class">{{ Session::get('error') }}</p>
@endif
                                <div class="form-group">
                                    <label style="margin-bottom:0;" for="username2" class="youmai">
                                        <i class="livicon" data-name="mail" data-size="16" data-loop="true" data-c="#3c8dbc" data-hc="#3c8dbc"></i> Your email
                                    </label>
                                    <input id="username2" name="username2" placeholder="your@mail.com" />
                                </div>
                                <p class="login button reset_button">
                                    <input type="submit" value="Reset Password" class="btn btn-raised btn-success btn-block" />
                                </p>
                                <p class="change_link">
                                    <a href="{{aurl('login')}}" class="btn btn-raised btn-responsive botton-alignment btn-warning btn-sm to_register">Back
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
