@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading">Books</div>
                    <div class="panel-body">
                        
                        <!---->
                        <div class="col-md-2">
                            <img src="/uploads/avatars/{{$user->avatar}}" style="width:100px; heidth:100px; margin-right:50px; float:left;">
                        </div>
                        
                        <!---->    
                        <div class="col-md-10">
                            
                            <div class="col-sm-12">
                                <div class="col-sm-3">Name :</div>
                                <div class="col-sm-9">{{ $user->name }}</div>
                            </div>
                            
                            <div class="col-sm-12">
                                <div class="col-sm-3">Email :</div>
                                <div class="col-sm-9">{{ $user->email }}</div>
                            </div>
                            
                            <div class="col-sm-12">
                                <div class="col-sm-3">Role :</div>
                                <div class="col-sm-9">{{ $user->role->name }}</div>
                            </div>
                            
                            <div class="col-sm-12">
                                <div class="col-sm-3">Department :</div>
                                <div class="col-sm-9">{{ $user->dep->name }}</div>
                            </div>
                                
                        </div>
                            
                        <!---->    
                        <div id="panel2" style="padding-top:100px;">
                            <h3>Статус чтения</h3>
                            <!---->
                            <div class="col-md-12">                           
                                <h4 style="font-size: 100%; border-bottom: 2px solid maroon; font-weight: normal; padding-bottom: 5px;" >
                                    Хочу прочитать
                                </h4></br>
                                @foreach(App\Status::StatusToUser($user->id, "1")  as $k=>$v)
                                    <a href="/book/{{$v->id}}" style = "text-decoration:none; color:#777;">
                                        <div class="col-sm-3" style="text-align:center;">
                                            <p>
                                                <img src="/uploads/book_avatar/{{$v->avatar}}" style="width:100px; heidth:100px; ">
                                                {{$v->title}}
                                            </p>
                                           
                                        </div>
                                    </a>    
                                @endforeach
                                <div class="col-md-12"><?php echo App\Status::StatusToUser($user->id, "1")->links(); ?></div>
                                    
                            </div>
                            <!---->
                            <div class="col-md-12">                           
                                <h4 style="font-size: 100%; border-bottom: 2px solid maroon; font-weight: normal; padding-bottom: 5px;" >
                                    Читаю
                                </h4></br>
                                @foreach(App\Status::StatusToUser($user->id, "2")  as $k=>$v)
                                    <a href="/book/{{$v->id}}" style = "text-decoration:none; color:#777;" >
                                        <div class="col-sm-3" style="text-align:center;">
                                            <p>
                                                <img src="/uploads/book_avatar/{{$v->avatar}}" style="width:100px; heidth:100px;">
                                                {{$v->title}}
                                            </p>
                                           
                                        </div>
                                    </a>    
                                @endforeach
                                <div class="col-md-12"><?php echo App\Status::StatusToUser($user->id, "2")->links(); ?></div>
                            
                            </div>
                            <!---->
                            <div class="col-md-12">                           
                                <h4 style="font-size: 100%; border-bottom: 2px solid maroon; font-weight: normal; padding-bottom: 5px;" >
                                    Прочел
                                </h4></br>
                                @foreach(App\Status::StatusToUser($user->id, "3")  as $k=>$v)
                                    <a href="/book/{{$v->id}}"style = "text-decoration:none; color:#777;">
                                        <div class="col-sm-3" style="text-align:center;">
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
                            <?php //print_r(Auth::user()->id);  print_r($book->id);?>
                            
                         
    </div>
</div>
@endsection