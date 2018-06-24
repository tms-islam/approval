<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <title>
            <?php
            $isTouch = isset($title);
            if ($isTouch) {
                echo $title;
            } else {
                echo 'Admin system';
            }
            ?>
        </title>
    @yield('css')
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <!-- global css -->
        <link href="{{ url('/')}}/design/admin/css/app.css" rel="stylesheet" type="text/css" />
        <!-- end of global css -->
        <!--page level css -->
        <link href="{{ url('/')}}/design/admin/vendors/fullcalendar/css/fullcalendar.css" rel="stylesheet" type="text/css" />
        <link href="{{ url('/')}}/design/admin/css/pages/calendar_custom.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" media="all" href="{{ url('/')}}/design/admin/vendors/bower-jvectormap/css/jquery-jvectormap-1.2.2.css" />
        <link rel="stylesheet" href="{{ url('/')}}/design/admin/vendors/animate/animate.min.css">
        <link rel="stylesheet" type="text/css" href="{{ url('/')}}/design/admin/vendors/datetimepicker/css/bootstrap-datetimepicker.min.css">
        <link rel="stylesheet" href="{{ url('/')}}/design/admin/css/pages/only_dashboard.css" />


        <!---  datatable  ----->
        <link rel="stylesheet" type="text/css" href="{{ url('/')}}/design/admin/vendors/datatables/css/dataTables.bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="{{ url('/')}}/design/admin/vendors/datatables/css/buttons.bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="{{ url('/')}}/design/admin/vendors/datatables/css/colReorder.bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="{{ url('/')}}/design/admin/vendors/datatables/css/dataTables.bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="{{ url('/')}}/design/admin/vendors/datatables/css/rowReorder.bootstrap.css">
        <link rel="stylesheet" type="text/css" href="{{url('/')}}/design/admin/vendors/datatables/css/buttons.bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="{{ url('/')}}/design/admin/vendors/datatables/css/scroller.bootstrap.css" />
        <link href="{{ url('/')}}/design/admin/css/pages/tables.css" rel="stylesheet" type="text/css">
        <!--end of page level css-->

        <link href="{{ url('/')}}/design/admin/vendors/jasny-bootstrap/css/jasny-bootstrap.css" rel="stylesheet">
        <link href="{{ url('/')}}/design/admin/vendors/iCheck/css/all.css" rel="stylesheet" type="text/css" />
        <link href="{{ url('/')}}/design/admin/css/pages/form_layouts.css" rel="stylesheet" type="text/css" />
        
         <link rel="stylesheet" type="text/css" href="{{ url('/')}}/design/admin/vendors/datatables/css/dataTables.bootstrap.css" />
    <link href="{{ url('/')}}/design/admin/css/pages/tables.css" rel="stylesheet" type="text/css" />
      <link href="{{ url('/')}}/design/admin/css/pages/animated-masonry-gallery.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ url('/')}}/design/admin/vendors/fancybox/jquery.fancybox.css" media="screen" />
    
     
    </head>

    <body class="skin-josh">
        <header class="header">
            <a href="#" class="logo">
               Approval System
            </a>
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <div>
                    <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                        <div class="responsive_nav"></div>
                    </a>
                </div>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="livicon" data-name="message-flag" data-loop="true" data-color="#42aaca" data-hovercolor="#42aaca" data-size="28"></i>
                                <span class="label label-success">4</span>
                            </a>
                            <ul class="dropdown-menu dropdown-messages pull-right">
                                <li class="dropdown-title">4 New Messages</li>
                                <li class="unread message">
                                    <a href="javascript:;" class="message"> <i class="pull-right" data-toggle="tooltip" data-placement="top" title="Mark as Read"><span class="pull-right ol livicon" data-n="adjust" data-s="10" data-c="#287b0b"></span></i>
                                        <img src="{{ url('/')}}/design/admin/img/authors/avatar.jpg" class="img-responsive message-image" alt="icon" />
                                        <div class="message-body">
                                            <strong>Riot Zeast</strong>
                                            <br>Hello, You there?
                                            <br>
                                            <small>8 minutes ago</small>
                                        </div>
                                    </a>
                                </li>
                                <li class="unread message">
                                    <a href="javascript:;" class="message">
                                        <i class="pull-right" data-toggle="tooltip" data-placement="top" title="Mark as Read"><span class="pull-right ol livicon" data-n="adjust" data-s="10" data-c="#287b0b"></span></i>
                                        <img src="{{ url('/')}}/design/admin/img/authors/avatar1.jpg" class="img-responsive message-image" alt="icon" />
                                        <div class="message-body">
                                            <strong>John Kerry</strong>
                                            <br>Can we Meet ?
                                            <br>
                                            <small>45 minutes ago</small>
                                        </div>
                                    </a>
                                </li>
                                <li class="unread message">
                                    <a href="javascript:;" class="message">
                                        <i class="pull-right" data-toggle="tooltip" data-placement="top" title="Mark as Read">
                                            <span class="pull-right ol livicon" data-n="adjust" data-s="10" data-c="#287b0b"></span>
                                        </i>
                                        <img src="{{ url('/')}}/design/admin/img/authors/avatar5.jpg" class="img-responsive message-image" alt="icon" />
                                        <div class="message-body">
                                            <strong>Jenny Kerry</strong>
                                            <br>Dont forgot to call...
                                            <br>
                                            <small>An hour ago</small>
                                        </div>
                                    </a>
                                </li>
                                <li class="unread message">
                                    <a href="javascript:;" class="message">
                                        <i class="pull-right" data-toggle="tooltip" data-placement="top" title="Mark as Read">
                                            <span class="pull-right ol livicon" data-n="adjust" data-s="10" data-c="#287b0b"></span>
                                        </i>
                                        <img src="{{ url('/')}}/design/admin/img/authors/avatar4.jpg" class="img-responsive message-image" alt="icon" />
                                        <div class="message-body">
                                            <strong>Ronny</strong>
                                            <br>Hey! sup Dude?
                                            <br>
                                            <small>3 Hours ago</small>
                                        </div>
                                    </a>
                                </li>
                                <li class="footer">
                                    <a href="#">View all</a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="livicon" data-name="bell" data-loop="true" data-color="#e9573f" data-hovercolor="#e9573f" data-size="28"></i>
                                <span class="label label-warning"></span>
                            </a>
                            <ul class=" notifications dropdown-menu">
                                <li class="dropdown-title">You have 0 notifications</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        
                                       
<!--                                        <li>
                                            <i class="livicon danger" data-n="timer" data-s="20" data-c="white" data-hc="white"></i>
                                            <a href="#">after a long time</a>
                                            <small class="pull-right">
                                                <span class="livicon paddingright_10" data-n="timer" data-s="10"></span>
                                                Just Now
                                            </small>
                                        </li>-->
                                       
                                        <li>
                                            <!--<i class="livicon warning" data-n="thumbs-up" data-s="20" data-c="white" data-hc="white"></i>-->
                                            <a href="#"></a>
                                            <small class="pull-right">
                                                <span class="livicon paddingright_10" data-n="timer" data-s="10"></span>

                                            </small>
                                        </li>
                                   
                                    </ul>
                                </li>
                                <li class="footer">
                                    <a href="#">View all</a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <!--<img src="{{ url('/')}}/design/admin/img/authors/avatar3.jpg" width="35" class="img-circle img-responsive pull-left" height="35" alt="riot">-->
                                <div class="riot">
                                    <div>
                                        {{admin()->user()->name}}
                                        <span>
                                            <i class="caret"></i>
                                        </span>
                                    </div>
                                </div>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
<!--                                <li class="user-header bg-light-blue">
                                    <img src="{{ url('/')}}/design/admin/img/authors/avatar3.jpg" width="90" class="img-circle img-responsive" height="90" alt="User Image" />
                                    <p class="topprofiletext">{{admin()->user()->name}}</p>
                                </li>-->
                                <!-- Menu Body -->
                               
                                <li role="presentation"></li>
                                <li>
                                    <a href="{{aurl('profile')}}">
                                        <i class="livicon" data-name="gears" data-s="18"></i> Account Settings
                                    </a>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                   
                                    <div class="pull-right">
                                        <a href="{{url('admin/logout')}}">
                                            <i class="livicon" data-name="sign-out" data-s="18"></i> Logout
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">