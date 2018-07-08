@extends('admin.index')


@section('content')
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Users</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{aurl()}}">
                    <i class="livicon" data-name="home" data-size="14" data-color="#000"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="#">Users</a>
            </li>
            <li class="active">Users List</li>
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
                                <th> Name</th>

                                <th>
                                    User E-mail
                                </th>
                                <th>Status</th>

                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)

                            <tr>
                                <td>{{$user->name}}</td>

                                <td>

                                    {{$user->email}}
                                </td>
                                <td>
                                    @if($user->status == 1)
                                    active
                                    @elseif($user->status == 0)
                                    not active 
                                   
                                    @endif
                                </td>

                                <td>
                                  @if(admin()->user()->id == $user->id )
                                    <a href="{{aurl('profile')}}">View</a>
                                    @else
                                     <a href="{{aurl('profile')}}/{{$user->id}}">View</a>
                                    @endif
                                   

@if($user->user_role != 1)
                                    @if($user->status == 1)
                                    <a href="{{aurl('profile/updatestatus/')}}/{{$user->id}}">Deactive</a>
                                    @elseif($user->status == 0)
                                    <a href="{{aurl('profile/updatestatus/')}}/{{$user->id}}">active</a>

                                    @endif
@endif


                                </td>
                            </tr>

                            @endforeach

                        </tbody>
                    </table>
                    <!-- Modal for showing delete confirmation -->
                    <div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby="user_delete_confirm_title" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title" id="user_delete_confirm_title">
                                        Delete User
                                    </h4>
                                </div>
                                <div class="modal-body">
                                    Are you sure to delete this user? This operation is irreversible.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    <a href="deleted_users.html" class="btn btn-danger">Delete
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- row-->
    </section>
</aside>
@endsection