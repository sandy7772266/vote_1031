@extends('layouts.master')




@section('content')
<div class="col-md-6">
	
	<ul class="list-group">

		@foreach ($accounts as $account)
			<li class="list-group-item">

				<h5>{{$account->username}}</h5>
				<br>


			</li>
		@endforeach
	</ul>
</div>

@stop