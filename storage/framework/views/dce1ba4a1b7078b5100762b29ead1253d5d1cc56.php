<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-12 ">
            <div class="panel panel-default">
                 <div class="panel-heading">Users</div>
                    <div class="panel-body">
                        
                        <table class="table table-striped task-table">

                            <!-- Table Headings -->
                            <thead>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Department</th>
                                <th>Active</th>
                                <th>&nbsp;</th>
                            </thead>
                            
                            <!-- Table Body -->
                            <tbody>
                                <?php foreach($users as $user): ?>
                                    <tr>
                                        <td class="table-text">
                                            <div><?php echo e($user->id); ?></div>
                                        </td>
                                        <!-- Task Name -->
                                        <td class="table-text">
                                            <div><?php echo e($user->name); ?></div>
                                        </td>
                                        
                                        <td class="table-text">
                                            <div><?php echo e($user->email); ?></div>
                                        </td>
                                           
                                        <td class="table-text">
                                            <div><?php echo e($user->role->name); ?></div>
                                        </td>
                                         
                                        
                                        <td class="table-text">
                                            <div><?php echo e($user->dep->name); ?></div>
                                        </td>
                                        <td>
                                            <form action="/admin/active" method="POST" style="display: inline;">
                                                <?php echo csrf_field(); ?>

                                                <input type="hidden" name="user_id" value="<?php echo e($user->id); ?>">
                                                <button type="submit" class="<?php echo e(App\Active::hasActive($user->id) == 0? "btn btn-success":"btn btn-default"); ?>">
                                                    <input type="hidden" name="active" value="0">Запретить
                                                </button>
                                            </form>
                                            <form action="/admin/active" method="POST" style="display: inline;">
                                                <?php echo csrf_field(); ?>    
                                                <input type="hidden" name="user_id" value="<?php echo e($user->id); ?>">
                                                <button type="submit" class="<?php echo e(App\Active::hasActive($user->id) == 1?"btn btn-success":"btn btn-default"); ?>">
                                                    <input type="hidden" name="active" value="1">Разрешить
                                                </button>
                                            </form>        
                                        </td>
                                        
                                        <td>
                                            <form action="<?php echo e(url('/admin/delete/user/'.$user->id)); ?>" method="GET" onclick="return confirm('Вы уверены что хотите удалить?')">
                                            <?php echo csrf_field(); ?>

                                            <?php echo method_field('DELETE'); ?>

                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fa fa-trash"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                        
                                    </tr>
                                <?php endforeach; ?>
                                <?php echo $users->links(); ?>
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