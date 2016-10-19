@extends('layouts.moder')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-12 ">
            <div class="panel panel-default">
                 <div class="panel-heading">Users</div>
                    <div class="panel-body">
                        
                        <a href="{{ url('/moder/create/user') }}">
                            <button type="button" class="btn btn-success">
                                <i class="glyphicon glyphicon-pencil"></i> Добавить нового пользователя
                            </button>
                        </a>
                        <table class="table table-striped task-table">

                            <!-- Table Headings -->
                            <thead>
                                <th>&nbsp;</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Department</th>
                                <th>&nbsp;</th>
                            </thead>
                            
                            <!-- Table Body -->
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>
                                            @if($user->active == '0')
                                                <div class="col-md-2">Запрет на авторизацию
                                                </div>
                                            @else<div class="col-md-2">Юзер разрешен
                                                </div>
                                            @endif
                                        </td>
                                        
                                        <!-- Task Name -->
                                        <td class="table-text">
                                            <div>{{ $user->name }}</div>
                                        </td>
                                        
                                        <td class="table-text">
                                            <div>{{ $user->email }}</div>
                                        </td>
                                           
                                        <td class="table-text">
                                            <div>{{$user->role->name}}</div>
                                        </td>
                                         
                                        
                                        <td class="table-text">
                                            <div>{{$user->dep->name}}</div>
                                        </td>
                                        
                                        <td>
                                            <a href="{{ url('/moder/edit/user/'.$user->id) }}">
                                                <button type="submit" class="btn btn-warning">
                                                    <i class="glyphicon glyphicon-repeat"></i> Edit 
                                                </button>
                                            </a>
                                        </td>
                                        
                                        <td>
                                            <form action="{{ url('/moder/delete/user/'.$user->id) }}" method="GET">
                                            {!! csrf_field() !!}
                                            {!! method_field('DELETE') !!}
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fa fa-trash"></i> Delete
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