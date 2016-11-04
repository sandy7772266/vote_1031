@extends('layouts.master')




@section('content')


	<div class="col-md-6">
		<h4>投票進行中</h4>
				@foreach ($ary[0] as $vote)

					@if (( $time_now < $vote->end_at ) & ( $time_now > $vote->start_at))
						<td >
							<a href="{{ url('/account_data_show', array($vote->id), false) }}"><strong>籤票內容</strong></a>

							<br><a href="{{ url('/vote_result_show', array($vote->id), false) }}"><strong>{{$vote->vote_title}}<br>

							@if ( $vote->public_or_private == 0)
							不公開<br>
							@endif

							now:{{$time_now}}<br>start:{{$vote->start_at}}end:{{$vote->end_at}}</strong></a><br>
					<?php //		<br><strong>{{$vote->vote_title}}<br>now:{{$time_now}}<br>start:{{$vote->start_at}}end:{{$vote->end_at}}</strong><br>  //php ?>
							<br>
						</td>


					@endif
				@endforeach
	</div>
@stop