@extends('layouts.master')




@section('content')

<?php $school_name_session = Session::get('school_name');?>
	<div class="col-md-6">
		<h4>{{$school_name_session}}：投票已完成</h4>
	
				<table>
				@foreach ($ary[0] as $vote)

					@if ( $time_now > $vote->end_at )
					<tr>
						<td >
							<br>投票已完成...
							@if ( $vote->public_or_private == 0)
							<h5>不公開</h5>
							@endif
							<a href="{{ url('/vote_result_show', array($vote->id), false) }}"><strong><h5>{{$vote->vote_title}}<br>now:{{$time_now}}<br>start:{{$vote->start_at}}<br>end:{{$vote->end_at}}</h5></strong></a><br>
						</td>
					</tr>

					@endif
				@endforeach
				</table>
	</div>
@stop

