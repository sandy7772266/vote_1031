@extends('layouts.master')




@section('content')


	<div class="col-md-6">
		<h4>投票已完成</h4>
				<table>
				@foreach ($ary[0] as $vote)

					@if ( $time_now > $vote->end_at )
					<tr>
						<td >
							<br>投票已完成...
							@if ( $vote->public_or_private == 0)
							不公開
							@endif
							<br><a href="{{ url('/vote_result_show', array($vote->id), false) }}"><strong>{{$vote->vote_title}}<br>now:{{$time_now}}<br>start:{{$vote->start_at}}end:{{$vote->end_at}}</strong></a><br>
						</td>
					</tr>

					@endif
				@endforeach
				</table>
	</div>
@stop

