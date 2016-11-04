@extends('layouts.master')




@section('content')


	<div class="col-md-6">
		<h4>尚未投票</h4>
				@foreach ($ary[0] as $vote)

					@if ($time_now < $vote->start_at)
						
			<?php
					$candidates = Candidate::where('vote_id', '=', $vote->id)->get();
					$can_id = null;
					if ( count($candidates) <> 0 ){
					$can_id = $candidates[0]->id;

					}
					?>
			<li class="list-group-item">
				<table>
				<tr>
				<td ><strong>{{$vote->vote_title}}<br>
				@if ( $vote->public_or_private == 0)
				不公開<br>
				@endif

				now:{{$time_now}}<br>start:{{$vote->start_at}}end:{{$vote->end_at}}</strong></td>
				<td >
				@if ($ary[1][$vote->id]<>'沒有資料')

				<!-- {{$ary[1][$vote->id]}} -->
				<a href="{{ url('/candidate_data_show', array($vote->id), false) }}"><strong>瀏覽選項內容</strong></a>
				
				
				@else
				沒有選項內容
				@endif 
				</td>
				<td>
				@if ( $can_id <> null )	
				<a href="{{ url('/insert-second', array($vote->id), false) }}"><strong>重新上傳選項內容</strong></a>
				@else
				<a href="{{ url('/insert-second', array($vote->id), false) }}"><strong>上傳選項內容</strong></a>
				@endif
				</td>
				<td>
				<a href="{{ url('/account_data_show', array($vote->id), false) }}"><strong>籤票內容</strong></a>
				</td>
				
				<td>
				<a href="{{ url('/account_data_redo', array($vote->id), false) }}"><strong>重新製作籤票</strong></a>

<!-- 				{{ Form::open(['url' => 'votes', 'class' => 'form','method'=>'delete','route'=>['votes.destroy', $vote->id]]) }}
 -->			
 				</td>
 				<td>
 				<a href="{{ url('/', array($vote->id), false) }}"><strong>編輯{{ $vote->vote_title }}</strong></a>	                                               
 				</td>
 				<td>
 				{{ Form::open(['class' => 'form','method'=>'delete','route'=>['votes.destroy', $vote->id]]) }}
				
                {{ Form::submit('刪除',['class'=>'btn btn-default btn-xs'])}}
				{{ Form::close() }}



				<!-- {{Form::model($vote,array('route'=>array('votes.update',$vote->id)))}}			

				{{Form::text('vote_title')}}

				<input type="submit"  />
				{{ Form::close() }} -->
				</td>
					

				</tr>
				</table>
			</li>





					@endif
				@endforeach
	</div>
@stop