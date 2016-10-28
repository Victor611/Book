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
                        <table class="table table-striped task-table" >

                            <!-- Table Headings -->
                            <thead>
                                <th>Id</th>
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
                                    
                                    <tr >
                                        <td class="table-text" style="vertical-align:middle">
						<div>{{ $book->id }}</div>
					</td>
					<!-- Task Name -->
                                        <td class="table-text" style="vertical-align: middle">
                                            <div>{{ $book->title }}</div>
                                        </td>
                                        
                                        <td class="table-text" style="vertical-align: middle">
                                            <div>{{ $book->author }}</div>
                                        </td>
                                        
                                        <td class="table-text" style="vertical-align: middle">
                                            <div>{{ $book->pubyear }}</div>
                                        </td>
                                            
                                        <td class="table-text" style="vertical-align: middle">
                                            <div>{{ $book->genre->name }}</div>
                                        </td>
                                            
                                        <td class="table-text" style="vertical-align: middle">
                                            <div>{{ $book->type }}</div>
                                        </td>
                                        
                                       
                                        <td class="table-text" style="text-align:center; vertical-align: middle;">
                                            <div>
                                            @if ($book->type == 'Электронная')
                                                    <?php  new App\Sklonenie(App\Link::countLink($book->id),['ссылка','ссылки','ссылок']);?>
                                            @endif
                                            </div>
                                        </td>
                                         
                                        <td style="text-align:center; vertical-align: middle;">
                                            
											@if ($book->type == 'Электронная' && App\Link::countLink($book->id)!==0)
                                                <p><a href="{{ url('/moder/link/'.$book->id) }}">
                                                    <button type="submit" class="btn btn-default" style="margin-bottom:10px;">
                                                          <i class="glyphicon glyphicon-list-alt"></i> Show Link 
                                                    </button>
                                                </a></p>
                                            @endif     
                                            
                                                <p><a href="{{ url('/moder/edit/book/'.$book->id) }}">
                                                    <button type="submit" class="btn btn-warning">
                                                        <i class="glyphicon glyphicon-repeat"></i> Edit Book
                                                    </button>
                                                </a></p>
                                         </td> 

										<td style="text-align:center; vertical-align: middle">

											@if ($book->type == 'Электронная' )						
                                                <p><a href="{{ url('/moder/create/link/'.$book->id) }}">
                                                    <button type="submit" class="btn btn-default" style="margin-bottom:10px;">
                                                        <i class="glyphicon glyphicon-cloud"></i> Add Link 
                                                    </button>
                                                </a></p>
                                            @endif                                                
                                            <p>
											<form action="{{ url('/moder/delete/book/'.$book->id) }}" method="GET" onclick="return confirm('Вы уверены что хотите удалить?')">
		                                        {!! csrf_field() !!}
		                                        {!! method_field('DELETE') !!}
		                                        <button type="submit" class="btn btn-danger" >
		                                            <i class="fa fa-trash"></i> Delete Book
		                                        </button>
		                                    </form></p>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
						<?php echo $books->links(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
