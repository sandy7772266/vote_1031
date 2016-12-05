@extends('layouts.master')




@section('content')
<div class="col-md-6">
	
	
	<?php 
			$index=1;
	      	$redo = $data[3];
	      	$vote_id = Session::get('vote_id');
	?>

		@if ($redo == 1)
		
	    以下為舊的籤票內容	<a href="{{ url('/account_redo_true', array($vote_id), false) }}"><strong>確定重做籤票</strong></a><br>


	    @endif
	籤票共 {{count($data[0])}}  張
	<table class="table table-bordered">
		<tr>
		@foreach ($data[0] as $index =>$account)
			
			
				
				<td>
				
				{{$index+1}}
				學校代號：{{$data[1]}}<br>
				投票代號：{{$account->vote_id}}<br>
				籤號：{{$account->username}}<br>
				起始時間：{{$data[4]}}<br>
				結束時間：{{$data[5]}}{{$index}}
				</td>
				@if (($index % 2) == 1)
					</tr><tr>
				@endif
					

			
		@endforeach
			</tr>
	</table>


	
</div>

@stop