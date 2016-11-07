@extends('layouts.moder')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">Жанры</div>
                    <div class="panel-body">
                        
                        <a href="{{ url('/moder/create/genre') }}">
                            <button type="button" class="btn btn-success">
                                <i class="glyphicon glyphicon-pencil"></i> Добавить новый жанр
                            </button>
                        </a>
                        <table class="table task-table">

                            <!-- Table Headings -->
                            <thead>
                                <th>ID</th>
                                <th>Жанр</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                            </thead>
                            
                            <!-- Table Body -->
                            <tbody>

                                @foreach ($genres as $g)
                                    <tr>
                                        
                                        <td class="table-text">
                                            <div>{{ $g->priority }}</div>
                                        </td>
                                       

                                        <td class="table-text">
                                            <div>{{ $g->name }}</div>
                                        </td>
                                        <td class="table-text">
                                            @if($g->priority !== 1)
                                                <a href="{{ url('/moder/genre/'.$g->priority.'/1') }}">
                                                    <i class="glyphicon glyphicon-arrow-up"></i>
                                                </a>
                                            @else
                                                &nbsp&nbsp&nbsp
                                            @endif

                                            @if(count($genres) !== $g->priority)
                                                <a href="{{ url('/moder/genre/'.$g->priority) }}">
                                                    <i class="glyphicon glyphicon-arrow-down"></i>
                                                </a>
                                            @endif
                                        </td>


                                        <td>
                                            <a href="{{ url('/moder/edit/genre/'.$g->id) }}">
                                                <button type="submit" class="btn btn-warning">
                                                    <i class="glyphicon glyphicon-repeat"></i> Редактировать 
                                                </button>
                                            </a>
                                        </td>
                                        
                                        <td>
                                            <form action="{{ url('/moder/delete/genre/'.$g->id) }}" method="GET" onclick="return confirm('Вы уверены что хотите удалить?')">
                                            {!! csrf_field() !!}
                                            {!! method_field('DELETE') !!}
                                                <button type="submit" class="btn btn-danger">
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
@endsection
