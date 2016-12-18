@extends('layouts.master')




@section('content')
<div class="col-md-6">
	
	
	<?php 
			$index=1;
	      	$redo = $data[3];
	      	$vote_id = Session::get('vote_id');
	      	$vote = vote::where('id', '=', $vote_id)->get();
	?>

		@if ($redo == 1)
		
	    以下為舊的籤票內容	<a href="{{ url('/account_redo_true', array($vote_id), false) }}"><strong>確定重做籤票共{{$vote[0]->vote_amount}}張</strong></a><br>


	    @endif
	籤票共 {{count($data[0])}}  張
	<table class="table table-bordered col-md-12">
		<tr>
		@foreach ($data[0] as $index =>$account)
			
			
				
				<td class="col-md-4">
				<h4>
				
				{{$index+1}}<br>
				學校代號：{{$data[1]}}<br>
				投票代號：{{$account->vote_id}}<br>
				籤號：{{$account->username}}<br>
				起始時間：<br><h5>{{$data[4]}}</h5>
				<h4>
				結束時間：<br><h5>{{$data[5]}}</h5>
				</h4>
				</td>

				@if ((($index+1) % 3) == 0)
					</tr><tr>
				@endif
					

			
		@endforeach
			</tr>
	</table>


	
</div>

@stop