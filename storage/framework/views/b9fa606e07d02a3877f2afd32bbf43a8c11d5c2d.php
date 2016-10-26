<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-12 ">
            <div class="panel panel-default">
                 <div class="panel-heading">Books</div>
                    <div class="panel-body">
                        
                        <table class="table table-striped task-table">

                            <!-- Table Headings -->
                            <thead>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Pub Year</th>
                                <th>&nbsp;</th>
                            </thead>
                            
                            <!-- Table Body -->
                            <tbody>
                                <?php foreach($books as $book): ?>
                                    <tr>
                                        <td class="table-text">
                                            <div><?php echo e($book->id); ?></div>
                                        </td>
                                        <!-- Task Name -->
                                        <td class="table-text">
                                            <div><?php echo e($book->title); ?></div>
                                        </td>
                                        
                                        <td class="table-text">
                                            <div><?php echo e($book->author); ?></div>
                                        </td>
                                           
                                        <td class="table-text">
                                            <div><?php echo e($book->pubyear); ?></div>
                                        </td>
                                         
                                        <td>
                                            <a href="<?php echo e(url('book/'.$book->id)); ?>">
                                                <button type="submit" class="btn btn-info">
                                                    <i class="glyphicon glyphicon-eye-open"></i> Перейти 
                                                </button>
                                            </a>    
                                        </td> 
                                    </tr>
                                <?php endforeach; ?>
                                <?php echo $books->links(); ?>
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