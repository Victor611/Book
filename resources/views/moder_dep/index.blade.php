@extends('layouts.moder')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-12 ">
            <div class="panel panel-default">
                <!--<div class="panel-heading">Отделы</div>-->
                    <div class="panel-body">
                        
                        <a href="{{ url('/moder/create/dep') }}">
                            <button type="button" class="btn btn-success btn-margin-top">
                                <i class="glyphicon glyphicon-pencil"></i> Добавить
                            </button>
                        </a>
                        <table class="table task-table">

                            <!-- Table Headings -->
                            <thead>
                                <th>Отдел</th>
                                <th>Подчиняется</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                            </thead>
                            
                            <!-- Table Body -->
                            <tbody>
                                @foreach ($deps as $d)
                                    <tr>
                                        
                                        <td class="table-text">
                                            <div>{{ $d->name }} ({{count($d->user)}})</div>
                                        </td>
                                        <?php //print_r($d->children);?>
                                        <td class="table-text">
                                            <div>@if(!empty($d->children->name)) {{ $d->children->name }} @else Никому не подчиняется @endif</div>
                                        </td>
                                        <?php //print_r($book->id);?>    
                                        <td>
                                            <a href="{{ url('/moder/edit/dep/'.$d->id) }}">
                                                <button type="submit" class="btn btn-warning">
                                                    <i class="glyphicon glyphicon-repeat"></i> Редактировать 
                                                </button>
                                            </a>
                                        </td>
                                        
                                        <td>
                                            <button did="{{ $d->id }}" uc="{{count($d->user)}}" class="btn btn-danger del_dep">
                                                <i class="fa fa-trash"></i> Удалить
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                <?php echo $deps->links(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection