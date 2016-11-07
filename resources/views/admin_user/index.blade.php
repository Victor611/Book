@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-12 ">
            <div class="panel panel-default">
                 <div class="panel-heading">Пользователи</div>
                    <div class="panel-body">
                        
                        <table class="table task-table">

                            <!-- Table Headings -->
                            <thead>
                                <th>ID</th>
                                <th>Имя</th>
                                <th>Email</th>
                                <th>Роль</th>
                                <th>Отдел</th>
                                <th>Разрешение</th>
                                <th>&nbsp;</th>
                            </thead>
                            
                            <!-- Table Body -->
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="table-text">
                                            <div>{{ $user->id }}</div>
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
                                            <form action="/admin/active" method="POST" style="display: inline;">
                                                {!! csrf_field() !!}
                                                <input type="hidden" name="user_id" value="{{$user->id}}">
                                                <button type="submit" class="{{App\Active::hasActive($user->id) == 0? "btn btn-success":"btn btn-default"}}">
                                                    <input type="hidden" name="active" value="0">Запретить
                                                </button>
                                            </form>
                                            <form action="/admin/active" method="POST" style="display: inline;">
                                                {!! csrf_field() !!}    
                                                <input type="hidden" name="user_id" value="{{$user->id}}">
                                                <button type="submit" class="{{App\Active::hasActive($user->id) == 1?"btn btn-success":"btn btn-default"}}">
                                                    <input type="hidden" name="active" value="1">Разрешить
                                                </button>
                                            </form>        
                                        </td>
                                        
                                        <td>
                                            <form action="{{ url('/admin/delete/user/'.$user->id) }}" method="GET" onclick="return confirm('Вы уверены что хотите удалить?')">
                                            {!! csrf_field() !!}
                                            {!! method_field('DELETE') !!}
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fa fa-trash"></i> Удалить
                                                </button>
                                            </form>
                                        </td>
                                        
                                    </tr>
                                @endforeach
                                <?php echo $users->links(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection