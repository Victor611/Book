@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading">Books</div>
                    <div class="panel-body">       
                        @foreach ($books as $book)
                            <table class="table table-striped task-table">
                                <tr>
                                    <td class="table-text col-sm-3">
                                        <img src="/uploads/book_avatar/{{$book->avatar}}" style="width:100px; heidth:100px; float:left;">
                                    </td>
                                    <!-- Book Name -->
                                    <td class="table-text col-sm-9">
                                        <div class="col-sm-12">
                                            
                                            <div class="col-sm-12"><h4>{{ $book->title }}</h4></div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="col-sm-3">Author :</div>
                                            <div class="col-sm-9">{{ $book->author }}</div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="col-sm-3">Pub Year :</div>
                                            <div class="col-sm-9">{{ $book->pubyear }}</div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="col-sm-3">Genre :</div>
                                            <div class="col-sm-9">{{ $book->genre->name }}</div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="col-sm-3">Type :</div>
                                            <div class="col-sm-9">
                                                {{ $book->type }}
                                                
                                                @if($book->type=='Электронная')
                                                    |&nbsp;&nbsp;&nbsp;
                                                    <?php  new App\Sklonenie(App\Link::countLink($book->id),['ссылка','ссылки','ссылок']);?>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <p>
                                            <!--склонение в зависимости от количества отзывов-->
                                             <?php new App\Sklonenie(count($book->coment),['отзыв','отзыва','отзывов']);?>
                                            <!--Средний рейтинг книги-->
                                            | Рейтинг книги: <?php  echo round(App\Rating::avgRating($book->id),0);?>
                                            <!--Склонение в зависимости от количества оценок-->
                                            | <?php  new App\Sklonenie(App\Rating::countRating($book->id),['оценка','оценки','оценок']);?>
                                            </p>
                                        </div>                    
                                        
                                        
                                       
                                        <div style="float:right;">
                                            <a href="{{ url('book/'.$book->id) }}">
                                                <button type="submit" class="btn btn-info">
                                                    <i class="glyphicon glyphicon-eye-open"></i> Подробнее 
                                                </button>
                                            </a>
                                        </div>
                                          
                                        <!--Рекомендации-->
                                        @if ( Auth::user()->hasRole('moderator'))
                                        <div class="btn-group" style="display: inline; float:right;">
                                            <form method="post" action="/moder/save/rec">
                                            {!! csrf_field() !!}
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                    <span class="caret"></span>
                                                    <span class="sr-only">Меню с переключением</span>
                                                </button>
                                                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                                                    <input type="hidden" name="status" value="1">
                                                <ul class="dropdown-menu" role="menu">
                                                    
                                                        <li>
                                                            <input type="checkbox" name="dep_id" value="-1"
                                                                {{App\Recomend::hasRecomend($book->id, -1)==-1 ? "checked":""}}>
                                                            Рекомендовать всем
                                                        </li>
                                                    @foreach ($deps as $d)
                                                        
                                                        <li>
                                                            <input type="checkbox" name="dep_id" value="{{ $d->id }}"
                                                                {{App\Recomend::hasRecomend($book->id, $d->id)==$d->id ? "checked":""}}>
                                                            {{ $d->name }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                                    
                                                <button type="submit" class="btn btn-default">
                                                    Рекомендовать
                                                </button>
                                            </form>
                                        </div>
                                        @endif
                                        <!--Конец рекомендаций-->            
                                    </td>
                                </tr>
                            </table>
                        @endforeach
                        <?php echo $books->links(); ?>
                    </div>
                </div>
            </div>        
        
        
        
        <div class="col-md-4 col-lg-4 ">
            <div class="panel panel-default">   
                <div class="panel-heading">Filter</div>
                <div class="panel-body">       
                    
                    <form action="/book" method="post">
                     {!! csrf_field() !!}
                        <p><input name="sort" type="radio" value="asc" checked> по возрастанию <i class="glyphicon glyphicon-arrow-up"></i></p>
                        <p><input name="sort" type="radio" value="desc"> по убыванию <i class="glyphicon glyphicon-arrow-down"></i></p><hr>
                        <p><input name="order_by" type="radio" value="author" checked> по автору </p>
                        <p><input name="order_by" type="radio" value="pubyear"> по году издания </p>
                        <p><input name="order_by" type="radio" value="title"> по названию </p><hr>
                        <p>Жанр</p>
                        @foreach($genres as $genre)
                            <p><input name="genre_id" type="radio" value="{{$genre->id}}"> {{$genre->name}} </p>
                        @endforeach
                        <hr>
                        <p>Рекомендовано</p>
                        @if ( Auth::user()->hasRole('moderator') || Auth::user()->hasRole('admin'))
                            @foreach ($deps as $dep)
                                <p><input name="dep_id" type="radio" value="{{$dep->id}}"> {{$dep->name}} </p>
                            @endforeach
                        @elseif(Auth::user()->hasRole('user'))
                            <p><input name="dep_id" type="radio" value="{{Auth::user()->dep_id}}">Моему отделу</p>
                        @endif
                        <p><input type="submit" value="Выбрать"></p>
                    <?php //dd($books);?>   
                    </form> 
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection