@extends('layouts.master')




@section('content')
	<h5 class="text-primary">
	票數限制： {{$can_select}}
	<br>
	敬請注意：一旦點選[確定送出]或按enter鍵，就算完成投票，不可返回修改。
	<br>
	搜尋多個項目時，請以頓號隔開，例如：筱、名、大華
	<br>
	</h5>
	<div class="col-md-6">
	{{ Form::open(['class' => 'form','method'=>'get','route'=>['candidates_select']]) }}
	

                    <input tabindex="1" type="text" class="form-control" placeholder="搜尋文字...." 
                      name="candidate_search[]" value=""/>
                   
	
                    <input type="submit"  value="搜尋"/>
	{{ Form::close() }}

	{{ Form::open(['class' => 'form','method'=>'get','route'=>['candidates_select_result']]) }}

					@if (!$err_msg == '')
						{{$err_msg}}<br>		 
					@endif

					@if (!$srch_msg == '')
						{{$srch_msg}}<br>					 
					@endif
					
					<input type="submit" value="確定送出" />
					<ul class="list-group">
					@foreach ($candidates as $candidate)
						<li class="list-group-item" >
							@if (in_array($candidate, $array_s))
							<h5 class="text-primary">
							@else <h5 >
							@endif
							
							<input tabindex="1" type="checkbox" name="candidate[]" id={{$candidate->id}} value={{$candidate->id}} 

							@if (in_array($candidate->id, $candidates_checked))
								checked
							@endif
							/> 
							<!-- @if (is_array(Input::old('candidate')))
							@if (in_array($candidate->id, Input::old('candidate')))
                   				 echo 'checked="checked"'; 
               				@endif 
               				@endif/> -->
							{{$candidate->cname}} ** {{$candidate->job_title}}**	{{$candidate->sex}}
							
							
				            
				       		</label>
							</h5>
						</li>
					@endforeach
					
			</ul>
		</div>
	
	{{ Form::close() }}


@stop