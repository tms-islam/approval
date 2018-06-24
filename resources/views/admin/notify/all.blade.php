  @extends('admin.index')
  
 
@section('content')
<aside class="right-side">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>Notifications</h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="#">
                            <i class="livicon" data-name="home" data-size="14" data-color="#000"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <a>Notifications</a>
                    </li>
                   
                </ol>
            </section>
            <!-- Main content -->
            <section class="content paddingleft_right15">
                <div class="row">
                    <div class="panel panel-primary ">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <i class="livicon" data-name="user" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i> Users List
                            </h4>
                        </div>
                        <br />
                        <div class="panel-body">
                            <table class="table table-bordered " id="table">
                                <thead>
                                    <tr class="filters">
                                        <th> UserName</th>
                                        
                                        <th>
                                            Project Title
                                        </th>
                                        <th>Content</th>
                                       
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($allnotify as $val)
                                    
                                    <tr>
                                        <td>{{$val['username']}}</td>
                                       
                                        <td>
                                           
                                            <a href="{{aurl('/project/')}}/{{$val['projectid']}}">      {{$val['projectname']}}</a>
                                        </td>
                                        <td>
                                            <a href="{{aurl('/project/')}}/{{$val['projectid']}}">      {{$val['content']}}</a>
                                        
                                        <td>
                                            {{ $val['created_at']->format('Y.m.d H:i:s') }}
                                        </td>
                                    </tr>
                                  
                                   @endforeach
                                   
                                </tbody>
                            </table>
                            <!-- Modal for showing delete confirmation -->
                           
                        </div>
                    </div>
                </div>
                <!-- row-->
            </section>
        </aside>
    @endsection