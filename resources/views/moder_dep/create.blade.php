@extends('layouts.moder')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add new Department</div>
                    <div class="panel-body">
                        <!-- Display Validation Errors -->
                        @include('common.errors')
                        <!--Form Add Department-->
                        <form action="{{ url('/moder/save/dep') }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                            {!! csrf_field() !!}
                            
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Department</label>
                
                                <div class="col-sm-6">
                                    <input type="text" name="name" class="form-control">
                                </div>
                            </div>
                                
                             <div class="form-group">
                                <label class="col-sm-3 control-label">Department parent</label>
                                <div class="col-sm-6">
                                    <select  class="form-control" name="parent_id">
                                    <option value ='NULL'>Никому не подчиняется</option>
                                    @foreach ($deps as $d)
                                        <option value ="{{ $d->id }}">{{ $d->name }}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                
                            <!-- Add Depart Button -->
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fa fa-plus"></i> Add Depart
                                    </button>
                                </div>
                            </div>
                            <!--End Add Depart Button-->
                        </form>
                        <!--End Form Add Department-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
