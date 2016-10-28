@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading">Users</div>
                    <div class="panel-body">       
                        @foreach ($users as $user)
                            <table class="table table-striped task-table">
                                <tr>
                                    <td class="table-text col-sm-3">
                                        <a href="{{ url('user/'.$user->id) }}">
                                            <img src="/uploads/avatars/{{$user->avatar}}" style="width:150px; float:left;">
                                        </a>
                                    </td>
                                    <!-- Book Name -->
                                    <td class="table-text col-sm-9" style="position:relative;">
                                        <div class="col-sm-12">
                                            <div class="col-sm-3">Имя :</div>
                                            <div class="col-sm-9">{{ $user->name }}</div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="col-sm-3">Роль :</div>
                                            <div class="col-sm-9">{{ $user->role->name }}</div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="col-sm-3">Отдел :</div>
                                            <div class="col-sm-9">{{ $user->dep->name }}</div>
                                        </div>
                                            
                                        <div class="col-sm-12">
                                            <div class="col-sm-3">Прочел:</div>
                                            <div class="col-sm-9">
                                                <?php  new App\Sklonenie(App\Status::countStatus(($user->id), 3), ['книга','книги','книг']);?>
                                            </div>
                                        </div>    
                                        
                                        <div class="col-sm-12">
                                            <div class="col-sm-3">Оставил:</div>
                                            <div class="col-sm-9">
                                                <!--склонение в зависимости от количества отзывов у юзера-->
                                             <?php new App\Sklonenie(App\Coment::countComent($user->id),['отзыв','отзыва','отзывов']);?>
                                            </div>
                                        </div>
                                            
                                        <!-- More Button -->                    
                                        <div style="position: absolute; right:5px; bottom:5px;">
                                            <a href="{{ url('user/'.$user->id) }}">
                                                <button type="submit" class="btn btn-info">
                                                    <i class="glyphicon glyphicon-eye-open"></i> Подробнее 
                                                </button>
                                            </a>
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
                <div class="panel-heading">Filter</div>
                <div class="panel-body">
                
                <?php $sort = Request::has('sort') ? Request::get('sort') :false;?>
                <form action="/users" method="post">
                     {!! csrf_field() !!}
                        <p><input name="sort" type="radio" value="">
                            Без сортировки </p><hr>
                        <p><input name="sort" type="radio" @if($sort=='name::asc') checked @endif value="name::asc">
                            По имени от А до Я <i class="glyphicon glyphicon-arrow-up"></i>
                        </p>
                        
                        <p><input name="sort" type="radio" @if($sort=='name::desc') checked @endif value="name::desc">
                            По имени от Я до А <i class="glyphicon glyphicon-arrow-down"></i>
                        </p>
                        
                        <p><input name="sort" type="radio" @if($sort=='role_id::asc') checked @endif value="role_id::asc">
                            Роли по возрастанию <i class="glyphicon glyphicon-arrow-up"></i>
                        </p>
                        
                        <p><input name="sort" type="radio" @if($sort=='role_id::desc') checked @endif value="role_id::desc">
                            Роли по убыванию <i class="glyphicon glyphicon-arrow-down"></i>
                        </p>
                        
                        <p><input name="sort" type="radio" @if($sort=='dep_id::asc') checked @endif value="dep_id::asc">
                            По подразделению от А до Я <i class="glyphicon glyphicon-arrow-up"></i>
                        </p>
                        
                        <p><input name="sort" type="radio" @if($sort=='dep_id::desc') checked @endif value="dep_id::desc">
                        По подразделению от А до Я <i class="glyphicon glyphicon-arrow-down"></i>
                        </p>
                        
                        <p><input type="submit" value="Выбрать" class="form-control"></p>
                    <?php //dd($books);?>   
                    </form>         
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
