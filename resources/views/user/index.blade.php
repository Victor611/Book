@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1 col-lg-10 col-md-offset-1">
            <div class="panel panel-default">
                <div>
                    <div style="float:left;"class="panel-heading">Рейтинг пользователей</div>
                    <div style="float:right; margin: 3px 5px;">

                            <input class="form-control who" type="text" placeholder="Живой поиск" value="" autocomplete="off" style="display:inline-block; width:auto; vertical-align: middle;">
                            <a class="goto_finded" style="display:none; text-decoration: none;">
                                <button type="button" class="btn btn-info" >Перейти</button>
                            </a>

                        <div class="search_result" style="width:auto;"></div>
                    </div>
                </div>

                <div class="panel-body">

                    @foreach ($users as $user)

                        <table class="table table-striped task-table">
                            <tr>
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
                                        <div class="col-sm-3">Отдел :</div>
                                        <div class="col-sm-9">{{$user->dep->name}}</div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="col-sm-3">Прочел:</div>
                                        <div class="col-sm-9">@if($user->count_status == null) 0  книг
                                                            @else <?php new App\Sklonenie($user->count_status, ['книгу','книги','книг']);?>
                                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="col-sm-3">Оставил:</div>
                                            <div class="col-sm-9">@if($user->count_coment == null) 0  отзывов
                                                            @else <?php new App\Sklonenie($user->count_coment, ['отзыв','отзыва','отзывов']);?>
                                                            @endif

                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    @endforeach
                    <?php echo $users->links(); ?>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
