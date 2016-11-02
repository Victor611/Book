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

        .search_result{
            background: #FFF;
            border: 1px #ccc solid;
            min-width: 197px;
            border-radius: 4px;
            /*max-height:200px;*/
            overflow-y:scroll;
            display:none;
            position: absolute;
            z-index: 9;
        }

        .search_result p{

            padding: 5px 10px;
            /*margin: 0 0 0 -40px;*/
            /*color: #0896D3;*/
            /*border-bottom: 1px #ccc solid;*/
            /*cursor: pointer;*/
            /*transition:0.3s;*/


        }

        .search_result p:hover{
            background: #5d9fd8;
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
			<h3>Bookshelf</h3>
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/book') }}">Книги</a></li>
                    <li><a href="{{ url('/users') }}">Пользователи</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                    @else
                        <li class="dropdown">
                            @if(Auth::user()->hasRole('admin'))
                                
                                    <a href="{{ url('/admin/log') }}" style="color: #777; text-decoration: none; float:left; padding-top:20px;">Admin Panel</a>
                               
                            @elseif (Auth::user()->hasRole('moderator'))
                                
                                    <a href="{{ url('/moder/book') }}" style="color: #777; text-decoration: none; float:left; padding-top:20px; ">Moderator Panel</a>
                                
                            @endif
                            
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style=" padding-left:50px; float:left; ">
                                <img src="/uploads/avatars/{{Auth::user()->avatar}}" style="width:32px; height:32px;  top:10px; left:10px; border-radius:50%">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/profile') }}"><i class="fa fa-btn fa-user"></i>Profile</a></li>
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- JavaScripts -->
    <script src="/jquery/jquery-2.2.3.min.js"></script>
    <script src="/bootstrap-3.3.7/js/bootstrap.min.js"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    <script>
		$(function(){
			//Живой поиск
			$('.who').bind("change keyup input", function() {
                $(".search_result").html("");
                $(".goto_finded").hide();

                if(this.value.length >= 3){
					$.ajax({
						type: 'post',
						url: "/users/find",
						data: {'part':this.value},
						response: 'json',
						success: function(data){
                            data = JSON.parse(data);
                            var i = 0;

                            $.each(data, function(user_id, name) {
                                var row = "<p class='finded' id='" + user_id + "' style='cursor:pointer;'>" + name + "</p>";
                                $(".search_result").append(row);
                                i++;
                            });
                            if(i = 0)
                            {
                                $(".search_result").fadeOut();
                            } else {
                                $(".search_result").fadeIn();
                            }

						},
                        error: function(data){
                            console.log("Errror: " + data);
                        }
					})
				} else {
                    $(".search_result").fadeOut();
                }
			})
				
			$(".search_result").hover(function(){
				$(".who").blur(); //Убираем фокус с input
			});
				
			//При выборе результата поиска, прячем список и заносим выбранный результат в input
			$(".search_result").on("click", "p", function(){
				var uid = $(this).attr('id');
				var name = $(this).html();
                //window.location.href = '/user/'+uid;
                $(".goto_finded").attr('href', '/user/'+uid);
                $(".who").val(name);
                //$(".who").attr('disabled', 'disabled'); //деактивируем input, если нужно
                $(".search_result").fadeOut();
                $(".goto_finded").css('display', 'inline-block');
			});


	
		});



        // Автосабмит фильтров поиска книг
        $(".filter-input").change(function(){
            $(".filter").submit();
        });
    </script>
</body>
</html>
