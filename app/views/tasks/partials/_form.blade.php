{{ Form::open(['url' => '/votes', 'class' => 'form']) }}
	                 
                     <input type="text" class="form-control" placeholder="投票名稱...." autofocus required
                      name="vote_title" /> 
                     <input type="text" class="form-control" placeholder="投票人數...." autofocus required
                       name="vote_amount" />
                                        
<!-- <div class="container">
    <div class="row">
        <div class='col-sm-6'>
            <div class="form-group"> -->
                <div class='input-group date' id='datetimepicker1'>
                    <input type='text' class="form-control" placeholder="2015-10-15 12:00:00" autofocus required name="start_at"/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>

                <div class='input-group date' id='datetimepicker2'>
                    <input type='text' class="form-control" placeholder="2015-10-15 12:00:00" autofocus required name="end_at"/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
           <!--  </div>
        </div>

    </div>
</div> -->

                     <input type="text" class="form-control" placeholder="當選人數...." autofocus required
                       name="vote_goal" />      
                     <input type="text" class="form-control" placeholder="可投票數...." autofocus required
                         name="can_select" />  

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

