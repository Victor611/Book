@extends('layouts.moder')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="panel panel-default">
                 <div class="panel-heading">Books</div>
                    <div class="panel-body">
                        
                        <a href="{{ url('/moder/create/book') }}">
                            <button type="button" class="btn btn-success">
                                <i class="glyphicon glyphicon-pencil"></i> Add New Book
                            </button>
                        </a>
                        <table class="table table-striped task-table">

                            <!-- Table Headings -->
                            <thead>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Pub Year</th>
                                <th>Genre</th>
                                <th>Type</th>
                                <th>Count Link</th>    
                                <th>&nbsp;</th>
                            </thead>
                            
                            <!-- Table Body -->
                            <tbody>
                                @foreach ($books as $book)
                                    
                                    <tr>
                                        <!-- Task Name -->
                                        <td class="table-text">
                                            <div>{{ $book->title }}</div>
                                        </td>
                                        
                                        <td class="table-text">
                                            <div>{{ $book->author }}</div>
                                        </td>
                                        
                                        <td class="table-text">
                                            <div>{{ $book->pubyear }}</div>
                                        </td>
                                            
                                        <td class="table-text">
                                            <div>{{ $book->genre->name }}</div>
                                        </td>
                                            
                                        <td class="table-text">
                                            <div>{{ $book->type }}</div>
                                        </td>
                                        
                                       
                                        <td class="table-text">
                                            <div>
                                            @if ($book->type == 'Электронная')
                                                    <?php  new App\Sklonenie(App\Link::countLink($book->id),['ссылка','ссылки','ссылок']);?>
                                            @endif
                                            </div>
                                        </td>
                                         
                                        
                                            @if ($book->type == 'Электронная' )
                                                @if(App\Link::countLink($book->id)!==0)
                                                <td>
                                                    <a href="{{ url('/moder/link/'.$book->id) }}">
                                                        <button type="submit" class="btn btn-default">
                                                            <i class="glyphicon glyphicon-list-alt"></i> Show Link 
                                                        </button>
                                                    </a>
                                                </td>
                                                @endif
                                                 
                                                <td>
                                                    <a href="{{ url('/moder/create/link/'.$book->id) }}">
                                                        <button type="submit" class="btn btn-default">
                                                            <i class="glyphicon glyphicon-cloud"></i> Add Link 
                                                        </button>
                                                    </a>
                                                </td>
                                                
                                            @endif
                                        
                                        
                                        
                                            <td>
                                                <a href="{{ url('/moder/edit/book/'.$book->id) }}">
                                                    <button type="submit" class="btn btn-warning">
                                                        <i class="glyphicon glyphicon-repeat"></i> Edit Book
                                                    </button>
                                                </a>
                                            </td>
                                            
                                            <td>
                                                <form action="{{ url('/moder/delete/book/'.$book->id) }}" method="GET">
                                                {!! csrf_field() !!}
                                                {!! method_field('DELETE') !!}
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="fa fa-trash"></i> Delete Book
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
@endsection