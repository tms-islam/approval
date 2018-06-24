@extends('admin.index')
@section('css')
<link href="{{ url('/')}}/design/admin/css/pages/timeline2.css" rel="stylesheet" />
@endsection

@section('js')


<script type="text/javascript">

    var featherEditor = new Aviary.Feather({
    apiKey: '1234567',
            onSave: function(imageID, newURL) {
            var img = document.getElementById(imageID);
            img.src = newURL;
            var url = encodeURIComponent(newURL);
            window.location.replace("/admin/Approval/" + url + "/" + {{$project[0] -> id}});
            // alert(newURL);

            }
    });
    function launchEditor(id, src) {
    featherEditor.launch({
    image: id,
            url: src
    });
    return false;
    }

</script>
@endsection
@section('content')


<aside class="right-side">
    <section class="content-header">
        <h1>{{$project[0]->title}}</h1>
        <ol class="breadcrumb">
            <li>
                <a href="index.html">
                    <i class="livicon" data-name="home" data-size="14" data-color="#000"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="#">projects</a>
            </li>
            <li class="active">
                <a href="#">{{$project[0]->title}}</a>
            </li>
        </ol>
    </section>
    @if(Session::has('message'))
    <div class="alert {{ Session::get('alert-class') }}alert-dismissable margin5">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ Session::get('message') }}
    </div>
    @endif
    <section class="content">
        <!--main content-->
        <section class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary tabtop">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <i class="livicon" data-name="crop" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i> {{$project[0]->title}}
                            </h4>
                        </div>
                        <div class="panel-body" style="padding-top:5px !important;">
                            <div class="table-responsive">
                                <div class="nav-tabs-custom">

                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_1" style="padding:10px;">
                                            <div class="col-md-8">

                                                <img id="editableimage1" src="{{url('/')}}/images/{{$project[0]->fileurl}}" class="img-responsive" alt="[Jcrop Example]" />
                                            </div>
                                            <div class="col-md-4">
                                                <div class="description">
                                                    <p> {{$project[0]->desc}}
                                                    </p>
                                                    <a href="#" class="btn btn-primary btn_sizes" onclick="return launchEditor('editableimage1',
                                                                '{{url(' / ')}}/images/{{$project[0]->fileurl}}');">Add Comment !</a>
                                                </div>

                                                @if(admin()->user()->user_role !=3)
                                                <div class="row">
                                                    @if($project[0]->status == 0)
                                                    (rejected)
                                                    @endif
                                                    @if($project[0]->status == 1)
                                                    <a href="{{aurl('projects/updatestatus/')}}/{{$project[0]->id}}/0" class="btn btn-danger btn_sizes" >Reject</a>
                                                    <a href="{{aurl('projects/updatestatus/')}}/{{$project[0]->id }}/2" class="btn btn-primary btn_sizes" >Approve</a>

                                                    @endif
                                                    @if($project[0]->status == 2)
                                                    (Approved)
                                                    @endif
                                                    @if($project[0]->status == -2)
                                                    (deleted)
                                                    @endif
                                                </div>
                                                @endif

                                                @if(admin()->user()->user_role == 3)
                                                <div class="row">
@if($project[0]->status == 1)
                                                    <a href="{{ aurl('/') }}/project/NewVersion/{{$project[0]->id}}" class="btn btn-primary btn_sizes" >New version</a>
                                            @endif
                                                </div>
                                                @endif



                                            </div>
                                        </div>

                                    </div>
                                    <!-- /.tab-content -->
                                </div>
                                <!-- nav-tabs-custom -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- row-->
        </section>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="livicon" data-name="sky-dish" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i> Versions
                        </h3>
                        <span class="pull-right clickable">
                            <i class="glyphicon glyphicon-chevron-up"></i>
                        </span>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <ul class="timeline2">
                                <?php
                                if (count($versions) == 0) {
                                    echo"No New Version Found";
                                } else {
                                    ?> 
                                    @foreach($versions as $val)
                                    <li class="{{$val['class']}}">
                                        <div class="timeline2-badge">
                                            <a>
                                                <i class="glyphicon glyphicon-record invert" data-toggle="tooltip" title="{{$val['uname']}}"></i>
                                            </a>
                                        </div>
                                        <div class="timeline2-panel">
                                            <div class="timeline2-heading">
                                                <img id="edit{{$val['id']}}" src="{{ url('/')}}/images/{{$val['url']}}" data-src="holder.js/580x160/#00BC8C:#fff" class='img-responsive' alt="image">
                                            </div>

                                            <div class="timeline2-footer">
                                                <p>{{$val['content']}}</p>

                                                <p>{{$val['version']}}</p>
                                            </div>
                                            <a href="#"  onclick="return launchEditor('edit{{$val['id']}}',
                                                                 '{{url(' / ')}}/images/{{$val['id']}}');">Add Comment !</a>
                                        </div>
                                    </li>


                                    <li class="clearfix" style="float: none;"></li>
                                    @endforeach
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>
                        <!--timeline ends-->
                    </div>
                </div>
            </div>
        </div>
        <!--timeline2-->
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="livicon" data-name="sky-dish" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i> Comments
                        </h3>
                        <span class="pull-right clickable">
                            <i class="glyphicon glyphicon-chevron-up"></i>
                        </span>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <ul class="timeline2">
                                <?php
                                if (count($comments) == 0) {
                                    echo"No Commects Found";
                                } else {
                                    ?> 
                                    @foreach($comments as $val)
                                    <li class="{{$val['class']}}">
                                        <div class="timeline2-badge">
                                            <a>
                                                <i class="glyphicon glyphicon-record invert" data-toggle="tooltip" title="{{$val['uname']}}"></i>
                                            </a>
                                        </div>
                                        <div class="timeline2-panel">
                                            <div class="timeline2-heading">
                                                <img src="{{ url('/')}}/images/{{$val['url']}}" data-src="holder.js/580x160/#00BC8C:#fff" class='img-responsive' alt="image">
                                            </div>

                                            <div class="timeline2-footer">
                                                <p>{{$val['content']}}</p>

                                                @if(admin()->user()->id == $val['uid'] )
                                                <a href="{{ url('/')}}/admin/project/delc/{{$val['id']}}" class="pull-right">delete</a>
                                                @endif
                                            </div>
                                        </div>
                                    </li>


                                    <li class="clearfix" style="float: none;"></li>
                                    @endforeach
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>
                        <!--timeline ends-->
                    </div>
                </div>
            </div>
        </div>
        <!--main content ends-->
    </section>
</aside>


@endsection