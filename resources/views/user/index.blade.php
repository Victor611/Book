@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-lg-8">
            <div class="panel panel-default">
               <!-- <div class="panel-heading">Рейтинг пользователей</div>-->
                 
                <div class="panel-body">
                    <?php $i = ($users->currentPage()-1) * $paginator; ?>
                    @foreach ($users as $user)
                        <table class="table task-table" style="padding-top:20px;">
                           
                            <tr>
                                <td><?php echo ++$i; ?></td>
                                <td class="table-text col-sm-3">
                                    
                                    <a href="{{ url('user/'.$user->id) }}"> 
                                        <img src="/uploads/avatars/{{$user->avatar}}" style="width:100px; float:left;">
                                    </a>
                                </td>
                                <!-- Book Name -->
                                <td class="table-text col-sm-9" style="position:relative;">
                                    <div class="col-sm-12">
                                        <a href="{{ url('user/'.$user->id) }}">
                                            <div class="col-sm-9"><h4>{{ $user->name }}</h4></div>
                                        </a>
                                    </div>
                                        
                                    <div class="col-sm-12">
                                        @if($user->count_status3 > 0 )
                                            <div class="col-sm-3">Прочитаны:</div>
                                            <div class="col-sm-9">
                                                    <?php new App\Sklonenie($user->count_status3, ['книгу','книги','книг']);?>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-sm-12">
                                        @if($user->count_coment > 0)
                                            <div class="col-sm-3">Оставил:</div>
                                            <div class="col-sm-9">
                                                <?php new App\Sklonenie($user->count_coment, ['отзыв','отзыва','отзывов']);?>
                                            </div>
                                        @endif
                                    </div>
                                        
                                    <div class="col-sm-12">
                                        @if($user->count_status2 > 0 )
                                            <div class="col-sm-3">Читает:</div>
                                            <div class="col-sm-9">
                                                    <?php new App\Sklonenie($user->count_status2, ['книгу','книги','книг']);?>
                                            </div>
                                            <?php $status_2 = App\Status::StatusToUser($user->id, "2"); $cnt=1;?>
                                            @foreach($status_2  as $k=>$v)
                                                <a href="/book/{{$v->id}}" style = "text-decoration:none; color:#777;" >
                                                    <div class="col-sm-12" style="text-align:left;">
                                                        {{$cnt++}}. {{$v->title}}
                                                    </div>
                                                </a>    
                                            @endforeach
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        </table>
                    @endforeach
                    <?php echo $users->links(); ?>
                </div>
            </div>

        </div>
        <div class="col-md-4 col-lg-4 ">
            <div class="panel panel-default">   
                <!--<div class="panel-heading">Поиск</div>-->
                <div class="panel-body">
                    <p>Поиск</p>
                    <div style=" margin: 3px 5px;">
                        <input class="form-control who" type="text" placeholder="Имя" value="" autocomplete="off" style="display:inline-block; width:auto; vertical-align: middle;">
                        <a class="goto_finded" style="display:none; text-decoration: none;">
                            <button type="button" class="btn btn-info" >Перейти</button>
                        </a>
                        <div class="search_result" style="width:auto;"></div>
                    </div><hr>
                    <!--Cобытие submit - автоматически в скрипте в главном шаблоне app.blade.php-->
                
        
                    <!--Фильтр-->
                    <?php $status = Request::has('status') ? Request::get('status') :false;?>
                    <form action="/users" method="POST" class="filter">
                     {{ csrf_field() }}
                        <p>Фильтр</p>
                        <select name="status" class="form-control filter-input" >
                            <option value="">Все</option>
                                                        
                            <option @if($status=='1') selected @endif value="1">
                                Читающие
                            </option>
                            
                            <option @if($status=='2') selected @endif value="2">
                                Не читающие
                            </option>
                                
                        </select>

                        <hr>
                        <!--Cобытие submit - автоматически в скрипте в главном шаблоне app.blade.php-->
                    </form> 
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
