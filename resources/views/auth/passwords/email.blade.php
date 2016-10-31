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
                <img src="/uploads/img/logo.png" class="logo">
            </a>
                
                <!--<div class="headers">Туточки наваять заголовки как у гугла</div>-->
                
                <div class="panel panel-default" >
                    <div class="panel-body">
                        
                         @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
    
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                            {{ csrf_field() }}
    
                            <div class="input-email form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <div class="col-md-6 col-md-offset-3">
                                    <input  id="email" 
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
    
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-envelope"></i> Сбросить пароль
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
