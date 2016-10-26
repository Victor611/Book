@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-12 ">
            <div class="panel panel-default">
                 <div class="panel-heading">Logs</div>
                    <div class="panel-body">
                        
                        <table class="table table-striped task-table">

                            <!-- Table Headings -->
                            <thead>
                                <th>Time</th>
                                <th>User</th>
                                <th>IP</th>
                                <th>Action</th>
                                <th>Oblect</th>
                                <th>ID</th>
                                
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
                                    
                                        <td class="table-text">
                                            <div>{{strftime("%d.%m.%Y", strtotime($log->time))." в ".strftime("%H.%M", strtotime($log->time))}}</div>
                                        </td>
                                            
                                        <!-- Task Name -->
                                        <td class="table-text">
                                            <div>{{$user->name}}</div>
                                        </td>
                                        
                                        <td class="table-text">
                                            <div>{{$log->ip}}</div>
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
                                <?php echo $logs->links(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection