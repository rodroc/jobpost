@extends('layouts.master')

@section('title')
Job Orders
@endsection

@section('page-styles')


<style type="text/css">
</style>
@endsection

@section('content-header')
      <h1>
        Find Vehicle
        <small>list</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Job Orders</li>
      </ol>
@endsection

@section('content')

  <table class="table table-hover">

  </table>

  {{ $jobOrders->links() }}

@endsection

@section('page-scripts')

@endsection