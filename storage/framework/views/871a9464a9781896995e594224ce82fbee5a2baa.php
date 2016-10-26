<?php $__env->startSection('content'); ?>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit user</div>
                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    <?php echo $__env->make('common.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <!--Form Edit User-->
                    <form class="form-horizontal" role="form" method="POST" action="<?php echo e(url('/moder/update/user/'.$user->id)); ?>">
                        <?php echo csrf_field(); ?>


                        <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="<?php echo e($user->name); ?>">
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="<?php echo e($user->email); ?>">
                            </div>
                        </div>

                        <!--Select Roles User-->   
                        <div class="form-group">
                            <label for="role" class="col-md-4 control-label">Role</label>

                            <div class="col-md-6">
                                <select  class="form-control" name="role_id">
                                    
                                    <?php foreach($roles as $r): ?>
                                        <option value ='<?php echo e($r->id); ?>' <?php if($r->id == $user->role->id): ?> selected <?php endif; ?>><?php echo e($r->name); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <!--End Select Roles User-->
                        
                        <!--Select Department-->   
                        <div class="form-group">
                            <label for="role" class="col-md-4 control-label">Department</label>

                            <div class="col-md-6">
                                <select  class="form-control" name="dep_id">
                                    <?php foreach($deps as $d): ?>
                                        <option value ='<?php echo e($d->id); ?>' <?php if($d->id == $user->dep->id): ?> selected <?php endif; ?>><?php echo e($d->name); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <!--End Select Department-->
                            
                        <!--Button Edit User-->
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> Edit
                                </button>
                            </div>
                        </div>
                        <!--End Button Edit User-->
                    </form>
                    <!-- End Form Edit User-->
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.moder', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>