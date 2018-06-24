@extends('admin.index')
@section('content')
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <!--section starts-->
        <h1>Update Projects</h1>
        <ol class="breadcrumb">
            <li>
                <a href="#">
                    <i class="livicon" data-name="home" data-size="14" data-loop="true"></i>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{aurl('projects/All')}}">projects</a>
            </li>
            
        </ol>
    </section>
    <!--section ends-->
    
    <section class="content">
        <!--main content-->
        <div class="row">
            <!--row starts-->
            <div class="col-md-12">

                <div class="panel panel-warning" id="hidepanel5">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="livicon" data-name="gift" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                           Update {{$project->title}}
                        </h3>
                        <span class="pull-right">
                            <i class="glyphicon glyphicon-chevron-up clickable"></i>
                            <i class="glyphicon glyphicon-remove removepanel clickable"></i>
                        </span>
                        
                   
                    </div>
                    <div class="panel-body">
                         @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                        <form role="form" method="post" action="{{aurl('project/ConfirmUpdate')}}" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token() }}">
                            <input type="hidden" name="pid" value="{{$project->id}}"/>
       @if(Session::has('message'))
    <div class="alert {{ Session::get('alert-class') }}alert-dismissable margin5">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ Session::get('message') }}
    </div>
                          @endif
                           
                            <div class="form-group input-group">
                                <span class="input-group-addon">title</span>
                                <input type="text" name="title" class="form-control" value="{{$project->title}}" placeholder="">
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon">Description</span>
                                <input type="text" name="desc" value="{{$project->desc}}" class="form-control" placeholder="">
                            </div>


<!--                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
                                <div>
                                    <span class="btn btn-default btn-file">
                                        <span class="fileinput-new">Select image</span>
                                        <span class="fileinput-exists">Change</span>
                                        <input type="file" name="image"></span>
                                    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                </div>
                            </div>-->
                            <div class="form-actions">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    &nbsp;

                                 
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

        <!--main content ends--> </section>
    <!-- content --> </aside>
@endsection