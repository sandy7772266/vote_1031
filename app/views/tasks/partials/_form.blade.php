<?php Input::flash();?>
{{ Form::open(['url' => '/votes', 'class' => 'form']) }}
	                 
                     <input type="text" class="form-control" placeholder="投票名稱...." autofocus required
                      name="vote_title" 
                         @if (Input::old('vote_title'))
                             value = {{Input::old('vote_title')}}
                         @endif
                      /> 
                     <input type="text" class="form-control" placeholder="投票人數...." autofocus required
                       name="vote_amount" 
                         @if (Input::old('vote_amount'))
                             value = {{Input::old('vote_amount')}}
                         @endif
                       />
                     
                                        
<!-- <div class="container">
    <div class="row">
        <div class='col-sm-6'>
            <div class="form-group"> -->
                <div class='input-group date' id='datetimepicker1'>
                    <input type='text' class="form-control" placeholder="{{$date_now}} (投票開始時間)" autofocus required name="start_at"
                        @if (Input::old('start_at'))
                             value = {{Input::old('start_at')}}
                        @endif
                    />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>

                <div class='input-group date' id='datetimepicker2'>
                    <input type='text' class="form-control" placeholder="{{$date_now}} (投票結束時間)" autofocus required name="end_at"
                     @if (Input::old('end_at'))
                         value = {{Input::old('end_at')}}
                     @endif
                    />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
           <!--  </div>
        </div>

    </div>
</div> -->

                     <input type="text" class="form-control" placeholder="當選人數...." autofocus required
                       name="vote_goal" 
                         @if (Input::old('vote_goal'))
                             value = {{Input::old('vote_goal')}}
                         @endif
                       />      
                     <input type="text" class="form-control" placeholder="可投票數...." autofocus required
                         name="can_select"
                         @if (Input::old('can_select'))
                             value = {{Input::old('can_select')}}
                         @endif
                          />  
                     <input type="text" class="form-control" placeholder="公開(1)不公開(0)...." autofocus required
                         name="public_or_private" 
                         @if (Input::old('public_or_private'))
                             value = {{Input::old('public_or_private')}}
                         @endif    
                         />  
                         

<script type="text/javascript">
            $(function () {
                moment().locale('fr');
                $('#datetimepicker1').datetimepicker();
                moment().locale('fr');
                $('#datetimepicker2').datetimepicker();
            });
</script>                                           

                    <input type="submit"  />
{{ Form::close() }}

