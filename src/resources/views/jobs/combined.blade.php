@extends('layouts.master')

@section('title')
Job
@endsection

@section('page-styles')
<link href="/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<style type="text/css">
</style>
@endsection

@section('content-header')
<h1>
  Local & External Jobs
  <small>combined</small>
</h1>
<ol class="breadcrumb">
  <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Job</li>
</ol>
@endsection

@section('content')
<div class="row">
  <div class="col-sm-12 col-md-12 col-lg-12">
    <div class="box box-primary">
      <div class="box-header with-border">
        <!-- <h3 class="box-title">Job Listing</h3> -->
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
        </div>
        <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body">

        @if(count($jobs)>0)
        <table id="jobs" class="table table-hover table-condensed">
          <thead>
            <tr>
              <th>Title</th>
              <th>Employment Type</th>
              <th>Created</th>
            </tr>
          </thead>
          @foreach($jobs as $job)
          <tr class="warning">
            <td>{{ $job['title'] }}</td>
            <td>{{ $job['emptype'] }}</td>
            <td>{{ $job['created_at'] }}</td>
          </tr>
          @endforeach
        </table>
        @else
        <center>--No Job Found--</center>
        @endif
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
</div>

@endsection

@section('page-scripts')

@endsection