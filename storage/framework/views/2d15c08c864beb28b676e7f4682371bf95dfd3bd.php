<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add new book</div>
                    <div class="panel-body">
                        <!-- Display Validation Errors -->
                        <?php echo $__env->make('common.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                       
                        <form action="<?php echo e(url('/moder/save/book')); ?>" method="POST" enctype="multipart/form-data" class="form-horizontal">
                            <?php echo csrf_field(); ?>

                            
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Upload Book Image</label>
                                
                                <div class="col-sm-6">  
                                   <!-- <img src="/uploads/book_avatar/default.jpg" style="width:150px; heidth:150px; float:left; margin-right:25px;">-->
                                    <input type="file" name="avatar">
                                </div>
                            </div>
                                
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Title</label>
                
                                <div class="col-sm-6">
                                    <input type="text" name="title" class="form-control">
                                </div>
                            </div>
                
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Author</label>
                
                                <div class="col-sm-6">
                                    <input type="text" name="author" class="form-control">
                                </div>
                            </div>
                                
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Pub Year</label>
                
                                <div class="col-sm-6">
                                    <input type="number" name="pubyear" class="form-control">
                                </div>
                            </div>
                             <?php //echo"<pre>"; print_r($genre);?>   
                            <div class="form-group">
                                 <label class="col-sm-3 control-label">Genre</label>
                                <div class="col-sm-6">
                                    <select  class="form-control" name="genre_id">
                                    <?php foreach($genres as $g): ?>
                                        <option value ='<?php echo e($g->id); ?>'><?php echo e($g->name); ?></option>
                                    <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                                
                             <div class="form-group">
                                 <label class="col-sm-3 control-label">Type</label>
                                <div class="col-sm-6">
                                    <select  class="form-control" name="type">
                                        <option value ='Бумажная'>Бумажная</option>
                                        <option value ='Электронная'>Электронная</option>
                                    </select>
                                </div>
                            </div>    
                                
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Description</label>
                                
                                <div class="col-sm-6">
                                    <textarea class="form-control" rows="3" name="description"></textarea>
                                 </div>
                            </div>
                                
                            <!-- Add Task Button -->
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fa fa-plus"></i> Add Book
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.moder', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>