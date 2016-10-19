@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-12 ">
            <div class="panel panel-default">
                 <div class="panel-heading">Logs</div>
                    <div class="panel-body">
                        
                        <a href="{{ url('/admin/delete/logs') }}">
                            <button type="button" class="btn btn-danger">
                                <i class="glyphicon glyphicon-trash"></i> Удалить все логи
                            </button>
                        </a>
                        <table class="table table-striped task-table">

                            <!-- Table Headings -->
                            <thead>
                                <th>Name</th>
                                <th>IP</th>
                                <th>Time</th>
                                <th>Action</th>
                                <th>What</th>
                                <th>id</th>
                                
                            </thead>
                            
                            <!-- Table Body -->
                            <tbody>
                            @foreach($logs as $log)
                            <?php $user = App\User::find($log->user_id);
                                switch($log->obj_type):
                                    case(1): $obj= 'Book';break;
                                    case(2): $obj= 'User';break;
                                endswitch;
                            
                            ?>
                    
                                    <tr>
                                        <!-- Task Name -->
                                        <td class="table-text">
                                            <div>{{$user->name}}</div>
                                        </td>
                                        
                                        <td class="table-text">
                                            <div>{{$log->ip}}</div>
                                        </td>
                                                                                
                                        <td class="table-text">
                                            <div>{{$log->time}}</div>
                                        </td>
                                           
                                        <td class="table-text">
                                            <div>{{$log->action}}</div>
                                        </td>
                                         
                                        <td class="table-text">
                                            <div>{{$obj}}</div>
                                        </td>
                                        
                                        <td class="table-text">    
                                            <div>{{$log->obj_id}}</div>
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