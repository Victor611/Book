@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Books</div>
                    <div class="panel-body">
                    
                        <!-- Обложка -->
                        <div class="col-sm-12 col-md-4">
                            <img src="/uploads/book_avatar/{{$book->avatar}}" style="width:200px; heidth:200px; margin-right:50px; float:left;">
                        </div>
                        <!-- end Обложка-->
						<!-- content book-->  
						<div class="col-sm-12 col-md-8">
						
							<h3>{{ $book->title }}</h3>                            
							
							<div class="col-sm-3">Автор :</div>
							<div class="col-sm-9">{{ $book->author }}</div>
							
							<div class="col-sm-3">Год издания :</div>
							<div class="col-sm-9">{{ $book->pubyear }}</div>
						
							<div class="col-sm-3">Жанр :</div>
							<div class="col-sm-9">
								<form action="/book" method="POST" class="filtr">
									{{ csrf_field() }}
									<p class="g" style="color:#337ab7;"><input name="genres[]" type="hidden" value="{{$book->genre_id}}" >
										{{ $book->genre->name }}
									</p>   <!--Cобытие submit - автоматически в скрипте в главном шаблоне app.blade.php-->
								</form> 
							</div>
													 
							<div class="col-sm-12" style="margin-top:20px;">{{ $book->description }}</div>
							<!--отзывы рейтинг оценки-->
							<div class="col-sm-12" style="padding-top:30px;">
								<p>
									<!--Средний рейтинг книги-->
									Рейтинг: <?php  echo round($book->avg_rating,0);?>
									<!--Склонение в зависимости от количества оценок-->
									| <?php  new App\Sklonenie(App\Rating::countRating($book->id),['оценка','оценки','оценок']);?>
									<!--склонение в зависимости от количества отзывов-->
									| <?php new App\Sklonenie($book->count_coment,['отзыв','отзыва','отзывов']);?>
							   </p>
							</div>
						    <!--отзывы рейтинг оценки-->
							
							<!--rating & status-->
							<div class="col-sm-12" style="padding-top:20px;">
								@if(Auth::user())
									<?php $has_status = (App\Status::hasStatus($book->id, Auth::user()->id)); ?>
									@if(($has_status)==3)
									<!-- form rating -->   
									<div class="col-sm-8">
										@include('common.errors')
										<form action="{{ url('/rating') }}" method="POST" class="form-horizontal filter" >
										{!! csrf_field() !!}
											<input type="hidden" name="book_id" value="{{$book->id}}">
											<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
											<div class="form-group">
												<label class="col-sm-2 control-label">Рейтинг</label>
												
												<div class="col-sm-5" style="padding: 5px;">
													@for($i=1;$i<=5;$i++)
														<input  name="rating"
																type="radio"
																class="filter-input"
																value="{{$i}}"
																@if (App\Rating::hasRating($book->id, Auth::user()->id) == $i) checked
																@endif
																>
														{{$i}}
													@endfor
												</div>        
											</div>
										</form>
									</div>
									<!-- end form rating --> 
									@endif
								@endif
							   
								@if(Auth::user())
								<div class="col-md-4" style="padding-bottom:25px;">    
									<!-- form status-->
									<form action="/status" method="POST" style="display: inline;">
										{!! csrf_field() !!}    
										<input type="hidden" name="book_id" value="{{$book->id}}">
										<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
										<button type="submit" class="{{App\Status::hasStatus($book->id, Auth::user()->id) == 2 ? "btn btn-warning" : "btn btn-default"}}">
											<input type="hidden" name="status" value="2">Читаю
										</button>
									</form>        
									<form action="/status" method="POST" style="display: inline;">
										{!! csrf_field() !!}    
										<input type="hidden" name="book_id" value="{{$book->id}}">
										<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
										<button type="submit" class="{{App\Status::hasStatus($book->id, Auth::user()->id) == 3 ? "btn btn-success" : "btn btn-default"}}">
											<input type="hidden" name="status" value="3">Прочитал
										</button>
									</form>
									<!-- end form status-->
								</div>
								@endif
							</div>
							<!-- end rating & status-->
							
							<!--Link & Recomend-->
							<div class="col-md-12">
								<!--Ссылки-->
								<div class="col-md-8">
									@foreach(App\Link::BookToLink($book->id) as $k=>$v)
										<a href="{{ $v->url }}" target= "_blank">
											<button type="submit" class="btn btn-default" style="display : inline">
												<i class="glyphicon glyphicon-download"></i> {{$v->format}} 
											</button>
										</a>
									@endforeach
								</div>
								<!--конец ссылки-->
								<!--Рекомендации-->
								<div class="col-md-4">    
									@if(Auth::user())
										@if(Auth::user()->hasRole('moderator'))
										<div class="btn-group" style="display: inline; ">
										   
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
														<input type="checkbox" name="deps[]" value="-1"
															{{App\Recomend::hasRecomend($book->id, -1)==-1 ? "checked":""}}>
														Рекомендовать всем
													</li>
													
													@foreach ($deps as $d)  
													<li>
														<input type="checkbox" name="deps[]" value="{{ $d->id }}"
															{{App\Recomend::hasRecomend($book->id, $d->id)==$d->id || App\Recomend::hasRecomend($book->id, $d->id)==-1? "checked":""}}>
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
									@endif
								</div>
								<!--Конец рекомендаций-->
							</div>
							<!--End Link & Recomend-->
						</div>
						<!-- Navi coment and users  -->
                        <div class="col-md-12" style="padding-top:25px;">
                            <!--header-->
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#panel1">Отзывы</a></li>
                                <li><a data-toggle="tab" href="#panel2">Читатели</a></li>
                            </ul>
                            <!--end header-->
                            
                            <!--content coment-->
                            <div class="tab-content">
                                <div id="panel1" class="tab-pane fade in active">
                                  
                                    <!--coment content-->
                                    @if (count($book->coment) > 0)
                                        <div class="panel-body">
                                          
                                            @foreach ($book->coment as $c)
                                              
												<table class="table table-striped task-table">
													@if(Auth::user())
														@if (Auth::user()->id == $c->user->id || Auth::user()->hasRole('moderator'))
															<thead>
																<tr><p>{{$c->user->name}}  {{$c->updated_at->format('d-M-Y')}} в {{$c->updated_at->format('H:i')}} написал(а)</p></tr>
															</thead>
															<tbody>
																<tr>
																	<td>
																	<!--Edit coment form-->
																	@include('common.errors')
																		<form action="{{ url('/coment/edit/'.$c->id) }}" method="POST">
																			{!! csrf_field() !!}
																			<input type="hidden" name="book_id" value="{{$book->id}}">
																			<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
																			
																			<div class="form-group">
																				
																				<div class="col-sm-9">
																					<textarea class="form-control" style="max-width: 744px;" rows="3" name="coment">{{$c->coment}}</textarea>
																				</div>
																				
																				<div class=" col-sm-2">
																					<button type="submit" class="btn btn-default">
																						<i class="fa fa-edit"></i> Редактировать
																					</button>
																				</div>
																			
																			</div>
																		
																		</form>
																	<!--end edit coment form-->
																	</td>
																</tr>
															</tbody>
														@else
														<thead>
															<tr><p>{{$c->user->name}}  {{$c->updated_at->format('d-M-Y')}} в {{$c->updated_at->format('H:i')}} написал(а)</p></tr>
														</thead>
														<tbody>
															<tr>
																<td class="table-text">
																	<div>{{ $c->coment }}</div>
																</td>
															</tr>
														</tbody>
														@endif
													@else
														<thead>
															<tr><p>{{$c->user->name}}  {{$c->updated_at->format('d-M-Y')}} в {{$c->updated_at->format('H:i')}} написал(а)</p></tr>
														</thead>
														<tbody>
															<tr>
																<td class="table-text">
																	<div>{{ $c->coment }}</div>
																</td>
															</tr>
														</tbody>    
													@endif
												</table>
                                            @endforeach        
                                        </div>
                                    @endif
									
									<!-- New coment Form -->
									@if(Auth::user())
									<form action="{{ url('/coment') }}" method="POST" cenctype="multipart/form-data" class="form-horizontal" style="margin-top:30px;" >
									{!! csrf_field() !!}
										<input type="hidden" name="book_id" value="{{$book->id}}">
										<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
										
										<div class="form-group">
											<label class="col-sm-2 control-label">Коментарий</label>
								
											<div class="col-sm-7">
												<textarea class="form-control" style="max-width: 616px;" rows="3" name="coment"></textarea>
											</div>
		
											<div class=" col-sm-2">
												<button type="submit" class="btn btn-default">
													<i class="fa fa-plus"></i> Создать
												</button>
											</div>
										</div>
									</form>
									@endif
								<!--end coment form-->
								
								</div>
                                 
                                <div id="panel2" class="tab-pane fade">
                                    <h3>Статус чтения</h3>
                                    
                                    <div class="col-md-12">                           
                                        <h4 style="font-size: 100%; border-bottom: 2px solid maroon; font-weight: normal; padding-bottom: 5px;" >
                                            @if(count(App\Status::StatusToBook($book->id, "2"))>0)
                                                Читаю
                                            @else Никто не читает
                                            @endif
                                        </h4></br>
                                        @foreach(App\Status::StatusToBook($book->id, "2")  as $k=>$v)
                                            <a href="/user/{{$v->id}}" style = "text-decoration:none; color:#777;">
                                                <div class="col-sm-1" style="text-align:center; margin-right:20px;">
                                                    <p>
                                                        <img src="/uploads/avatars/{{$v->avatar}}" style="width:100px; heidth:100px;">
                                                        {{$v->name}}
                                                    </p>
                                                </div>
                                            </a>
                                        @endforeach
                                        <div class="col-md-12"><?php echo App\Status::StatusToBook($book->id, "2")->links(); ?></div>
                                    </div>
                                    <div class="col-md-12">                           
                                        <h4 style="font-size: 100%; border-bottom: 2px solid maroon; font-weight: normal; padding-bottom: 5px;" >
                                            @if(count(App\Status::StatusToBook($book->id, "3"))>0)
                                                Прочел
                                            @else Никто не прочел
                                            @endif
                                        </h4></br>
                                        @foreach(App\Status::StatusToBook($book->id, "3")  as $k=>$v)
                                            <a href="/user/{{$v->id}}" style = "text-decoration:none; color:#777;">
                                                <div class="col-sm-1" style="text-align:center;margin-right:20px;;">
                                                    <p>
                                                        <img src="/uploads/avatars/{{$v->avatar}}" style="width:100px; heidth:100px; ">
                                                        {{$v->name}}
                                                    </p>
                                                </div>
                                            </a>    
                                        @endforeach
                                        <div class="col-md-12"><?php echo App\Status::StatusToBook($book->id, "3")->links(); ?></div>
                                    </div>
                                </div>        
                            </div> 
                        </div>
                    </div>    
                </div>
            </div>        
        </div>
    </div>
</div>
@endsection
