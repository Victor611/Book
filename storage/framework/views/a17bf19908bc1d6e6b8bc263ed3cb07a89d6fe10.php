<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-12 ">
            <div class="panel panel-default">
                 <div class="panel-heading">Logs</div>
                    <div class="panel-body">
                        
                        <a href="<?php echo e(url('/admin/delete/logs')); ?>">
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
                            <?php foreach($logs as $log): ?>
                            <?php $user = App\User::find($log->user_id);
                                switch($log->obj_type):
                                    case(1): $obj= 'Book';break;
                                    case(2): $obj= 'User';break;
                                endswitch;
                            
                            ?>
                    
                                    <tr>
                                        <!-- Task Name -->
                                        <td class="table-text">
                                            <div><?php echo e($user->name); ?></div>
                                        </td>
                                        
                                        <td class="table-text">
                                            <div><?php echo e($log->ip); ?></div>
                                        </td>
                                                                                
                                        <td class="table-text">
                                            <div><?php echo e($log->time); ?></div>
                                        </td>
                                           
                                        <td class="table-text">
                                            <div><?php echo e($log->action); ?></div>
                                        </td>
                                         
                                        <td class="table-text">
                                            <div><?php echo e($obj); ?></div>
                                        </td>
                                        
                                        <td class="table-text">    
                                            <div><?php echo e($log->obj_id); ?></div>
                                        </td>
                                        
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>