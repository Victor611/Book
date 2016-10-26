<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">Genres</div>
                    <div class="panel-body">
                        
                        <a href="<?php echo e(url('/moder/create/genre')); ?>">
                            <button type="button" class="btn btn-success">
                                <i class="glyphicon glyphicon-pencil"></i> Add New Genre
                            </button>
                        </a>
                        <table class="table table-striped task-table">

                            <!-- Table Headings -->
                            <thead>
                                <th>ID</th>
                                <th>Жанр</th>
                                <th>&nbsp;</th>
                            </thead>
                            
                            <!-- Table Body -->
                            <tbody>
                                <?php foreach($genres as $g): ?>
                                    <tr>
                                        
                                        <td class="table-text">
                                            <div><?php echo e($g->id); ?></div>
                                        </td>
                                       
                                        <td class="table-text">
                                            <div><?php echo e($g->name); ?></div>
                                        </td>
                                          
                                        <td>
                                            <a href="<?php echo e(url('/moder/edit/genre/'.$g->id)); ?>">
                                                <button type="submit" class="btn btn-warning">
                                                    <i class="glyphicon glyphicon-repeat"></i> Edit 
                                                </button>
                                            </a>
                                        </td>
                                        
                                        <td>
                                            <form action="<?php echo e(url('/moder/delete/genre/'.$g->id)); ?>" method="GET" onclick="return confirm('Вы уверены что хотите удалить?')">
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