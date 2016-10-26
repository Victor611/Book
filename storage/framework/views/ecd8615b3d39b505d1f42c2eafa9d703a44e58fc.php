<?php $__env->startSection('content'); ?>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Dep</div>
                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    <?php echo $__env->make('common.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <!--Form Edit Genre-->
                    <form class="form-horizontal" role="form" method="POST" action="<?php echo e(url('/moder/update/genre/'.$genre->id)); ?>">
                        <?php echo csrf_field(); ?>


  
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Genre name</label>
                
                            <div class="col-sm-6">
                                <input type="text" name="name" class="form-control"  value="<?php echo e($genre->name); ?>">
                            </div>
                        </div>
                
                        <!-- Edit Genre Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-plus"></i> Edit Genre
                                </button>
                            </div>
                        </div>
                        <!--End Edit Genre Button-->
                        
                    </form>
                    <!-- End Form Edit Genre-->
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.moder', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>