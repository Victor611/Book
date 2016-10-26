<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading">Users</div>
                    <div class="panel-body">       
                        <?php foreach($users as $user): ?>
                            <table class="table table-striped task-table">
                                <tr>
                                    <td class="table-text col-sm-3">
                                        <img src="/uploads/avatars/<?php echo e($user->avatar); ?>" style="width:100px; heidth:100px; float:left;">
                                    </td>
                                    <!-- Book Name -->
                                    <td class="table-text col-sm-9">
                                        <div class="col-sm-12">
                                            <div class="col-sm-3">Name :</div>
                                            <div class="col-sm-9"><?php echo e($user->name); ?></div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="col-sm-3">Role :</div>
                                            <div class="col-sm-9"><?php echo e($user->role->name); ?></div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="col-sm-3">Department :</div>
                                            <div class="col-sm-9"><?php echo e($user->dep->name); ?></div>
                                        </div>
                                            
                                        <div class="col-sm-12">
                                            <div class="col-sm-3">Read:</div>
                                            <div class="col-sm-9">
                                                <?php  new App\Sklonenie(App\Status::countStatus(($user->id), 3), ['книга','книги','книг']);?>
                                            </div>
                                        </div>    
                                        
                                        <div class="col-sm-12">
                                            <div class="col-sm-3">Commented:</div>
                                            <div class="col-sm-9">
                                                <!--склонение в зависимости от количества отзывов у юзера-->
                                             <?php new App\Sklonenie(App\Coment::countComent($user->id),['отзыв','отзыва','отзывов']);?>
                                            </div>
                                        </div>
                                            
                                        <!-- More Button -->                    
                                        <div style="float:right;">
                                            <a href="<?php echo e(url('user/'.$user->id)); ?>">
                                                <button type="submit" class="btn btn-info">
                                                    <i class="glyphicon glyphicon-eye-open"></i> Подробнее 
                                                </button>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>        
        <div class="col-md-4 col-lg-4 ">
            <div class="panel panel-default">   
                <div class="panel-heading">Filter</div>
                <div class="panel-body">       
                 <form action="/users" method="post">
                     <?php echo csrf_field(); ?>

                        <p><input name="sort" type="radio" value="asc" checked> по возрастанию <i class="glyphicon glyphicon-arrow-up"></i></p>
                        <p><input name="sort" type="radio" value="desc"> по убыванию <i class="glyphicon glyphicon-arrow-down"></i></p><hr>
                        <p><input name="order_by" type="radio" value="name" checked> по имени </p>
                        <p><input name="order_by" type="radio" value="role_id"> по роли </p>
                        <p><input name="order_by" type="radio" value="dep_id"> по подразделению </p><hr>
                        <p><input type="submit" value="Выбрать"></p>
                    <?php //dd($books);?>   
                    </form>         
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>