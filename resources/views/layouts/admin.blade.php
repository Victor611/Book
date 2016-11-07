<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Bookshelf</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="/font-awesome-4.6.3/css/font-awesome.min.css">
    

    <!-- Styles -->
    <link rel="stylesheet" href="/bootstrap-3.3.7/css/bootstrap.min.css">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        body {
            font-family: 'Arial';
        }

        .fa-btn {
            margin-right: 6px;
        }
		
		.table tr:hover {
			background-color: #fcf8e3; /* Цвет фона под ссылкой */ 
		} 
    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-static-top" style="min-height:57px;">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a href="{{ url('/') }}">
                   <!-- <img src="/uploads/img/logo.png" style="width:200px; left:10px; top:10px;">-->
					<h3 style="margin-top:17px;"><b>Bookshelf</b></h3>
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav" style="margin: 0 0 0 110px;">
                    <li style="padding-top:5px;">
						<a href="{{ url('/admin/log') }}">
							@if($_SERVER["REQUEST_URI"] =="/admin/log" )
								<span style="color:#337ab7;">Логи</span>
							@else
								<span>Логи</span>
							@endif
						</a>
					</li>
                    <li style="padding-top:5px;">
						<a href="{{ url('/admin/user') }}">
							@if($_SERVER["REQUEST_URI"] =="/admin/user" )
								<span style="color:#337ab7;">Пользователи</span>
							@else
								<span>Пользователи</span>
							@endif
						</a>
					</li>
                    <li style="padding-top:5px;">
						<a href="{{ url('/admin/book') }}">
							@if($_SERVER["REQUEST_URI"] =="/admin/book")
								<span style="color:#337ab7;">Книги</span>
							@else
								<span>Книги</span>
							@endif
						</a>
					</li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="position:relative; padding-left:50px;">
                                <img src="/uploads/avatars/{{Auth::user()->avatar}}" style="width:32px; height:32px; position:absolute; top:10px; left:10px; border-radius:50%">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/profile') }}"><i class="fa fa-btn fa-user"></i>Профиль</a></li>
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Выход</a></li>
                            </ul>
                        </li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- JavaScripts -->
    <script src="/jquery/jquery-2.2.3.min.js"></script>
    <script src="/bootstrap-3.3.7/js/bootstrap.min.js"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
