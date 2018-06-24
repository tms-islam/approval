  
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
        <h1>{{$admin->name}}</h1>
        <ol class="breadcrumb">
            <li>
                <a href="#">
                    <i class="livicon" data-name="home" data-size="14" data-loop="true"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="#">User</a>
            </li>
            <li class="active">{{$admin->name}}</li>
        </ol>
    </section>
    <!--section ends-->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">

                <div class="tab-content mar-top">
                    <div id="tab1" class="tab-pane fade active in">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            {{$admin->name}}({{$admin->email}})
                                        </h3>
                                    </div>
                                    <div class="panel-body">

                                        <div class="col-md-12">
                                            <div class="panel-body">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-striped" id="users">
                                                        <form action="{{aurl('profile/update')}}" method="POST" class="form-horizontal">
                                                            <input type="hidden" name="_token" value="{{csrf_token() }}"/>
                                                            <input type="hidden" name="uid" value="{{$admin->id}}"/> 

                                                            <tr>
                                                                <td>User Name</td>
                                                                <td>
                                                                    {{$admin->name}}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>E-mail</td>
                                                                <td>
                                                                    {{$admin->email}}
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td>Status</td>
                                                                <td>
                                                                    @if($admin->status == 1)
                                                                    active
                                                                    @elseif($admin->status == 0)
                                                                    not active 

                                                                    @endif
                                                                </td>
                                                            </tr>

                                                            </tr>

                                                            @if($admin->user_role == 3)
                                                            <tr>
                                                                <td>Licensor</td>
                                                                <td>
                                                                    <select class="form-control" name="select" >
                                                                        @foreach($licenses as $val)
                                                                        <option name="{{$val->id}}" >{{$val->name}}({{$val->email}})</option>
                                                                        @endforeach
                                                                    </select>
                                                                </td>


                                                            </tr>
                                                            @endif
                                                            <tr>
                                                                <td>
                                                                </td>
                                                                <td>
                                                                    <button type="submit" class="btn btn-primary">Submit</button> 
                                                                </td>
                                                            </tr>


                                                        </form>

                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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