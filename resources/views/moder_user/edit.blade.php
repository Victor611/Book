@extends('layouts.moder')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Редактировать пользователя</div>
                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')
                    <!--Form Edit User-->
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/moder/update/user/'.$user->id) }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Имя</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}">
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}">
                            </div>
                        </div>

                        <!--Select Roles User-->   
                        <div class="form-group">
                            <label for="role" class="col-md-4 control-label">Роль</label>

                            <div class="col-md-6">
                                <select  class="form-control" name="role_id">
                                    
                                    @foreach ($roles as $r)
                                        <option value ='{{ $r->id }}' @if($r->id == $user->role->id) selected @endif>{{ $r->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!--End Select Roles User-->
                        
                        <!--Select Department-->   
                        <div class="form-group">
                            <label for="role" class="col-md-4 control-label">Отдел</label>

                            <div class="col-md-6">
                                <select  class="form-control" name="dep_id">
                                    @foreach ($deps as $d)
                                        <option value ='{{ $d->id }}' @if($d->id == $user->dep->id) selected @endif>{{ $d->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!--End Select Department-->
                            
                        <!--Button Edit User-->
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> Редактировать
                                </button>
                            </div>
                        </div>
                        <!--End Button Edit User-->
                    </form>
                    <!-- End Form Edit User-->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
