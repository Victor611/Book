@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Books</div>
                    <div class="panel-body">
                       <!--<?php var_dump();?>-->
                        <!---->
                        <div class="col-md-2">
                            <img src="/uploads/avatars/{{$user->avatar}}" style="width:100px; heidth:100px; margin-right:50px; float:left;">
                        </div>
                        
                        <!---->    
                        <div class="col-md-10">
                            
                            <div class="col-sm-12">
                                <div class="col-sm-9"><h3>{{ $user->name }}</h3></div>
                            </div>
                            
                            <div class="col-sm-12">
                                <div class="col-sm-3">Отдел :</div>
                                <div class="col-sm-9">{{ $user->dep->name }}</div>
                            </div>
                                
                        </div>
                            
                        <!--Статус чтения-->    
                        <div id="panel2" style="padding-top:100px;">
                            <h3>Статус чтения</h3>
                            <!--Хочу прочитать -->
                            <div class="col-md-12">                           
                                <h4 style="font-size: 100%; border-bottom: 2px solid maroon; font-weight: normal; padding-bottom: 5px;" >
                                    @if(count(App\Status::StatusToUser($user->id, "1"))>0)
                                            Хочу прочитать
                                    @else Ничего не хочу читать
                                    @endif
                                </h4></br>
                                @foreach(App\Status::StatusToUser($user->id, "1")  as $k=>$v)
                                    <a href="/book/{{$v->id}}" style = "text-decoration:none; color:#777;">
                                        <div class="col-sm-2" style="text-align:center; padding:15px;">
                                            <p>
                                                <img src="/uploads/book_avatar/{{$v->avatar}}"  style="width:100px; heidth:100px; ">
                                            {{$v->title}}
                                            </p>
                                           
                                        </div>
                                    </a>    
                                @endforeach
                                <div class="col-md-12"><?php echo App\Status::StatusToUser($user->id, "1")->links(); ?></div>
                                    
                            </div>
                            <!--Читаю-->
                            <div class="col-md-12">                           
                                <h4 style="font-size: 100%; border-bottom: 2px solid maroon; font-weight: normal; padding-bottom: 5px;" >
                                    @if(count(App\Status::StatusToUser($user->id, "2"))>0)
                                            Читаю
                                    @else Ничего не читаю
                                    @endif
                                </h4></br>
                                @foreach(App\Status::StatusToUser($user->id, "2")  as $k=>$v)
                                    <a href="/book/{{$v->id}}" style = "text-decoration:none; color:#777;" >
                                        <div class="col-sm-2" style="text-align:center; padding:15px;">
                                            <p>
                                                <img src="/uploads/book_avatar/{{$v->avatar}}" style="width:100px; heidth:100px;">
                                                {{$v->title}}
                                            </p>
                                           
                                        </div>
                                    </a>    
                                @endforeach
                                <div class="col-md-12"><?php echo App\Status::StatusToUser($user->id, "2")->links(); ?></div>
                            
                            </div>
                            <!--Прочел-->
                            <div class="col-md-12">                           
                                <h4 style="font-size: 100%; border-bottom: 2px solid maroon; font-weight: normal; padding-bottom: 5px;" >
                                    @if(count(App\Status::StatusToUser($user->id, "3"))>0)
                                            Прочел
                                    @else Ничего не прочел
                                    @endif
                                </h4></br>
                                @foreach(App\Status::StatusToUser($user->id, "3")  as $k=>$v)
                                    <a href="/book/{{$v->id}}" style="text-decoration:none; color:#777;">
                                        <div class="col-sm-2" style="text-align:center; padding:15px;">
                                            <p>
                                                <img src="/uploads/book_avatar/{{$v->avatar}}" style="width:100px; heidth:100px;">
                                                {{$v->title}}
                                            </p>
                                            
                                        </div>
                                    </a>
                                @endforeach
                                <div class="col-md-12"><?php echo App\Status::StatusToUser($user->id, "3")->links(); ?></div>
                    
                            </div>
                        </div>
    </div>
</div>
@endsection