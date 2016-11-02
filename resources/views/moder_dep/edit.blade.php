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
                    <!--Form Edit Dep-->
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/moder/update/dep/'.$dep->id) }}">
                        {!! csrf_field() !!}
  
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Department</label>
                
                            <div class="col-sm-6">
                                <input type="text" name="name" class="form-control"  value="{{$dep->name}}">
                            </div>
                        </div>
                            
                        <div class="form-group" >
                            <label class="col-sm-3 control-label">Department parent</label>
                               
                            <div class="col-sm-6">
                                <select  class="form-control" name="parent_id">
                                    <option value ='0' @if( $dep->parent_id == 0) selected @endif>Никому не подчиняется</option>

                                    @foreach($deps as $d)
										@if($dep->id != $d->id)
											<option value="{{$d->id}}" @if( $dep->parent_id == $d->id) selected @endif >{{$d->name}}</option>
										@endif
									@endforeach
				</select>
                            </div>
                        </div>
                
                        <!-- Edit Depart Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-plus"></i> Edit Depart
                                </button>
                            </div>
                        </div>
                        <!--End Edit Depart Button-->
                        
                    </form>
                    <!-- End Form Edit Dep-->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
