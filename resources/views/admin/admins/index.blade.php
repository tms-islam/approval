@extends('admin.index')
@section('content')


<aside class="right-side">
            
            <!-- Main content -->
            <section class="content-header">
                <h1>Welcome to Dashboard</h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <a href="#">
                            <i class="livicon" data-name="home" data-size="14" data-color="#333" data-hovercolor="#333"></i> Dashboard
                        </a>
                    </li>
                </ol>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-primary filterable">
                            <div class="panel-heading clearfix  ">
                                <div class="panel-title pull-left">
                                    <div class="caption">
                                        <i class="livicon" data-name="camera" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i> TableTools
                                    </div>
                                </div>
                                <div class="tools pull-right"></div>
                            </div>
                            <div class="panel-body table-responsive">
{!! $dataTable->table() !!}
                </div>
                                  </div>
                        </div>
                    </div>
              
            </section>
</aside>
            
@endsection