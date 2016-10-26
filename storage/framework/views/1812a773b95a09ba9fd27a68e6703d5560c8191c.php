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
    <?php /* <link href="<?php echo e(elixir('css/app.css')); ?>" rel="stylesheet"> */ ?>

    <style>
        body {
            font-family: 'Arial';
        }

        .fa-btn {
            margin-right: 6px;
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
                <a href="<?php echo e(url('/')); ?>">
                    <img src="/uploads/img/logo.png" style="width:200px; left:10px; top:10px;">
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="<?php echo e(url('/book')); ?>">Книги</a></li>
                    <li><a href="<?php echo e(url('/users')); ?>">Пользователи</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    <?php if(Auth::guest()): ?>
                        <li><a href="<?php echo e(url('/login')); ?>">Login</a></li>
                    <?php else: ?>
                        <li class="dropdown">
                            <?php if(Auth::user()->hasRole('admin')): ?>
                                
                                    <a href="<?php echo e(url('/admin/log')); ?>" style="color: #777; text-decoration: none; float:left; padding-top:20px;">Admin Panel</a>
                               
                            <?php elseif(Auth::user()->hasRole('moderator')): ?>
                                
                                    <a href="<?php echo e(url('/moder/book')); ?>" style="color: #777; text-decoration: none; float:left; padding-top:20px; ">Moderator Panel</a>
                                
                            <?php endif; ?>
                            
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style=" padding-left:50px; float:left; ">
                                <img src="/uploads/avatars/<?php echo e(Auth::user()->avatar); ?>" style="width:32px; height:32px;  top:10px; left:10px; border-radius:50%">
                                <?php echo e(Auth::user()->name); ?> <span class="caret"></span>
                            </a>
                            
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?php echo e(url('/profile')); ?>"><i class="fa fa-btn fa-user"></i>Profile</a></li>
                                <li><a href="<?php echo e(url('/logout')); ?>"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <?php echo $__env->yieldContent('content'); ?>

    <!-- JavaScripts -->
    <script src="/jquery/jquery-2.2.3.min.js"></script>
    <script src="/bootstrap-3.3.7/js/bootstrap.min.js"></script>
    <?php /* <script src="<?php echo e(elixir('js/app.js')); ?>"></script> */ ?>
</body>
</html>
