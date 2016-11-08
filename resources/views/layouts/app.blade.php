<!DOCTYPE html>
<html lang="ru">
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
            border-radius: 4px;
            overflow-y:scroll;
            display:none;
            position: absolute;
            z-index: 9;
        }

        .search_result p{
            padding: 5px 10px;
         }

        .search_result p:hover{
            background: #5d9fd8;
        }
		
		.panel{
			border: transparent;
    	}
		
		.table tr:hover {
			background-color: #fcf8e3; /* Цвет фона под ссылкой */ 
		}
		
		.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
			padding: 28px 8px 28px 8px;
		}
		
		.alignRight{
			text-align: right;
		}
    </style>
</head>
<body id="app-layout">
   <nav class="navbar navbar-default navbar-static-top" >
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
						<a href="{{ url('/book') }}">
							@if($_SERVER["REQUEST_URI"] =="/book" || $_SERVER["REQUEST_URI"] =="/" )
								<span style="color:#337ab7;">Книги</span>
							@else <span>Книги</span>
							@endif
						</a>
					</li>
                    <li style="padding-top:5px;">
						<a href="{{ url('/users') }}">
							@if($_SERVER["REQUEST_URI"]=="/users")
								<span style="color:#337ab7;">Пользователи</span>
							@else
								<span>Пользователи</span>
							@endif
						</a>
					</li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Войти</a></li>
                    @else
                        <li class="dropdown">
                            @if(Auth::user()->hasRole('admin'))
                                
                                    <a href="{{ url('/admin/log') }}" style="color: #777; text-decoration: none; float:left; padding-top:20px;">Администрирование</a>
                               
                            @elseif (Auth::user()->hasRole('moderator'))
                                
                                    <a href="{{ url('/moder/book') }}" style="color: #777; text-decoration: none; float:left; padding-top:20px; ">Модерация</a>
                                
                            @endif
                            
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style=" padding-left:50px; float:left; ">
                                <img src="/uploads/avatars/{{Auth::user()->avatar}}" style="width:32px; height:32px;  top:10px; left:10px; border-radius:50%">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/profile') }}"><i class="fa fa-btn fa-user"></i>Профиль</a></li>
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Выход</a></li>
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

		$(".g").click(function(){
			$(".filtr").submit();
        });

        // Автосабмит фильтров поиска книг
        $(".filter-input").change(function(){
            $(".filter").submit();
        });
		//Проверка максимального размера файла
		$("#formupload").submit(function(){
			var size = parseInt($("#fileupload")[0].files[0].size);//Мб
			size = Math.round(((size/1024)/1024));
			if (size>2){
				$("#max").html("<p>Размер файла не должен быть больше чем 2 мб.</p>");
				return false;
			}
		});

    </script>
</body>
</html>
