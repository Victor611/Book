<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">Books</div>
                    <div class="panel-body">
                        
                        <a href="<?php echo e(url('/moder/create/dep')); ?>">
                            <button type="button" class="btn btn-success">
                                <i class="glyphicon glyphicon-pencil"></i> Добавить новый отдел
                            </button>
                        </a>
                        <table class="table table-striped task-table">

                            <!-- Table Headings -->
                            <thead>
                                <th>Отдел</th>
                                <th>Подчинение</th>
                                <th>&nbsp;</th>
                            </thead>
                            
                            <!-- Table Body -->
                            <tbody>
                                <?php foreach($deps as $d): ?>
                                    <tr>
                                        
                                        <td class="table-text">
                                            <div><?php echo e($d->name); ?></div>
                                        </td>
                                        <?php //print_r($d->id);?>
                                        <td class="table-text">
                                            <div><?php if(!empty($d->parent_id->name)): ?>?<?php echo e($d->parent_id->name); ?>:;<?php endif; ?></div>
                                        </td>
                                        <?php //print_r($book->id);?>    
                                        <td>
                                            <a href="<?php echo e(url('/moder/edit/dep/'.$d->id)); ?>">
                                                <button type="submit" class="btn btn-warning">
                                                    <i class="glyphicon glyphicon-repeat"></i> Edit 
                                                </button>
                                            </a>
                                        </td>
                                        
                                        <td>
                                            <form action="<?php echo e(url('/moder/delete/dep/'.$d->id)); ?>" method="GET">
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