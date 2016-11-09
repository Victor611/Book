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
        
        .panel-default {
            margin-top: 30px;
        }
        .input-email {
            margin-top: 20px;
        }
        
        
        
                
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3"  >
                <a href="{{url('/')}}">
					<!--<h3 class="logo">Bookshelf</h3>-->
                    <img src="/uploads/img/logo.png" class="logo" style="margin-top:10px;">
                </a>
                <!--<div class="headers">Туточки наваять заголовки как у гугла</div>-->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
                            {{ csrf_field() }}
    
                            <input type="hidden" name="token" value="{{ $token }}">
    
                            <div class="input-email form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <div class="col-md-6 col-md-offset-3">
                                    <input  id="email" 
					    type="email" 
					    class="form-control" 
					    name="email" 
  					    placeholder="E-mail"
					    value="{{ $email or old('email') }}">
    
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
    
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <div class="col-md-6 col-md-offset-3">
                                    <input  id="password" 
					    type="password" 
					    class="form-control" 
					    name="password"
					    placeholder="Введите новый пароль">
    
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
    
                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <div class="col-md-6 col-md-offset-3">
                                    <input  id="password-confirm" 
					    type="password" 
					    class="form-control" 
					    name="password_confirmation"
					    placeholder="Повторите ввод пароля">
    
                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
    
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-refresh"></i> Reset Password
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
