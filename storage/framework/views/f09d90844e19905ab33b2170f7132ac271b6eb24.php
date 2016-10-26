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
                                        <a href="<?php echo e(url('book/'.$book->id)); ?>">
                                            <img src="/uploads/book_avatar/<?php echo e($book->avatar); ?>" style="width:100px; heidth:100px; float:left;">
                                        </a>
                                    </td>
                                    
                                    <!-- Book Name -->
                                    <td class="table-text col-sm-9">
                                        <div class="col-sm-12">
                                            
                                            <div class="col-sm-12"><h4><?php echo e($book->title); ?></h4></div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="col-sm-3">Автор :</div>
                                            <div class="col-sm-9"><?php echo e($book->author); ?></div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="col-sm-3">Год издания :</div>
                                            <div class="col-sm-9"><?php echo e($book->pubyear); ?></div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="col-sm-3">Жанр :</div>
                                            <div class="col-sm-9"><?php echo e($book->genre->name); ?></div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="col-sm-3">Тип :</div>
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
                                    </td>
                                </tr>
                            </table>
                        <?php endforeach; ?>
                        <?php echo $books->links(); ?>
                    </div>
                </div>
            </div>        
        
        
        <!--Фильтр-->
        <div class="col-md-4 col-lg-4 ">
            <div class="panel panel-default">   
                <div class="panel-heading">Filter</div>
                <div class="panel-body">       
                    
                    <?php $sort = Request::has('sort') ? Request::get('sort') :false;?>
                    <form action="/book" method="post">
                     <?php echo e(csrf_field()); ?>

                        <p>Сортировка</p>
                        <select name="sort" class="form-control" >
                            <option value="">Без сортировки</option>
                            <option <?php if($sort=='author::asc'): ?> selected <?php endif; ?> value="author::asc">
                                Автор от А до Я
                            </option>
                            
                            <option <?php if($sort=='author::desc'): ?> selected <?php endif; ?> value="author::desc">
                                Автор от Я до А
                            </option>
                            
                            <option <?php if($sort=='pubyear::asc'): ?> selected <?php endif; ?> value="pubyear::asc">
                                Год издания по возрастанию
                            </option>
                            
                            <option <?php if($sort=='pubyear::desc'): ?> selected <?php endif; ?> value="pubyear::desc">
                                Год издания по убыванию
                            </option>
                            
                            <option <?php if($sort=='title::asc'): ?> selected <?php endif; ?> value="title::asc">
                                Название от А до Я
                            </option>
                            
                            <option <?php if($sort=='title::desc'): ?> selected <?php endif; ?> value="title::desc">
                                Название от Я до А
                            </option>
                        </select>

                        <hr>
                        <p>Жанр</p>
                        <?php foreach($genres as $genre): ?>
                            <p><input name="genres[]" type="checkbox" value="<?php echo e($genre->id); ?>"
                                    <?php if( isset($genres_r) && in_array($genre->id, $genres_r) ): ?>
                                            checked
                                    <?php endif; ?>
                                >
                            <?php echo e($genre->name); ?> </p>
                        <?php endforeach; ?>
                        <hr>
                        <p>Рекомендовано</p>
                        <?php if( Auth::user()->hasRole('moderator') || Auth::user()->hasRole('admin')): ?>
                            <?php foreach($deps as $dep): ?>
                                <p><input name="deps[]" type="checkbox" value="<?php echo e($dep->id); ?>"
                                    <?php if( isset($deps_r) && in_array($dep->id, $deps_r) ): ?>
                                        checked
                                    <?php endif; ?>
                                >
                                <?php echo e($dep->name); ?> </p>
                            <?php endforeach; ?>
                        <?php elseif(Auth::user()->hasRole('user')): ?>
                            <p><input name="deps[]" type="checkbox" value="<?php echo e(Auth::user()->dep_id); ?>"
                                <?php if( isset($deps_r) && in_array(Auth::user()->dep_id, $deps_r) ): ?>
                                        checked
                                <?php endif; ?>
                            >
                            Моему отделу</p>
                        <?php endif; ?>
                        <p><input type="submit" value="Выбрать" class="form-control"></p>
                    <?php //dd($books);?>   
                    </form> 
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>