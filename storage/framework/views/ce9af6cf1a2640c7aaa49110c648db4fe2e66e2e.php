<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-12 ">
            <div class="panel panel-default">
                 <div class="panel-heading">Users</div>
                    <div class="panel-body">
                        
                        <a href="<?php echo e(url('/moder/create/user')); ?>">
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
                                <?php foreach($users as $user): ?>
                                    <tr>
                                        <td>
                                            <?php if($user->active == '0'): ?>
                                                <div class="col-md-2" style="color:#ff0000">Запрещен
                                                </div>
                                            <?php else: ?><div class="col-md-2" style="color:#00C957">Разрешен
                                                </div>
                                            <?php endif; ?>
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
                                            <a href="<?php echo e(url('/moder/edit/user/'.$user->id)); ?>">
                                                <button type="submit" class="btn btn-warning">
                                                    <i class="glyphicon glyphicon-repeat"></i> Edit 
                                                </button>
                                            </a>
                                        </td>
                                        
                                        <td>
                                            <form action="<?php echo e(url('/moder/delete/user/'.$user->id)); ?>" method="GET">
                                            <?php echo csrf_field(); ?>

                                            <?php echo method_field('DELETE'); ?>

                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fa fa-trash"></i> Delete
                                                </button>
                                            </form>
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
<?php echo $__env->make('layouts.moder', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>