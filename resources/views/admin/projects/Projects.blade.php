@extends('admin.index')
@section('content')
<!-- 
Right side column. Contains the navbar and content of the page -->



<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Approval Projects</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{aurl()}}">
                    <i class="livicon" data-name="home" data-size="14" data-loop="true"></i> Dashboard
                </a>
            </li>
            <li>
                Projects
            </li>

        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="content gallery">
            <div class="row" id="slim">
                <div id="gallery">
                    <!--<div class="col-md-5 col-xs-12" >Projects</div>-->
                    <div class="pull-right">
                        <div class="col-xs-12">
                            <a href="{{aurl('projects/All')}}"  id="filter-all" class="btn btn-responsive btn-info btn-xs">All</a>
                            <a href="{{aurl('projects/status/rejected')}}" id="filter-approved" class="btn btn-responsive btn-danger btn-xs">Reject</a>
                            <a href="{{aurl('projects/status/approved')}}"id="filter-reject" class="btn btn-responsive btn-success btn-xs">Approve</a>
                            <a href="{{aurl('projects/status/inProgress')}}" id="filter-reject" class="btn btn-responsive btn-success btn-xs">in progress</a>
                        </div>
                    </div>
                    <div id="gallery-content">
                        <div class="row">

                            @foreach($all as $value)
                            <div class="col-md-4">
                                <div class="portlet box primary ui-sortable-handle">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            {{$value->title}}
                                            @if($value->status == 0)
                                            (rejected)
                                            @endif
                                            @if($value->status == 1)
                                            (inprogress)
                                            @endif
                                            @if($value->status == 2)
                                            (Approved)
                                            @endif
                                            @if($value->status == -2)
                                            (deleted)
                                            @endif
                                        </div>
                                        <div class="actions">
@if($value->uploadedUser == admin()->user()->id && $value->status == 1 )
                                            <a href="{{aurl('project/update/')}}/{{$value->id}}" class="btn btn-default btn-sm">
                                                <i class="fa fa-pencil"></i> Edit
                                            </a>
@endif
                                        </div>
                                    </div>
                                    <div class="portlet-body">

                                        <a class="fancybox img-responsive" href="{{aurl('project/')}}/{{$value->id}}" data-fancybox-group="gallery" title="{{$value->title}}({{$value->desc}})">
                                            <img  src="{{url('/images/')}}/{{$value->fileurl}}" class="img-responsive all reject" alt="gallery">

                                        </a>
                                        <div>
                                            {{$value->desc}}
                                        </div>
                                    </div>
                                </div>

                            </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- .images-box -->

                </div>
            </div>
        </div>
    </section>
    <!-- content -->
</aside>
<!-- right-side -->
@endsection