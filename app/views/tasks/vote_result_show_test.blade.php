@extends('layouts.master')




@section('content')
<h3>投票結果</h3>

	<div class="col-md-6">
		<ul class="list-group">

		@foreach ($candidates as $candidate)
			<li class="list-group-item">

				{{$candidate->cname}}
				{{$candidate->job_title}}
				{{$candidate->sex}}
				@if ($candidate->total_count>0)
				<a href="{{ url('/votes_from_whom', array($candidate->id), false) }}"><strong>{{$candidate->total_count}}</strong></a>
				@else
					<strong>{{$candidate->total_count}}</strong>
				@endif
				<br>

			</li>
		@endforeach
	</ul>
	</div>
@stop