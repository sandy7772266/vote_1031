@extends('layouts.master')




@section('content')


	<div class="col-md-6">
		<h5>請輸入投票代號與籤號</h5>
		<h5 class="text-primary">
		@if($err)
			{{$err}}	
			{{$err=''}}
		@endif
		</h5>
		@include('tasks/partials/_form_account')
	</div>
@stop