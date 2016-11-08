@extends('layouts.app')

@section('content')
@if(Auth::user())
	<?php $has_status = (App\Status::hasStatus($book->id, Auth::user()->id)); ?>
@endif

<div class="container">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="panel panel-default">
                <!--<div class="panel-heading">Книга</div>-->
                    <div class="panel-body">
                    
                        <!-- Обложка -->
                        <div class="col-sm-12 col-md-4">
                            <img src="/uploads/book_avatar/{{$book->avatar}}" style="width:200px; heidth:200px; margin-right:50px; float:left;">
                        </div>
                        <!-- end Обложка-->
						<!-- content book-->  
						<div class="col-sm-12 col-md-8">
						
							<h3>{{ $book->title }}</h3>                            
							
							<div class="col-sm-2 alignRight">Автор :</div>
							<div class="col-sm-10">{{ $book->author }}</div>
							
							<div class="col-sm-2 alignRight">Год издания :</div>
							<div class="col-sm-10">{{ $book->pubyear }}</div>
						
							<div class="col-sm-2 alignRight">Тематика :</div>
							<div class="col-sm-10">
								<form action="/book" method="POST" class="filtr">
									{{ csrf_field() }}
									<a href="#" class="g" style="color:#337ab7; text-decoration:none"><input name="genres[]" type="hidden" value="{{$book->genre_id}}" >
										{{ $book->genre->name }}
									</a>   <!--Cобытие submit - автоматически в скрипте в главном шаблоне app.blade.php-->
								</form> 
							</div>
													 
							<div class="col-sm-12" style="margin:20px 0 20px;">{{ $book->description }}</div>
							<!--рейтинг оценки-->
							<div class ="col-sm-12">
								@if($book->avg_rating != 0)
									<div class="col-sm-2 alignRight" style="padding:6px 28px 20px 0;">Рейтинг:</div>
									<div class="col-sm-9" style="padding:0 15px 15px 6px;"><span style="font-size:20px;">
											<b><?php  echo round($book->avg_rating,2);?></b>
										</span>
										(<?php  new App\Sklonenie(App\Rating::countRating($book->id),['оценка','оценки','оценок']);?>)
									</div>
								@endif
								
							</div>
						    <!--рейтинг оценки-->
							<!--rating & status-->
						@if(Auth::user())
							 @if(($has_status)==3)
								<!-- form rating -->   
							<div class="col-sm-8">
								@include('common.errors')
								<form action="{{ url('/rating') }}" method="POST" class="form-horizontal filter" >
								{!! csrf_field() !!}
									<input type="hidden" name="book_id" value="{{$book->id}}">
									<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
									<div class="form-group">
										<label class="col-sm-3" style="margin-top:10px;">Моя оценка</label>
										<div class="col-sm-6" style="padding: 5px;">
											@for($i=1;$i<=5;$i++)
											<input  name="rating" type="radio" class="filter-input" value="{{$i}}"
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
							<!-- form status-->
							<div class="col-sm-4" style="padding-bottom:25px;">
								<form action="/status" method="POST" style="display: inline;">
									{!! csrf_field() !!}    
									<input type="hidden" name="book_id" value="{{$book->id}}">
									<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
									<button type="submit" class="btn btn-default" style="background-color:#b3b4bc;">
										<input type="hidden" name="status" value="3">Не прочел
									</button>
								</form>
							</div>
							@else
							<div class="col-sm-12" style="padding-bottom:25px;">
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
							</div>
							@endif
							<!-- end form status-->
						@endif
						<!-- end rating & status-->
						
						<!--Link & Recomend-->
							<!--Ссылки-->
							<div class="col-sm-8">
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
						@if(Auth::user())
							<div class="col-sm-4">    
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
							</div>
						@endif
							<!--Конец рекомендаций-->
						<!--end Link & Recomend-->
						</div>
						<!-- End content book-->
						<!-- Navi coment and users  -->
						<div class="col-sm-12" style="padding-top:25px;">
                            <!--header-->
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#panel1">Отзывы</a></li>
                                <li><a data-toggle="tab" href="#panel2">Читатели</a></li>
                            </ul>
                            <!--end header-->
                            
                            <!--content coment-->
                            <div class="tab-content">
                                <div id="panel1" class="tab-pane fade in active">  
                                    <div class="panel-body">
										<!--coment content-->
										@if (count($book->coment) > 0)
                                            @foreach ($book->coment as $c)
											@if(Auth::user())
												@if (Auth::user()->id == $c->user->id || Auth::user()->hasRole('moderator'))	
													<div class="col-sm-12">
													<hr>
														<div class="col-md-1">
															<a href="{{ url('/user/'.$c->user->id) }}">
																<img src="/uploads/avatars/{{$c->user->avatar}}" style="width:50px; height:50px;  top:10px; left:10px; border-radius:50%">
															</a>
														</div>
														<div class="col-md-11">
															<div class="col-sm-12">
																<a href="{{ url('/user/'.$c->user->id) }}" style="text-decoration:none; color: black;">
																	<b style="font-size:16px;">
																		{{$c->user->name}}
																	</b>
																</a>
																<span style="color:grey; font-size:12px;padding-left:15px;">
																	{{$c->updated_at->format('d-m-Y')}} в {{$c->updated_at->format('H:i')}}
																</span>
															</div>
															<div class="col-sm-12">
																<!--Edit coment form-->
																@include('common.errors')
																<form action="{{ url('/coment/edit/'.$c->id) }}" method="POST">
																	{!! csrf_field() !!}
																	<input type="hidden" name="book_id" value="{{$book->id}}">
																	<input type="hidden" name="user_id" value="{{$c->user->id}}">
																	
																	<div class="form-group">
																		
																		<div class="col-sm-9" style="padding-left:0px;">
																			<textarea class="form-control" style="max-width: 744px;" rows="2" name="coment">{{$c->coment}}</textarea>
																		</div>
																		
																		<div class=" col-sm-2">
																			<button type="submit" class="btn btn-default">
																				<i class="fa fa-edit"></i> Редактировать
																			</button>
																		</div>			
																	</div>
																</form>
															</div>
														</div>
													</div>
												
												@else
													<div class="col-sm-12">
													 <hr>
														<div class="col-md-1">
															<a href="{{ url('/user/'.$c->user->id) }}">
																<img src="/uploads/avatars/{{$c->user->avatar}}" style="width:50px; height:50px;  top:10px; left:10px; border-radius:50%">
															</a>
														</div>
														<div class="col-md-11">
															<div class="col-sm-12">
																<a href="{{ url('/user/'.$c->user->id) }}" style="text-decoration:none; color: black;">
																	<b style="font-size:16px;">
																		{{$c->user->name}}
																	</b>
																</a>
																<span style="color:grey; font-size:12px;padding-left:15px;">
																	{{$c->updated_at->format('d-m-Y')}} в {{$c->updated_at->format('H:i')}}
																</span>
															</div>
															<div class="col-sm-12" style="font-size:16px;">{{ $c->coment }}</div>	
														</div>
													</div>
												@endif
											@else
												<div class="col-sm-12">
													 <hr>
														<div class="col-md-1">
															<a href="{{ url('/user/'.$c->user->id) }}">
																<img src="/uploads/avatars/{{$c->user->avatar}}" style="width:50px; height:50px;  top:10px; left:10px; border-radius:50%">
															</a>
														</div>
														<div class="col-md-11">
															<div class="col-sm-12">
																<a href="{{ url('/user/'.$c->user->id) }}" style="text-decoration:none; color: black;">
																	<b style="font-size:16px;">
																		{{$c->user->name}}
																	</b>
																</a>
																<span style="color:grey; font-size:12px;padding-left:15px;">
																	{{$c->updated_at->format('d-m-Y')}} в {{$c->updated_at->format('H:i')}}
																</span>
															</div>
															<div class="col-sm-12" style="font-size:16px;">{{ $c->coment }}</div>	
														</div>
													</div>
											@endif	
											@endforeach
										@endif     
										<!--End coment content-->
										<!-- New coment Form -->
										@if(Auth::user())
										<div class="col-sm-12" style="margin-top:20px;"><hr>	
										<form action="{{ url('/coment') }}" method="POST" cenctype="multipart/form-data" class="form-horizontal">
										{!! csrf_field() !!}
											<input type="hidden" name="book_id" value="{{$book->id}}">
											<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
											
											<div class="form-group">
												<label class="col-sm-2 control-label">Комментарий</label>
									
												<div class="col-sm-10 ">
													<textarea class="form-control" style="max-width: 300px;" rows="3" name="coment"></textarea>
												</div>
			
												<div class=" col-sm-2 col-sm-offset-2 " style="margin-top:20px;">
													<button type="submit" class="btn btn-default">
														<i class="fa fa-plus"></i> Добавить
													</button>
												</div>
											</div>
										</form>
										</div>
										@endif
										<!--end coment form-->
									</div>
                                </div> 
                                <div id="panel2" class="tab-pane fade">
                                    <h3>Статус чтения</h3>
                                    
                                    <div class="col-md-12">                           
                                        @if(count(App\Status::StatusToBook($book->id, "2"))>0)
											<h4 style="font-size: 100%; border-bottom: 2px solid maroon; font-weight: normal; padding-bottom: 5px;" >
                                                Читаю
											</h4></br>
										@endif
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
                                        @if(count(App\Status::StatusToBook($book->id, "3"))>0)
											<h4 style="font-size: 100%; border-bottom: 2px solid maroon; font-weight: normal; padding-bottom: 5px;" >    
                                                Прочел
											</h4></br>
										@endif
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
