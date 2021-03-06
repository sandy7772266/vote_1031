
@extends('layouts.master')




@section('content')
<div class="col-md-6">
	<h3>{{$votes[0]->school_name}}</h3>
	<ul class="list-group">

		@foreach ($votes as $vote)

			<li class="list-group-item">
				<table>
				<tr>
					@if ( $time_now > $vote->end_at )
				<td ><a href="{{ url('/vote_result_show', array($vote->id), false) }}"><strong><h4>{{$vote->vote_title}}</h4><br>now:{{$time_now}}<br>start:{{$vote->start_at}}end:{{$vote->end_at}}</strong></a>
					@elseif ( $time_now > $vote->start_at)
						<td ><h4>投票進行中...<strong>{{$vote->vote_title}}</h4><br>now:{{$time_now}}<br>start:{{$vote->start_at}}end:{{$vote->end_at}}</strong>
					@else
						<td ><h4>尚未投票...<strong>{{$vote->vote_title}}</h4><br>now:{{$time_now}}<br>start:{{$vote->start_at}}end:{{$vote->end_at}}</strong>
					@endif
				


				</td>
				
				</tr>
				</table>
			</li>
		@endforeach
	</ul>
</div>

@stop