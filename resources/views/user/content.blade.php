@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
            <div class="panel panel-default">
                <!--<div class="panel-heading">Пользователь</div>-->
                <div class="panel-body">
                   
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
                            <div class="col-sm-3">Прочел:</div>
                            <div class="col-sm-9">
                                    @if($user->count_status == null) 0  книг
                                    @else <?php new App\Sklonenie($user->count_status, ['книгу','книги','книг']);?>
                                    @endif
                            </div>
                        </div>    
                                    
                        <div class="col-sm-12">
                            <div class="col-sm-3">Оставил:</div>
                            <div class="col-sm-9">
                                @if($user->count_coment == null) 0 отзывов
                                @else <?php new App\Sklonenie($user->count_coment, ['отзыв','отзыва','отзывов']);?>
                                @endif
                                            
                            </div>
                        </div>
                            
                    </div>
                        
                    <!--Статус чтения-->    
                    <div id="panel2" style="padding-top:100px;">
                        <h3>Статус чтения</h3>
                       
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
                
            <!--</div>-->
                
            @foreach($coment as $c)         
            @if(count($c->coment)>0)
                <!--<div class="panel panel-default">-->
                    <!--<div class="panel-heading">Последние комментарии</div>-->
                    <h4 style="font-size: 100%; border-bottom: 2px solid maroon; font-weight: normal; padding: 0 30px 5px 30px; " >
                        Последние комментарии
                    </h4></br>
                    <div class="panel-body">
                        <div class="col-sm-12">
                        <hr>
                            <div class="col-md-1">
                                <a href="{{ url('book/'.$c->book_id) }}">
                                    <img src="/uploads/book_avatar/{{$c->avatar}}" style="max-width:70px; float:left;">
                                </a>
                            </div>
                            <div class="col-md-11">
                                <div class="col-sm-12">
                                    <a href="{{ url('book/'.$c->book_id) }}" style="text-decoration:none; color: black;">
                                         <b style="font-size:16px;">
                                             {{ $c->title }}
                                         </b>
                                    </a>
                                    <span style="color:grey; font-size:12px;padding-left:15px;">
                                         {{$c->updated_at->format('d-m-Y')}} в {{$c->updated_at->format('H:i')}}
                                     </span>
                                </div>
                                <div class="col-sm-12" style="font-size:16px;">{{ $c->coment }}</div>	
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @endforeach
        </div>
    </div>
</div>
@endsection