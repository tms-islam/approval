<aside class="left-side sidebar-offcanvas">
            <section class="sidebar ">
                <div class="page-sidebar  sidebar-nav">
                    <div class="nav_icons">
                    
                    </div>
                    <div class="clearfix"></div>
                    <!-- BEGIN SIDEBAR MENU -->
                    <ul id="menu" class="page-sidebar-menu">
                 @if(admin()->user()->user_role == 1 )
                        <li>
                            <a href="#">
                                <i class="livicon" data-name="users" data-size="18" data-c="#00bc8c" data-hc="#00bc8c" data-loop="true"></i>
                                <span class="title">Users</span>
                                <span class="fa arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="{{aurl('users')}}">
                                        <i class="fa fa-angle-double-right"></i> Users 
                                    </a>
                                </li>
                                 <li>
                                    <a href="{{aurl('users/newUser')}}">
                                        <i class="fa fa-angle-double-right"></i> Add New User 
                                    </a>
                                </li>
                            
                            </ul>
                        </li>
                        @endif
                       
                        <li>
                            <a href="#">
                                <i class="livicon" data-name="move" data-c="#EF6F6C" data-hc="#EF6F6C" data-size="18" data-loop="true"></i>
                                <span class="title">Projects</span>
                                <span class="fa arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="{{aurl('projects/All')}}">
                                        <i class="fa fa-angle-double-right"></i> Projects
                                    </a>
                                </li>
                                   @if(admin()->user()->user_role == 3 )
                                <li>
                                    <a href="{{aurl('projects/AddNewProject')}}">
                                        <i class="fa fa-angle-double-right"></i> New Project
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </li>
                   
                    </ul>
                    <!-- END SIDEBAR MENU -->
                </div>
            </section>
            <!-- /.sidebar -->
        </aside>