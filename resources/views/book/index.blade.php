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
                                        <a href="{{ url('book/'.$book->id) }}">
                                            <img src="/uploads/book_avatar/{{$book->avatar}}" style="max-width:150px; float:left;">
                                        </a>
                                    </td>
                                    
                                    <!-- Book Name -->
                                    <td class="table-text col-sm-9" style="position: relative;">
                                        <div class="col-sm-12">
                                            
                                            <div class="col-sm-12"><h4>{{ $book->title }}</h4></div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="col-sm-3">Автор :</div>
                                            <div class="col-sm-9">{{ $book->author }}</div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="col-sm-3">Год издания :</div>
                                            <div class="col-sm-9">{{ $book->pubyear }}</div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="col-sm-3">Жанр :</div>
                                            <div class="col-sm-9">{{ $book->genre->name }}</div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="col-sm-3">Тип :</div>
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
                                        
                                        <div style="position: absolute; right:5px; bottom:5px;">
                                            <a href="{{ url('book/'.$book->id) }}">
                                                <button type="submit" class="btn btn-info">
                                                    <i class="glyphicon glyphicon-eye-open"></i> Подробнее 
                                                </button>
                                            </a>
                                        </div>        
                                    </td>
                                </tr>
                            </table>
                        @endforeach
                        <?php echo $books->links(); ?>
                    </div>
                </div>
            </div>        
        
        
        <!--Фильтр-->
        <div class="col-md-4 col-lg-4 ">
            <div class="panel panel-default">   
                <div class="panel-heading">Filter</div>
                <div class="panel-body">       
                    
                    <?php $sort = Request::has('sort') ? Request::get('sort') :false;?>
                    <form action="/book" method="post">
                     {{ csrf_field() }}
                        <p>Сортировка</p>
                        <select name="sort" class="form-control" >
                            <option value="">Без сортировки</option>
                            <option @if($sort=='author::asc') selected @endif value="author::asc">
                                Автор от А до Я
                            </option>
                            
                            <option @if($sort=='author::desc') selected @endif value="author::desc">
                                Автор от Я до А
                            </option>
                            
                            <option @if($sort=='pubyear::asc') selected @endif value="pubyear::asc">
                                Год издания по возрастанию
                            </option>
                            
                            <option @if($sort=='pubyear::desc') selected @endif value="pubyear::desc">
                                Год издания по убыванию
                            </option>
                            
                            <option @if($sort=='title::asc') selected @endif value="title::asc">
                                Название от А до Я
                            </option>
                            
                            <option @if($sort=='title::desc') selected @endif value="title::desc">
                                Название от Я до А
                            </option>
                        </select>

                        <hr>
                        <p>Жанр</p>
                        @foreach($genres as $genre)
                            <p><input name="genres[]" type="checkbox" value="{{$genre->id}}"
                                    @if( isset($genres_r) && in_array($genre->id, $genres_r) )
                                            checked
                                    @endif
                                >
                            {{$genre->name}} </p>
                        @endforeach
                        <hr>
                        <p>Рекомендовано</p>
                        @if ( Auth::user()->hasRole('moderator') || Auth::user()->hasRole('admin'))
                            @foreach ($deps as $dep)
                                <p><input name="deps[]" type="checkbox" value="{{$dep->id}}"
                                    @if( isset($deps_r) && in_array($dep->id, $deps_r) )
                                        checked
                                    @endif
                                >
                                {{$dep->name}} </p>
                            @endforeach
                        @elseif(Auth::user()->hasRole('user'))
                            <p><input name="deps[]" type="checkbox" value="{{Auth::user()->dep_id}}"
                                @if( isset($deps_r) && in_array(Auth::user()->dep_id, $deps_r) )
                                        checked
                                @endif
                            >
                            Моему отделу</p>
                        @endif
                        <p><input type="submit" value="Выбрать" class="form-control"></p>
                    <?php //dd($books);?>   
                    </form> 
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
