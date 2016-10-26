<?php $__env->startSection('content'); ?>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Link</div>
                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    <?php echo $__env->make('common.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <!--Form Edit Dep-->
                    <form class="form-horizontal" role="form" method="POST" action="<?php echo e(url('/moder/update/link/'.$link->id)); ?>">
                        <?php echo csrf_field(); ?>


                        <input type="hidden" name="book_id" value="<?php echo e($link->book_id); ?>">                        
                        
                        <div class="form-group" >
                            <label class="col-sm-3 control-label">Format</label>
                               
                            <div class="col-sm-6">
                                <select  class="form-control" name="format">
                                    <option value ="<?php echo e($link->format); ?>"><?php echo e($link->format); ?></option>
                                    <option value ='doc'>doc</option>
                                    <option value ='txt'>txt</option>
                                    <option value ='fb2'>fb2</option>
                                    <option value ='mobi'>mobi</option>
                                    <option value ='epub'>epub</option>
                                    <option value ='pdf'>pdf</option>
                                </select>
                            </div>
                        </div>
                            
                        <div class="form-group">
                            <label class="col-sm-3 control-label">URL</label>
                
                            <div class="col-sm-6">
                                <textarea class="form-control" rows="1" name="url"><?php echo e($link->url); ?></textarea>
                            </div>
                        </div>
                
                        <!-- Edit Depart Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-plus"></i> Edit Link
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