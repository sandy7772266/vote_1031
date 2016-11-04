@extends('layouts.master')




@section('content')


	<div class="col-md-6">
		<h5>請輸入投票代號與籤號<br>(投票結果為一般教師可以瀏覽<br>
		管理者登入可設定特定組長或主任才能登入<br>
		目前因便於測試，故兩者皆設教師身分即可登入)</h5>
		<h5 class="text-primary">
		@if($err)
			{{$err}}	
			{{$err=''}}
		@endif
		</h5>
		@include('tasks/partials/_form_account')
	</div>
@stop