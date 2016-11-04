@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="col-md-2">
                <img src="/uploads/avatars/{{$user->avatar}}" style="width:150px; heidth:150px; float:left; border-radius:50%; margin: 50px 0px;">
            </div>
            <div class="col-md-10">
                <h2>{{$user->name}} профайл</h2>
                
                <p>Отдел:  {{$user->dep->name}}</p>
                <p id="max" class="bg-danger" style="color: red; border-radius: 5px; margin-top:3px; padding: inherit; width: 200px;"></p>
                <form enctype="multipart/form-data" action="/profile" method="POST" id="formupload">
                    <label>Загрузить аватар</label>
                    @include('common.errors')
                    <input type="file" name="avatar" id="fileupload">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <button type="submit" class="btn btn-primary" style="display:inline; margin: 10px 0;">
                        <i class="glyphicon glyphicon-download"></i>Сохранить изображение
                    </button>
                </form>
            </div>


        </div>
    </div>
</div>
@endsection
