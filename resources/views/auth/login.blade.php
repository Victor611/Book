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
        
        .logo {
            display:block;
            margin: 30px auto;
            text-align: center;
        }
        .btn-primary {
            width: 100%;
        }
        .rememberme {
            text-align:center;
        }
        .panel-default {
            margin-top: 30px;
        }
        .input-email {
            margin-top: 20px;
        }
        
        .input-pass {
            margin-top: 10px;
        }
        
                
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3"  >
                <a href="{{url('/')}}">
                    <h3 class="logo">Bookshelf</h3>
                    <!--<img src="/uploads/img/logo.png" class="logo">-->
                </a>
                <!--<div class="headers">Туточки наваять заголовки как у гугла</div>-->
                
                <div class="panel panel-default" >
                    <div class="panel-body">
                        
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                            {{ csrf_field() }}
    
                            <div class="input-email form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <div class="col-md-6 col-md-offset-3">
                                    <input id="email"
                                            type="email"
                                            class="form-control"
                                            name="email"
                                            placeholder="E-mail"
                                            value="{{ old('email') }}">
    
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
    
                            <div class="input-pass form-group{{ $errors->has('password') ? ' has-error' : '' }}">    
                                <div class="col-md-6 col-md-offset-3">
                                    <input  id="password"
                                            type="password"
                                            class="form-control"
                                            placeholder="Password"
                                            name="password">
    
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                    
                                </div>
                            </div>
                                
                            <div class="form-group">
                               <div class="col-md-6 col-md-offset-3">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-sign-in"></i> Войти
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-6 col-md-offset-3 rememberme">
                                <label><input type="checkbox" name="remember"> Запомнить меня</label>
                            </div>
                           
                            
                                 
                        </form>
                    </div>
                        
                        
                        
                </div>
                <div class="col-md-6 col-md-offset-9">
                    <a class="btn btn-link" href="{{ url('/password/reset') }}">Забыли пароль?</a>
                </div>
                    
            </div>
        </div>
    </div>
</body>
</html>