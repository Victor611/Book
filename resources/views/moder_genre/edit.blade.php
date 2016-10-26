@extends('layouts.moder')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Dep</div>
                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')
                    <!--Form Edit Genre-->
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/moder/update/genre/'.$genre->id) }}">
                        {!! csrf_field() !!}

  
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Genre name</label>
                
                            <div class="col-sm-6">
                                <input type="text" name="name" class="form-control"  value="{{$genre->name}}">
                            </div>
                        </div>
                
                        <!-- Edit Genre Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-plus"></i> Edit Genre
                                </button>
                            </div>
                        </div>
                        <!--End Edit Genre Button-->
                        
                    </form>
                    <!-- End Form Edit Genre-->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
