@extends('layouts.moder')

@section('content')
<?php //echo "<pre>";var_dump($book);?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Редактировать книгу</div>
                    <div class="panel-body">
                        <!-- Display Validation Errors -->
                        @include('common.errors')
                       
                        <form action="{{ url('/moder/update/book/'.$book->id) }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                            {!! csrf_field() !!}
            
                           <div class="form-group">
                                <label class="col-sm-3 control-label">Загрузите обложку </label>
                                
                                <div class="col-sm-6">  
                                   <img src="{{url('/uploads/book_avatar/'.$book->avatar)}}" style="width:150px; heidth:150px; float:left; margin-right:25px;">
                                    <input type="file" name="avatar">
                                </div>
                            </div>
                           
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Название</label>
                
                                <div class="col-sm-6">
                                    <input type="text" name="title" class="form-control" value='{{$book->title}}'>
                                </div>
                            </div>
                
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Автор</label>
                
                                <div class="col-sm-6">
                                    <input type="text" name="author" class="form-control" value='{{$book->author}}'>
                                </div>
                            </div>
                                
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Год издания</label>
                
                                <div class="col-sm-6">
                                    <input type="text" name="pubyear" class="form-control" value='{{$book->pubyear}}'>
                                </div>
                            </div>
                             <?php //echo"<pre>"; print_r($book->genre->name);?>   
                            <div class="form-group">
                                 <label class="col-sm-3 control-label">Жанр</label>
                                <div class="col-sm-6">
                                    
                                    <select  class="form-control" name="genre_id">
                                      
                                    @foreach ($genres as $g)
                                        
                                        <option value ='{{ $g->id }}' @if($g->id == $book->genre->id) selected @endif>{{ $g->name }}</option>
                                    
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                                
                            <div class="form-group">
                                 <label class="col-sm-3 control-label">Тип</label>
                                <div class="col-sm-6">
                                    <select  class="form-control" name="type">
                                        <option value ='Бумажная' @if($book->type == 'Бумажная') selected @endif>Бумажная</option>
                                        <option value ='Электронная'@if($book->type == 'Электронная') selected @endif>Электронная</option>
                                    </select>
                                </div>
                            </div>   
                                
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Описание</label>
                                
                                <div class="col-sm-6">
                                    <textarea class="form-control" rows="3" name="description">{{$book->description}}</textarea>
                                 </div>
                            </div>
                            <!-- Add Task Button -->
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fa fa-plus"></i> Редактировать
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</div>



@endsection