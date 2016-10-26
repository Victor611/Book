@extends('layouts.moder')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add Link</div>
                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')
                    <!--Form Edit Dep-->
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/moder/save/link') }}">
                        {!! csrf_field() !!}

                        <input type="hidden" name="book_id" value="{{$book->id}}">                        
                        
                        <div class="form-group" >
                            <label class="col-sm-3 control-label">Format</label>
                               
                            <div class="col-sm-6">
                                <select  class="form-control" name="format">
                                    <option value ='doc'>doc</option>
                                    <option value ='docx'>docx</option>
                                    <option value ='txt'>txt</option>
                                    <option value ='fb2'>fb2</option>
                                    <option value ='mobi'>mobi</option>
                                    <option value ='epub'>epub</option>
                                    <option value ='pdf'>pdf</option>
                                    <option value ='ppt'>ppt</option>
                                    <option value ='djvu'>DjVu</option>
                                    <option value ='rtf'>rtf</option>
                                </select>
                            </div>
                        </div>
                            
                        <div class="form-group">
                            <label class="col-sm-3 control-label">URL</label>
                
                            <div class="col-sm-6">
                                <textarea class="form-control" rows="1" name="url"></textarea>
                            </div>
                        </div>
                
                        <!-- Edit Depart Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-plus"></i> Save Link
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
