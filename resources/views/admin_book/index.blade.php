@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-12 ">
            <div class="panel panel-default">
                 <div class="panel-heading">Books</div>
                    <div class="panel-body">
                        
                        <table class="table table-striped task-table">

                            <!-- Table Headings -->
                            <thead>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Pub Year</th>
                                <th>&nbsp;</th>
                            </thead>
                            
                            <!-- Table Body -->
                            <tbody>
                                @foreach ($books as $book)
                                    <tr>
                                        <td class="table-text">
                                            <div>{{ $book->id }}</div>
                                        </td>
                                        <!-- Task Name -->
                                        <td class="table-text">
                                            <div>{{ $book->title }}</div>
                                        </td>
                                        
                                        <td class="table-text">
                                            <div>{{ $book->author }}</div>
                                        </td>
                                           
                                        <td class="table-text">
                                            <div>{{$book->pubyear}}</div>
                                        </td>
                                         
                                        <td>
                                            <a href="{{ url('book/'.$book->id) }}">
                                                <button type="submit" class="btn btn-info">
                                                    <i class="glyphicon glyphicon-eye-open"></i> Перейти 
                                                </button>
                                            </a>    
                                        </td> 
                                    </tr>
                                @endforeach
                                <?php echo $books->links(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection