@extends('layouts.master')




@section('content')
	<h5 class="text-primary">
	投票完成！您投給：
	<br>
	
	</h5>
	<div class="col-md-6">

	

					
					
					<ul class="list-group">
					
					@foreach ($candidates_selected as $cname)
						<li class="list-group-item" >
							
							<h5 class="text-primary">
										{{$cname}}
							<label {{ $cname }}">
				            <strong></strong>
				       		</label>
							</h5>
						</li>
					@endforeach
					
			</ul>
		</div>
	
	{{ Form::close() }}


@stop