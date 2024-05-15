@extends('layouts.master')

@section('title')
Post New Job
@endsection

@section('page-styles')
<link href="/plugins/bootstrap3-dialog/bootstrap-dialog.min.css" rel="stylesheet" type="text/css">
<style type="text/css">
  .bootstrap-dialog .modal-header.bootstrap-dialog-draggable {
    cursor: move;
  }
</style>
@endsection

@section('content-header')
<h1>
  <small class=""></small>
</h1>
<ol class="breadcrumb">
  <li><a href="/jobs"><i class="fa fa-dashboard"></i> Jobs</a></li>
  <li class="active">Post Job</li>
</ol>
@endsection

@section('content')

<div class="row">
  <div class="col-sm-12 col-md-12 col-lg-12">
    <!-- general form elements -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Job Details</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
        </div>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form role="form" action="{{ $job->id==null?'/jobs/save':'/jobs/update' }}" method="POST">
        <input type="hidden" name="_method" value="POST">
        @csrf
        <input type="hidden" name="id" value="{{ $job->id?$job->id:null }}">
        <div class="box-body">
          <div class="form-group">
            <label for="title">Job Title</label>
            <input type="text" class="form-control" name="title" placeholder="Enter the job title" value="{{ $job->title?$job->title:'' }}" maxlength="50" required>
          </div>

          <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" name="description" required rows="3">{{ $job->description?$job->description:''}}</textarea>
          </div>

          <div class="form-group">
            <label for="phone" class="col-form-label">Employment Type</label>
            <select name="emptype" class="form-control" required>
              <option value="">-- please select--</option>
              @foreach($empTypes as $k=>$v)
              <option value="{{$k}}">{{$v}}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label for="email">Email of Moderator</label>
            <input type="email" class="form-control" name="moderator_email" placeholder="Enter the email address if tg" value="{{ $job->moderator_email?$job->moderator_email:'' }}" required>
          </div>

          @if (!is_null($job->id))
          <div class="checkbox">
            <label>
              <input type="checkbox" name="spam" {{ ($job->spam!=0? 'checked="checked"':'') }}"> Spam
            </label>
          </div>

          <div class="checkbox">
            <label>
              <input type="checkbox" name="active" {{ ($job->active!=0? 'checked="checked"':'') }}"> Active
            </label>
          </div>
          @endif

        </div>

        <!-- /.box-body -->

        <div class="box-footer">
          <button type="submit" class="btn btn-primary">{{ $job->id==null?'Create':'Update' }}</button>
        </div>
      </form>
    </div>
    <!-- /.box -->
  </div>
</div>

@endsection

@section('page-scripts')
<script src="/plugins/bootstrap3-dialog/bootstrap-dialog.min.js"></script>
<script>

</script>

@endsection