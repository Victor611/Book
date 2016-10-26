<?php $__env->startSection('content'); ?>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Dep</div>
                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    <?php echo $__env->make('common.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <!--Form Edit Dep-->
                    <form class="form-horizontal" role="form" method="POST" action="<?php echo e(url('/moder/update/dep/'.$dep->id)); ?>">
                        <?php echo csrf_field(); ?>

  
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Department</label>
                
                            <div class="col-sm-6">
                                <input type="text" name="name" class="form-control"  value="<?php echo e($dep->name); ?>">
                            </div>
                        </div>
                            
                        <div class="form-group" >
                            <label class="col-sm-3 control-label">Department parent</label>
                               
                            <div class="col-sm-6">
                                <select  class="form-control" name="parent_id">
                                    <option value ='0'>Никому не подчиняется</option>
                            
                                    <option value ='<?php echo e($dep->id); ?>'><?php echo e($dep->name); ?></option>
                                </select>
                            </div>
                        </div>
                
                        <!-- Edit Depart Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-plus"></i> Edit Depart
                                </button>
                            </div>
                        </div>
                        <!--End Edit Depart Button-->
                        
                    </form>
                    <!-- End Form Edit Dep-->
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.moder', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>