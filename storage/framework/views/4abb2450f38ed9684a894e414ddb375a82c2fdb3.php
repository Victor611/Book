<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="panel panel-default">
                 <div class="panel-heading">Books</div>
                    <div class="panel-body">
                        
                        <a href="<?php echo e(url('/moder/create/book')); ?>">
                            <button type="button" class="btn btn-success">
                                <i class="glyphicon glyphicon-pencil"></i> Add New Book
                            </button>
                        </a>
                        <table class="table table-striped task-table">

                            <!-- Table Headings -->
                            <thead>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Pub Year</th>
                                <th>Genre</th>
                                <th>Type</th>
                                <th>Count Link</th>    
                                <th>&nbsp;</th>
                            </thead>
                            
                            <!-- Table Body -->
                            <tbody>
                                <?php foreach($books as $book): ?>
                                    
                                    <tr>
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
                                            
                                        <td class="table-text">
                                            <div><?php echo e($book->genre->name); ?></div>
                                        </td>
                                            
                                        <td class="table-text">
                                            <div><?php echo e($book->type); ?></div>
                                        </td>
                                        
                                       
                                        <td class="table-text">
                                            <div>
                                            <?php if($book->type == 'Электронная'): ?>
                                                    <?php  new App\Sklonenie(App\Link::countLink($book->id),['ссылка','ссылки','ссылок']);?>
                                            <?php endif; ?>
                                            </div>
                                        </td>
                                         
                                        
                                            <?php if($book->type == 'Электронная' ): ?>
                                                <?php if(App\Link::countLink($book->id)!==0): ?>
                                                <td>
                                                    <a href="<?php echo e(url('/moder/link/'.$book->id)); ?>">
                                                        <button type="submit" class="btn btn-default">
                                                            <i class="glyphicon glyphicon-list-alt"></i> Show Link 
                                                        </button>
                                                    </a>
                                                </td>
                                                <?php endif; ?>
                                                 
                                                <td>
                                                    <a href="<?php echo e(url('/moder/create/link/'.$book->id)); ?>">
                                                        <button type="submit" class="btn btn-default">
                                                            <i class="glyphicon glyphicon-cloud"></i> Add Link 
                                                        </button>
                                                    </a>
                                                </td>
                                                
                                            <?php endif; ?>
                                        
                                        
                                        
                                            <td>
                                                <a href="<?php echo e(url('/moder/edit/book/'.$book->id)); ?>">
                                                    <button type="submit" class="btn btn-warning">
                                                        <i class="glyphicon glyphicon-repeat"></i> Edit Book
                                                    </button>
                                                </a>
                                            </td>
                                            
                                            <td>
                                                <form action="<?php echo e(url('/moder/delete/book/'.$book->id)); ?>" method="GET">
                                                <?php echo csrf_field(); ?>

                                                <?php echo method_field('DELETE'); ?>

                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="fa fa-trash"></i> Delete Book
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