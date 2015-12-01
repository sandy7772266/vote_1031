@extends('layouts.master')




@section('content')
	票數限制： {{$can_select}}
	<br>
	搜尋多個項目時，請以、隔開，例如：筱、名、大華
	<br>
	<div class="col-md-6">
	{{ Form::open(['class' => 'form','method'=>'get','route'=>['candidates_select']]) }}
	

                    <input tabindex="1" type="text" class="form-control" placeholder="搜尋文字...." 
                      name="candidate_search[]" value=""/>
                   
	
                    <input type="submit"  value="搜尋"/>
	{{ Form::close() }}

	{{ Form::open(['class' => 'form','method'=>'get','route'=>['candidates_select_result']]) }}

					@if ($err_msg)
						{{$err_msg}}
					@endif

					@if ($srch_msg)
						{{$srch_msg}}
					@endif
					
					<ul class="list-group">
					@foreach ($candidates as $candidate)
						<li class="list-group-item">
							<input tabindex="1" type="checkbox" name="candidate[]" id={{$candidate->id}} value={{$candidate->id}}>
							{{$candidate->cname}} ** {{$candidate->job_title}}**	{{$candidate->sex}}
							<br>
						</li>
					@endforeach
					<input type="submit"  />
			</ul>
		</div>
	
	{{ Form::close() }}


@stop