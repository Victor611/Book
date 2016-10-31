@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <?php //print_r($user);?>
            <img src="/uploads/avatars/{{$user->avatar}}" style="width:150px; heidth:150px; float:left; border-radius:50%; margin-right:25px;">
            <h2>{{$user->name}} профайл</h2>
            <p>{{$user->role->name}}</p>
            <form enctype="multipart/form-data" action="/profile" method="POST">
                <label>Upload Profile Image</label>
                @include('common.errors')
	 	<input type="file" name="avatar">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <button type="submit" class="btn btn-primary" style="display:inline; margin: 10px 0;">
                    <i class="glyphicon glyphicon-download"></i>Сохранить изображение  
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
