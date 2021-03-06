<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
		<link rel="stylesheet" href="{{ asset('css/application.css') }}" />
		<script src="{{ asset('js/jquery-2.0.3.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset('js/application.js') }}" type="text/javascript"></script>
		<script src="{{ asset('js/bootstrap.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset('js/moment2.js') }}" type="text/javascript" ></script>
		<script src="{{ asset('js/bootstrap-datetimepicker.js') }}" type="text/javascript" ></script>
		<script type="text/javascript" src="js/bootstrap-datetimepicker.js"></script>

	</head>
		
	<body>
		
		<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container">
				<div class="navbar-header">

					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle Navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="{{route('home')}}">我要投票</a>
				</div>
				<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav test">
						
					@if (!Session::has('school_no'))
						<li><a href="{{route('put_parameter')}}">投票結果</a></li>
					@else
						<li><a href="{{route('vote_result_show_index')}}">投票結果</a></li>
					@endif
					</ul>
					@if ((Session::has('teacher_name')) or (Session::has('builder_name')))
					<ul class="nav navbar-nav test">
				
						<li><a href="{{route('logout/openid')}}">登出</a></li>
							
					</ul>
					@endif




					<ul class="nav navbar-nav">
					@if (Session::has('builder_name'))
						

 <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">管理畫面 <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="{{route('vote.insert-first')}}">新增</a></li>
                   <li role="separator" class="divider"></li>
            <li><a href="{{route('voting')}}">投票進行中</a></li>
            <li><a href="{{route('votes_not_yet')}}">尚未投票</a></li>
 
            <li><a href="{{route('votes_done')}}">投票已完成</a></li>
            <li role="separator" class="divider"></li>
           <!--  <li><a href="{{route('logout/openid')}}">管理者登出</a></li> -->
          </ul>
 </li>






					@else
						<li ><a href="{{route('login/openid')}}">管理者登入</a></li>
					@endif
					</ul>
				</div>

			</div>
		</div>
		

		<div class="container">
			@yield('content')
		</div>
		
	</body>
</html>