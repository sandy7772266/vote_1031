<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />

		{{ HTML::style('css/bootstrap.min.css') }}
		{{ HTML::style('css/application.css') }}
		{{ HTML::style('js/jquery-2.0.3.min.js') }}
		{{ HTML::style('js/application.js') }}
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="css/application.css" />
		
		<script src="js/jquery-2.0.3.min.js" type="text/javascript"></script>
		<script src="js/application.js" type="text/javascript"></script>
			<script src="js/bootstrap.min.js" type="text/javascript"></script>
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
					<a class="navbar-brand" href="{{route('home')}}">Laravel Vote App</a>
				</div>
				<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav test">
						<li><a href="{{route('school_select')}}">投票結果</a></li>
					</ul>
					<ul class="nav navbar-nav">
					@if (Session::has('builder_name'))
						

 <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">管理畫面 <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="{{url('/insert-first') }}">新增</a></li>
                   <li role="separator" class="divider"></li>
            <li><a href="{{route('voting')}}">投票進行中</a></li>
            <li><a href="{{route('votes_not_yet')}}">尚未投票</a></li>
 
            <li><a href="{{route('votes_done')}}">投票已完成</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="{{route('logout/openid')}}">管理者登出</a></li>
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