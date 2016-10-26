<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading">Books</div>
                    <div class="panel-body">       
                        <?php foreach($books as $book): ?>
                            <table class="table table-striped task-table">
                                <tr>
                                    <td class="table-text col-sm-3">
                                        <img src="/uploads/book_avatar/<?php echo e($book->avatar); ?>" style="width:100px; heidth:100px; float:left;">
                                    </td>
                                    <!-- Book Name -->
                                    <td class="table-text col-sm-9">
                                        <div class="col-sm-12">
                                            
                                            <div class="col-sm-12"><h4><?php echo e($book->title); ?></h4></div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="col-sm-3">Author :</div>
                                            <div class="col-sm-9"><?php echo e($book->author); ?></div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="col-sm-3">Pub Year :</div>
                                            <div class="col-sm-9"><?php echo e($book->pubyear); ?></div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="col-sm-3">Genre :</div>
                                            <div class="col-sm-9"><?php echo e($book->genre->name); ?></div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="col-sm-3">Type :</div>
                                            <div class="col-sm-9">
                                                <?php echo e($book->type); ?>

                                                
                                                <?php if($book->type=='Электронная'): ?>
                                                    |&nbsp;&nbsp;&nbsp;
                                                    <?php  new App\Sklonenie(App\Link::countLink($book->id),['ссылка','ссылки','ссылок']);?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <p>
                                            <!--склонение в зависимости от количества отзывов-->
                                             <?php new App\Sklonenie(count($book->coment),['отзыв','отзыва','отзывов']);?>
                                            <!--Средний рейтинг книги-->
                                            | Рейтинг книги: <?php  echo round(App\Rating::avgRating($book->id),0);?>
                                            <!--Склонение в зависимости от количества оценок-->
                                            | <?php  new App\Sklonenie(App\Rating::countRating($book->id),['оценка','оценки','оценок']);?>
                                            </p>
                                        </div>                    
                                        
                                        
                                       
                                        <div style="float:right;">
                                            <a href="<?php echo e(url('book/'.$book->id)); ?>">
                                                <button type="submit" class="btn btn-info">
                                                    <i class="glyphicon glyphicon-eye-open"></i> Подробнее 
                                                </button>
                                            </a>
                                        </div>
                                          
                                        <!--Рекомендации-->
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
                                                            <input type="checkbox" name="dep_id" value="-1"
                                                                <?php echo e(App\Recomend::hasRecomend($book->id, -1)==-1 ? "checked":""); ?>>
                                                            Рекомендовать всем
                                                        </li>
                                                    <?php foreach($deps as $d): ?>
                                                        
                                                        <li>
                                                            <input type="checkbox" name="dep_id" value="<?php echo e($d->id); ?>"
                                                                <?php echo e(App\Recomend::hasRecomend($book->id, $d->id)==$d->id ? "checked":""); ?>>
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
                    
                    <form action="/book" method="post">
                     <?php echo csrf_field(); ?>

                        <p><input name="sort" type="radio" value="asc" checked> по возрастанию <i class="glyphicon glyphicon-arrow-up"></i></p>
                        <p><input name="sort" type="radio" value="desc"> по убыванию <i class="glyphicon glyphicon-arrow-down"></i></p><hr>
                        <p><input name="order_by" type="radio" value="author" checked> по автору </p>
                        <p><input name="order_by" type="radio" value="pubyear"> по году издания </p>
                        <p><input name="order_by" type="radio" value="title"> по названию </p><hr>
                        <p>Жанр</p>
                        <?php foreach($genres as $genre): ?>
                            <p><input name="genre_id" type="radio" value="<?php echo e($genre->id); ?>"> <?php echo e($genre->name); ?> </p>
                        <?php endforeach; ?>
                        <hr>
                        <p>Рекомендовано</p>
                        <?php if( Auth::user()->hasRole('moderator') || Auth::user()->hasRole('admin')): ?>
                            <?php foreach($deps as $dep): ?>
                                <p><input name="dep_id" type="radio" value="<?php echo e($dep->id); ?>"> <?php echo e($dep->name); ?> </p>
                            <?php endforeach; ?>
                        <?php elseif(Auth::user()->hasRole('user')): ?>
                            <p><input name="dep_id" type="radio" value="<?php echo e(Auth::user()->dep_id); ?>">Моему отделу</p>
                        <?php endif; ?>
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