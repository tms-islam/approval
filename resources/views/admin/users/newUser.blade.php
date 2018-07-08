@extends('admin.index')
@section('content')





<aside class="right-side">

    <section class="content-header">
        <!--section starts-->
        <h1>New User</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{aurl()}}">
                    <i class="livicon" data-name="home" data-size="14" data-loop="true"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="{{aurl(/users)}}">Users</a>
            </li>
            <li class="active">New User</li>
        </ol>
    </section>
    @if(Session::has('message'))
    <div class="alert {{ Session::get('alert-class') }}alert-dismissable margin5">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ Session::get('message') }}
    </div>
    @endif
    <section class="content">
        <div class="col-lg-12">
            <div class="row">
                <div class="tab-content mar-top">
                    <div  class="tab-pane fade active in">
                        <div class="row">

                            <div class="col-lg-12">

                                <div class="col-lg-12">
                                    <div class="panel panel-info">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">
                                                <i class="livicon" data-name="doc-portrait" data-c="#fff" data-hc="#fff" data-size="18" data-loop="true"></i> Add New User
                                            </h3>
                                            <span class="pull-right">
                                                <i class="fa fa-fw fa-chevron-up clickable"></i>
                                                <i class="fa fa-fw fa-times removepanel clickable"></i>
                                            </span>
                                        </div>
                                        <div class="panel-body">


                                            <form action="{{aurl('addNewUser')}}" method="POST" class="form-horizontal">
                                                <input type="hidden" name="_token" value="{{csrf_token() }}"/>
                                                <div class="form-body">
                                                    <div class="form-group pad-top40">
                                                        <label for="inputUsername" class="col-md-3 control-label">
                                                            Username
                                                        </label>
                                                        <div class="col-md-9">
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <i class="livicon" data-name="user" data-size="18" data-c="#000" data-hc="#000" data-loop="true"></i>
                                                                </span>
                                                                <input type="text" name="name" class="form-control" placeholder="Username">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputEmail" class="col-md-3 control-label">
                                                            Email
                                                        </label>
                                                        <div class="col-md-6">
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <i class="livicon" data-name="mail" data-size="18" data-c="#000" data-hc="#000" data-loop="true"></i>
                                                                </span>
                                                                <input type="text" name="email" placeholder="Email Address" class="form-control" />
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="form-group">
                                                        <label for="inputAddress" class="col-md-3 control-label">
                                                            Role
                                                        </label>
                                                        <div class="col-md-6">
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <i class="livicon" data-name="users" data-c="#000" data-hc="#000" data-size="18" data-loop="true"></i>
                                                                </span>
                                                                <!--<input type="text" class="form-control" placeholder=" Address">-->
                                                                <select name="select" class="form-control">


                                                                    @foreach($roles as $role)
                                                                    <option value='{{$role->id}}' >{{$role->user_role_name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="inputAddress" class="col-md-3 control-label">
                                                            Licensor
                                                        </label>
                                                        <div class="col-md-6">
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <i class="livicon" data-name="users" data-c="#000" data-hc="#000" data-size="18" data-loop="true"></i>
                                                                </span>
                                                                <!--<input type="text" class="form-control" placeholder=" Address">-->
                                                                <select name="licenses" class="form-control">


                                                                    @foreach($licenses as $val)
                                                                    <option value="{{$val->id}}" >{{$val->name}}({{$val->email}})</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="form-actions">
                                                    <div class="col-md-offset-3 col-md-9">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                        &nbsp;
                                                        <button type="button" class="btn btn-danger">Cancel</button>
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


                </div>
            </div>
    </section>

</aside>


@endsection
