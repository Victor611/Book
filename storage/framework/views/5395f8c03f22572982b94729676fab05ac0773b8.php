<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading">Books</div>
                    <div class="panel-body">
                        
                        <!---->
                        <div class="col-md-2">
                            <img src="/uploads/avatars/<?php echo e($user->avatar); ?>" style="width:100px; heidth:100px; margin-right:50px; float:left;">
                        </div>
                        
                        <!---->    
                        <div class="col-md-10">
                            
                            <div class="col-sm-12">
                                <div class="col-sm-3">Name :</div>
                                <div class="col-sm-9"><?php echo e($user->name); ?></div>
                            </div>
                            
                            <div class="col-sm-12">
                                <div class="col-sm-3">Email :</div>
                                <div class="col-sm-9"><?php echo e($user->email); ?></div>
                            </div>
                            
                            <div class="col-sm-12">
                                <div class="col-sm-3">Role :</div>
                                <div class="col-sm-9"><?php echo e($user->role->name); ?></div>
                            </div>
                            
                            <div class="col-sm-12">
                                <div class="col-sm-3">Department :</div>
                                <div class="col-sm-9"><?php echo e($user->dep->name); ?></div>
                            </div>
                                
                        </div>
                            
                        <!---->    
                        <div id="panel2" >
                            <h3>Статус чтения</h3>
                            <!---->
                            <div class="col-md-12">                           
                                <h4 style="font-size: 200%; border-bottom: 2px solid maroon; font-weight: normal; padding-bottom: 5px;" >
                                    Хочу прочитать
                                </h4></br>
                                <?php foreach(App\Status::StatusToUser($user->id, "1")  as $k=>$v): ?>
                                    <a href="/book/<?php echo e($v->id); ?>">
                                        <div class="col-sm-5"><img src="/uploads/book_avatar/<?php echo e($v->avatar); ?>" style="width:100px; heidth:100px; float:left;">
                                            <p>title: <?php echo e($v->title); ?></p>
                                            <p>author: <?php echo e($v->author); ?></p>
                                        </div>
                                    </a>    
                                <?php endforeach; ?>
                            </div>
                            <!---->
                            <div class="col-md-12">                           
                                <h4 style="font-size: 200%; border-bottom: 2px solid maroon; font-weight: normal; padding-bottom: 5px;" >
                                    Читаю
                                </h4></br>
                                <?php foreach(App\Status::StatusToUser($user->id, "2")  as $k=>$v): ?>
                                    <a href="/book/<?php echo e($v->id); ?>">
                                        <div class="col-sm-5"><img src="/uploads/book_avatar/<?php echo e($v->avatar); ?>" style="width:100px; heidth:100px; float:left;">
                                            <p>title: <?php echo e($v->title); ?></p>
                                            <p>author: <?php echo e($v->author); ?></p>
                                        </div>
                                    </a>    
                                <?php endforeach; ?>
                            </div>
                            <!---->
                            <div class="col-md-12">                           
                                <h4 style="font-size: 200%; border-bottom: 2px solid maroon; font-weight: normal; padding-bottom: 5px;" >
                                    Прочел
                                </h4></br>
                                <?php foreach(App\Status::StatusToUser($user->id, "3")  as $k=>$v): ?>
                                    <a href="/book/<?php echo e($v->id); ?>">
                                        <div class="col-sm-5"><img src="/uploads/book_avatar/<?php echo e($v->avatar); ?>" style="width:100px; heidth:100px; float:left;">
                                            <p>title: <?php echo e($v->title); ?></p>
                                            <p>author: <?php echo e($v->author); ?></p>
                                        </div>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                            <?php //print_r(Auth::user()->id);  print_r($book->id);?>
                            
                         
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>