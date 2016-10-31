@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1 col-lg-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Рейтинг пользователей</div>
                    <div class="panel-body">
                    <?php //var_dump($users);?>
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
                                            <a href="{{ url('user/'.$user->id) }}">
                                                <div class="col-sm-9"><h4>{{ $user->name }}</h4></div>
                                            </a>
                                        </div>
                                        
                                        <div class="col-sm-12">
                                            <div class="col-sm-3">Отдел :</div>
                                            <div class="col-sm-9">{{$user->deps}}</div>
                                        </div>
                                            
                                        <div class="col-sm-12">
                                            <div class="col-sm-3">Прочел:</div>
                                            <div class="col-sm-9"><?php  new App\Sklonenie($user->status, ['книга','книги','книг']);?></div>
                                        </div>    
                                        
                                        <div class="col-sm-12">
                                            <div class="col-sm-3">Оставил:</div>
                                                <div class="col-sm-9">
                                            </div>
                                        </div
                                    </td>
                                </tr>
                            </table>
                        @endforeach
                        <?php //echo $users->links(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
