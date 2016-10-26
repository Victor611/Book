<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
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
                                <div class="col-sm-3">Имя :</div>
                                <div class="col-sm-9"><?php echo e($user->name); ?></div>
                            </div>
                            
                            <div class="col-sm-12">
                                <div class="col-sm-3">Email :</div>
                                <div class="col-sm-9"><?php echo e($user->email); ?></div>
                            </div>
                            
                            <div class="col-sm-12">
                                <div class="col-sm-3">Роль :</div>
                                <div class="col-sm-9"><?php echo e($user->role->name); ?></div>
                            </div>
                            
                            <div class="col-sm-12">
                                <div class="col-sm-3">Отдел :</div>
                                <div class="col-sm-9"><?php echo e($user->dep->name); ?></div>
                            </div>
                                
                        </div>
                            
                        <!--Статус чтения-->    
                        <div id="panel2" style="padding-top:100px;">
                            <h3>Статус чтения</h3>
                            <!--Хочу прочитать -->
                            <div class="col-md-12">                           
                                <h4 style="font-size: 100%; border-bottom: 2px solid maroon; font-weight: normal; padding-bottom: 5px;" >
                                    <?php if(count(App\Status::StatusToUser($user->id, "1"))>0): ?>
                                            Хочу прочитать
                                    <?php else: ?> Ничего не хочу читать
                                    <?php endif; ?>
                                </h4></br>
                                <?php foreach(App\Status::StatusToUser($user->id, "1")  as $k=>$v): ?>
                                    <a href="/book/<?php echo e($v->id); ?>" style = "text-decoration:none; color:#777;">
                                        <div class="col-sm-2" style="text-align:center; padding:15px;">
                                            <p>
                                                <img src="/uploads/book_avatar/<?php echo e($v->avatar); ?>"  style="width:100px; heidth:100px; ">
                                            <?php echo e($v->title); ?>

                                            </p>
                                           
                                        </div>
                                    </a>    
                                <?php endforeach; ?>
                                <div class="col-md-12"><?php echo App\Status::StatusToUser($user->id, "1")->links(); ?></div>
                                    
                            </div>
                            <!--Читаю-->
                            <div class="col-md-12">                           
                                <h4 style="font-size: 100%; border-bottom: 2px solid maroon; font-weight: normal; padding-bottom: 5px;" >
                                    <?php if(count(App\Status::StatusToUser($user->id, "2"))>0): ?>
                                            Читаю
                                    <?php else: ?> Ничего не читаю
                                    <?php endif; ?>
                                </h4></br>
                                <?php foreach(App\Status::StatusToUser($user->id, "2")  as $k=>$v): ?>
                                    <a href="/book/<?php echo e($v->id); ?>" style = "text-decoration:none; color:#777;" >
                                        <div class="col-sm-2" style="text-align:center; padding:15px;">
                                            <p>
                                                <img src="/uploads/book_avatar/<?php echo e($v->avatar); ?>" style="width:100px; heidth:100px;">
                                                <?php echo e($v->title); ?>

                                            </p>
                                           
                                        </div>
                                    </a>    
                                <?php endforeach; ?>
                                <div class="col-md-12"><?php echo App\Status::StatusToUser($user->id, "2")->links(); ?></div>
                            
                            </div>
                            <!--Прочел-->
                            <div class="col-md-12">                           
                                <h4 style="font-size: 100%; border-bottom: 2px solid maroon; font-weight: normal; padding-bottom: 5px;" >
                                    <?php if(count(App\Status::StatusToUser($user->id, "3"))>0): ?>
                                            Прочел
                                    <?php else: ?> Ничего не прочел
                                    <?php endif; ?>
                                </h4></br>
                                <?php foreach(App\Status::StatusToUser($user->id, "3")  as $k=>$v): ?>
                                    <a href="/book/<?php echo e($v->id); ?>" style="text-decoration:none; color:#777;">
                                        <div class="col-sm-2" style="text-align:center; padding:15px;">
                                            <p>
                                                <img src="/uploads/book_avatar/<?php echo e($v->avatar); ?>" style="width:100px; heidth:100px;">
                                                <?php echo e($v->title); ?>

                                            </p>
                                            
                                        </div>
                                    </a>
                                <?php endforeach; ?>
                                <div class="col-md-12"><?php echo App\Status::StatusToUser($user->id, "3")->links(); ?></div>
                    
                            </div>
                        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>