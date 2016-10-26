<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Books</div>
                    <div class="panel-body">
                        <!-- Обложка -->
                        <div class="col-sm-12 col-md-4">
                            <img src="/uploads/book_avatar/<?php echo e($book->avatar); ?>" style="width:200px; heidth:200px; margin-right:50px; float:left;">
                        </div>
                        <!-- Обложка-->
                            <!-- content book-->  
                            <div class="col-sm-12 col-md-8"><h3><?php echo e($book->title); ?></h3>                            
                            
                            <div class="col-sm-3">Author :</div>
                            <div class="col-sm-9"><?php echo e($book->author); ?></div>
                            
                            <div class="col-sm-3">Pub Year :</div>
                            <div class="col-sm-9"><?php echo e($book->pubyear); ?></div>
                                                        
                            
                            <div class="col-sm-3">Genre :</div>
                            <div class="col-sm-9"><?php echo e($book->genre->name); ?></div>
                                
                            <div class="col-sm-3">Type :</div>
                            <div class="col-sm-9"><?php echo e($book->type); ?></div>
                                                        
                            <div class="col-sm-12">Description </div>
                            <div class="col-sm-12"><?php echo e($book->description); ?></div>
                        
                            <!-- form rating -->                            
                            <div class="col-sm-12" style="padding-top:20px; margin-left:15px; ">
                                <div class="col-sm-8">
                                    <?php echo $__env->make('common.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    <form action="<?php echo e(url('/rating')); ?>" method="POST" class="form-horizontal">
                                    <?php echo csrf_field(); ?>

                                        <input type="hidden" name="book_id" value="<?php echo e($book->id); ?>">
                                        <input type="hidden" name="user_id" value="<?php echo e(Auth::user()->id); ?>">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" style="padding: 5px 20px 0 0;">Rating</label>
                                            
                                            
                                            <div class="col-sm-5" style="padding: 5px;">
                                                <?php for($i=1;$i<=5;$i++): ?>
                                                    <input name="rating" type="radio" value="<?php echo e($i); ?>"
                                                        <?php if(App\Rating::hasRating($book->id, Auth::user()->id) == $i): ?> checked
                                                        <?php endif; ?> >
                                                    <?php echo e($i); ?>

                                                <?php endfor; ?>
                                            </div>
                                            
                                            <div class=" col-sm-2" style="padding: 0px;">
                                                <button type="submit" class="btn btn-default">Отправить</button>
                                            </div>        
                                        </div>
                                    </form>
                                </div>
                                
                                <!--Рекомендации-->
                                <div class="col-sm-4">
                                    <?php if( Auth::user()->hasRole('moderator')): ?>
                                        <div class="btn-group" style="display: inline; float:right;">
                                           
                                            <form method="post" action="/moder/save/rec">
                                            <?php echo csrf_field(); ?>

                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                    <span class="caret"></span>
                                                    <span class="sr-only">Меню с переключением</span>
                                                </button>
                                                    <input type="hidden" name="book_id" value="<?php echo e($book->id); ?>">
                                                    <input type="hidden" name="status" value="1">
                                                <ul class="dropdown-menu" role="menu">
                                                    
                                                        <li>
                                                            <input type="checkbox" name="deps[]" value="-1"
                                                                <?php echo e(App\Recomend::hasRecomend($book->id, -1)==-1 ? "checked":""); ?>>
                                                            Рекомендовать всем
                                                        </li>
                                                    <?php foreach($deps as $d): ?>
                                                        
                                                        <li>
                                                            <input type="checkbox" name="deps[]" value="<?php echo e($d->id); ?>"
                                                                <?php echo e(App\Recomend::hasRecomend($book->id, $d->id)==$d->id || App\Recomend::hasRecomend($book->id, $d->id)==-1? "checked":""); ?>>
                                                            <?php echo e($d->name); ?>

                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                                    
                                                <button type="submit" class="btn btn-default">
                                                    Рекомендовать
                                                </button>
                                            </form>
                                        </div>
                                    <?php endif; ?>
                                <!--Конец рекомендаций-->
                                </div>
                            </div>
                            <!-- End form rating-->
                            
                            <!-- form status-->
                            <div class="col-sm-12" style="padding-bottom:50px;">    
                                <form action="/status" method="POST" style="display: inline;">
                                    <?php echo csrf_field(); ?>

                                    <input type="hidden" name="book_id" value="<?php echo e($book->id); ?>">
                                    <input type="hidden" name="user_id" value="<?php echo e(Auth::user()->id); ?>">
                                    <button type="submit" class="<?php echo e(App\Status::hasStatus($book->id, Auth::user()->id) == 1? "btn btn-danger":"btn btn-default"); ?>">
                                        <input type="hidden" name="status" value="1">Хочу прочитать
                                    </button>
                                </form>
                                <form action="/status" method="POST" style="display: inline;">
                                    <?php echo csrf_field(); ?>    
                                    <input type="hidden" name="book_id" value="<?php echo e($book->id); ?>">
                                    <input type="hidden" name="user_id" value="<?php echo e(Auth::user()->id); ?>">
                                    <button type="submit" class="<?php echo e(App\Status::hasStatus($book->id, Auth::user()->id) == 2?"btn btn-warning":"btn btn-default"); ?>">
                                        <input type="hidden" name="status" value="2">Читаю
                                    </button>
                                </form>        
                                <form action="/status" method="POST" style="display: inline;">
                                    <?php echo csrf_field(); ?>    
                                    <input type="hidden" name="book_id" value="<?php echo e($book->id); ?>">
                                    <input type="hidden" name="user_id" value="<?php echo e(Auth::user()->id); ?>">
                                    <button type="submit" class="<?php echo e(App\Status::hasStatus($book->id, Auth::user()->id) == 3 ? "btn btn-success" :"btn btn-default"); ?>">
                                        <input type="hidden" name="status" value="3">Прочитал
                                    </button>
                                </form>
                            </div>
                            <!-- end form status-->
                        </div>
                        
                            <!-- Navi coment and users  -->
                        <div class="col-md-12" style="">
                            <!--header-->
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#panel1">Отзывы</a></li>
                                <li><a data-toggle="tab" href="#panel2">Читатели</a></li>
                                <?php if($book->type=='Электронная'): ?>
                                    <li><a data-toggle="tab" href="#panel3">Ссылки</a></li>
                                <?php endif; ?>
                            </ul>
                            <!--end header-->
                            
                            <!--content coment-->
                            <div class="tab-content">
                                <div id="panel1" class="tab-pane fade in active">
                                    <h3>Отзывы</h3>
                                                               
                                   
                                    <!-- New coment Form -->
                                    <form action="<?php echo e(url('/coment')); ?>" method="POST" cenctype="multipart/form-data" class="form-horizontal" >
                                    <?php echo csrf_field(); ?>

                                        <input type="hidden" name="book_id" value="<?php echo e($book->id); ?>">
                                        <input type="hidden" name="user_id" value="<?php echo e(Auth::user()->id); ?>">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Coment</label>
                                
                                            <div class="col-sm-7">
                                                <textarea class="form-control" rows="1" name="coment"></textarea>
                                            </div>
        
                                            <div class=" col-sm-2">
                                                <button type="submit" class="btn btn-default">
                                                    <i class="fa fa-plus"></i> Add Coment
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                    <!--end coment form-->
                                    <!--coment content-->
                                    <?php if(count($book->coment) > 0): ?>
                                        <div class="panel-body">
                                            <?php foreach($book->coment as $c): ?>
                                            <table class="table table-striped task-table">
                                            <?php if(Auth::user()->id == $c->user->id): ?>
                                                <thead>
                                                    <tr><p><?php echo e($c->user->name); ?>  <?php echo e($c->updated_at->format('d-M-Y')); ?> в <?php echo e($c->updated_at->format('H:i')); ?> написал(а)</p></tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                        <!--Edit coment form-->
                                                        <?php echo $__env->make('common.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                                            <form action="<?php echo e(url('/coment/edit/'.$c->id)); ?>" method="POST">
                                                                <?php echo csrf_field(); ?>

                                                                <input type="hidden" name="book_id" value="<?php echo e($book->id); ?>">
                                                                <input type="hidden" name="user_id" value="<?php echo e(Auth::user()->id); ?>">
                                                                
                                                                <div class="form-group">
                                                                    
                                                                    <div class="col-sm-9">
                                                                        <textarea class="form-control" rows="1" name="coment"><?php echo e($c->coment); ?></textarea>
                                                                    </div>
                                                                    
                                                                    <div class=" col-sm-2">
                                                                        <button type="submit" class="btn btn-default">
                                                                            <i class="fa fa-plus"></i> Edit Coment
                                                                        </button>
                                                                    </div>
                                                                
                                                                </div>
                                                            
                                                            </form>
                                                        <!--end edit coment form-->
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            <?php else: ?>
                                                <thead>
                                                    <tr><p><?php echo e($c->user->name); ?>  <?php echo e($c->updated_at->format('d-M-Y')); ?> в <?php echo e($c->updated_at->format('H:i')); ?> написал(а)</p></tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="table-text">
                                                            <div><?php echo e($c->coment); ?></div>
                                                        </td>
                                                    </tr>
                                                </tbody>    
                                            <?php endif; ?>
                                            </table>
                                            <?php endforeach; ?>        
                                        </div>
                                    <?php endif; ?>
                                </div>
                                    
                                <div id="panel2" class="tab-pane fade">
                                    <h3>Статус чтения</h3>
                                    <div class="col-md-12">                           
                                        <h4 style="font-size: 100%; border-bottom: 2px solid maroon; font-weight: normal; padding-bottom: 5px;" >
                                            <?php if(count(App\Status::StatusToBook($book->id, "1"))>0): ?>
                                                Хочу прочитать
                                            <?php else: ?> Никто не хочет читать
                                            <?php endif; ?>
                                        </h4></br>
                                        <?php foreach(App\Status::StatusToBook($book->id, "1")  as $k=>$v): ?>
                                            <a href="/user/<?php echo e($v->id); ?>"style = "text-decoration:none; color:#777;" >
                                                <div class="col-sm-1" style="text-align:center; margin-right:20px;">
                                                    <p>
                                                        <img src="/uploads/avatars/<?php echo e($v->avatar); ?>" style="width:100px; heidth:100px; ">
                                                        <?php echo e($v->name); ?>

                                                    </p>
                                                </div>
                                            </a>
                                        <?php endforeach; ?>
                                        <div class="col-md-12"><?php echo App\Status::StatusToBook($book->id, "1")->links(); ?></div>
                                    </div>
                                    <div class="col-md-12">                           
                                        <h4 style="font-size: 100%; border-bottom: 2px solid maroon; font-weight: normal; padding-bottom: 5px;" >
                                            <?php if(count(App\Status::StatusToBook($book->id, "2"))>0): ?>
                                                Читаю
                                            <?php else: ?> Никто не читает
                                            <?php endif; ?>
                                        </h4></br>
                                        <?php foreach(App\Status::StatusToBook($book->id, "2")  as $k=>$v): ?>
                                            <a href="/user/<?php echo e($v->id); ?>" style = "text-decoration:none; color:#777;">
                                                <div class="col-sm-1" style="text-align:center; margin-right:20px;">
                                                    <p>
                                                        <img src="/uploads/avatars/<?php echo e($v->avatar); ?>" style="width:100px; heidth:100px;">
                                                        <?php echo e($v->name); ?>

                                                    </p>
                                                </div>
                                            </a>
                                        <?php endforeach; ?>
                                        <div class="col-md-12"><?php echo App\Status::StatusToBook($book->id, "2")->links(); ?></div>
                                    </div>
                                    <div class="col-md-12">                           
                                        <h4 style="font-size: 100%; border-bottom: 2px solid maroon; font-weight: normal; padding-bottom: 5px;" >
                                            <?php if(count(App\Status::StatusToBook($book->id, "3"))>0): ?>
                                                Прочел
                                            <?php else: ?> Никто не прочел
                                            <?php endif; ?>
                                        </h4></br>
                                        <?php foreach(App\Status::StatusToBook($book->id, "3")  as $k=>$v): ?>
                                            <a href="/user/<?php echo e($v->id); ?>" style = "text-decoration:none; color:#777;">
                                                <div class="col-sm-1" style="text-align:center;margin-right:20px;;">
                                                    <p>
                                                        <img src="/uploads/avatars/<?php echo e($v->avatar); ?>" style="width:100px; heidth:100px; ">
                                                        <?php echo e($v->name); ?>

                                                    </p>
                                                </div>
                                            </a>    
                                        <?php endforeach; ?>
                                        <div class="col-md-12"><?php echo App\Status::StatusToBook($book->id, "3")->links(); ?></div>
                                    </div>
                                </div>
                                    
                                <?php if($book->type == 'Электронная'): ?>
                                <div id="panel3" class="tab-pane fade">
                                    <h3>Ссылки</h3>
                                    <div class="col-md-12">
                                        <?php foreach(App\Link::BookToLink($book->id) as $k=>$v): ?>
                                            <a href="<?php echo e($v->url); ?>">
                                                <button type="submit" class="btn btn-default" style="display : inline">
                                                    <i class="glyphicon glyphicon-download"></i> <?php echo e($v->format); ?> 
                                                </button>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div> 
                        </div>
                    </div>    
                </div>
            </div>        
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>