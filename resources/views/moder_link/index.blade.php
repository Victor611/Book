@extends('layouts.moder')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-lg-10">
            <div class="panel panel-default">
                <!--<div class="panel-heading">Ссылки на книгу</div>-->
                    <div class="panel-body">
                        <!-- Обложка -->
                        <div class="col-md-4">
                            <img src="/uploads/book_avatar/{{$book->avatar}}" style="width:200px; heidth:200px; margin-right:50px; float:left;">
                        </div>
                       
                        
                        <!-- content book-->  
                        <div class="col-md-8"><h3>{{ $book->title }}</h3>                            
                            
                            <div class="col-sm-3">автор :</div>
                            <div class="col-sm-9">{{ $book->author }}</div>
                            
                            <div class="col-sm-3">год издания :</div>
                            <div class="col-sm-9">{{ $book->pubyear }}</div>
                                                        
                            
                            <div class="col-sm-3">жанр :</div>
                            <div class="col-sm-9">{{ $book->genre->name }}</div>
                                                        
                            <div class="col-sm-12"> Описание </div>
                            <div class="col-sm-12">{{ $book->description }}</div>
                        
                        </div>
                            
                        <div class="col-md-12">                            
                            
                            <h3>Cсылки</h3>
                            <a href="{{ url('/moder/create/link/'.$book->id) }}">
                                <button type="submit" class="btn btn-default">
                                    <i class="glyphicon glyphicon-cloud"></i> Добавить ссылку 
                                </button>
                            </a>
                                
                            <table class="table table-striped task-table">

                                <!-- Table Headings -->
                                <thead>
                                    <th>Формат</th>
                                    <th>URL</th>
                                    <th>&nbsp;</th>
                                </thead>
                                <!--End Table Headings-->
                                
                                <!-- Table Body -->
                                <tbody>
                                @foreach(App\Link::BookToLink($book->id) as $k=>$v)
                                <tr>
                               
                                    <td class="table-text">
                                        <div>{{ $v->format }}</div>
                                    </td>
                                    
                                    <td class="table-text">
                                        <div>{{ $v->url }}</div>
                                    </td>    
                                
                                    <td>
                                        <a href="{{ url('/moder/edit/link/'. $v->id) }}">
                                            <button type="submit" class="btn btn-default">
                                                <i class="glyphicon glyphicon-repeat"></i> Редактировать 
                                            </button>
                                        </a>
                                    </td>
                                
                                    <td>
                                        <form action="{{ url('/moder/delete/link/'. $v->id) }}" method="GET" onclick="return confirm('Вы уверены что хотите удалить?')">
                                        {!! csrf_field() !!}
                                        {!! method_field('DELETE') !!}
                                            <button type="submit" class="btn btn-default">
                                                <i class="fa fa-trash"></i> Удалить
                                            </button>
                                        </form>
                                    </td>
                                        
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>    
                </div>
            </div>        
        </div>
    </div>
</div>
@endsection