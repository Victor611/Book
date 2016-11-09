@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-lg-8">
            <div class="panel panel-default">
               <!-- <div class="panel-heading">Книги</div>-->
                    <div class="panel-body">
                   
                       
                            <table class="table task-table">
                                @foreach ($books as $book)
								<tr>
                                    
                                    <td class="table-text col-sm-3" >
                                        <a href="{{ url('book/'.$book->id) }}">
                                            <img src="/uploads/book_avatar/{{$book->avatar}}" style="max-width:150px; float:left;">
                                        </a>
                                    </td>
                                    
                                    <!-- Book Name -->
                                    <td class="table-text col-sm-9" style="position: relative;">
                                        <div class="col-sm-12">
                                            <a href="{{ url('book/'.$book->id) }}">
                                                <div class="col-sm-12"><h4>{{ $book->title }}</h4></div>
                                            </a> 
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="col-sm-3 alignRight">Автор :</div>
                                            <div class="col-sm-9">{{ $book->author }}</div>
                                        </div>
                                       
                                        <div class="col-sm-12">
                                            <div class="col-sm-3 alignRight">Тематика :</div>
                                            <div class="col-sm-9">{{ $book->genre->name }}</div>
                                        </div>
                                       
                                        <div class="col-sm-12">
											<div class="col-md-3 alignRight" style="margin-top:10px;">Рейтинг:</div> 
											<!--Средний рейтинг книги-->											
											<div class="col-md-9" style="margin-top:10px;">
												<?php $rating = round($book->avg_rating,0);?>
												@for($i = 1; $i <= $rating; $i++)
												 <img src="/uploads/img/star1.png"> @endfor
												@for($i = 1; $i <= (5 - $rating); $i++)
												<img src="/uploads/img/star2.png"> @endfor
											</div>
                                        </div>                    
                                    </td>
                                </tr>
								@endforeach
                            </table>
                        <?php echo $books->links(); ?>
                    </div>
                </div>
            </div>        
        
        
        <!--Фильтр-->
        <div class="col-md-4 col-lg-4 ">
            <div class="panel panel-default">   
                <!--<div class="panel-heading">Фильтр</div>-->
                <div class="panel-body">       
                    
                    <?php $sort = Request::has('sort') ? Request::get('sort') :false;?>
                    <form action="/book" method="POST" class="filter">
                     {{ csrf_field() }}
                        <p>Сортировка</p>
                        <select name="sort" class="form-control filter-input" >
                            <option value="">По рейтингу</option>
                                                        
                            <option @if($sort=='title::asc') selected @endif value="title::asc">
                                Название от А до Я
                            </option>
                            
                            <option @if($sort=='title::desc') selected @endif value="title::desc">
                                Название от Я до А
                            </option>
                            
                            <option @if($sort=='created_at::desc') selected @endif value="created_at::desc">
                                По дате добавления
                            </option>
                            
                        </select>

                        <hr>
                        <p>Тематика</p>
                        @foreach($genres as $genre)
                            <p><input name="genres[]" type="checkbox" value="{{$genre->id}}" class="filter-input"
                                    @if( isset($genres_r) && in_array($genre->id, $genres_r) )
                                            checked
                                    @endif
                                >
                            {{$genre->name}} (<?php echo App\Book::countGenre($genre->id);?>)</p>
                        @endforeach
			
					@if(Auth::user())
						<hr>
						<p>Рекомендовано</p>
						@if ( Auth::user()->hasRole('moderator') || Auth::user()->hasRole('admin')) 
							@foreach ($deps as $dep)
							<p><input name="deps[]" type="checkbox" value="{{$dep->id}}" class="filter-input"
							@if( isset($deps_r) && in_array($dep->id, $deps_r) )
								checked
							@endif
							>
							{{$dep->name}}
							</p>
							@endforeach
						@elseif(Auth::user()->hasRole('user'))
							<p><input name="deps[]" type="checkbox" value="{{Auth::user()->dep_id}}" class="filter-input"
							@if( isset($deps_r) && in_array(Auth::user()->dep_id, $deps_r) )
							checked
							@endif
							>
							Моему отделу
							</p>
						@endif
					@endif
								<!--<p><input type="submit" value="Выбрать" class="form-control"></p>-->
								<!--Cобытие submit - автоматически в скрипте в главном шаблоне app.blade.php-->
							 
                    </form> 
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
