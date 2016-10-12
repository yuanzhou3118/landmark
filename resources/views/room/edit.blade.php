@extends('backend.master')
@section('title', 'Room')
@section('username', session('bk_name'))
<style>
    .sticky-header .main-content{
        padding: 0!important;
    }
</style>
@section('content')
    <div class="wrapper">
        <div class="row">
            <div class="col-xs-12">
                <section class="panel">
                    <div class="panel-body">
                        <div class="form-group" style="position: absolute;z-index: 1000">
                            <div class="col-lg-offset-2 col-lg-10" style="padding: 0">
                                <a href="{{URL::route('admin.room.query')}}" class="btn btn-primary">Cancel</a>
                            </div>
                        </div>
                        <form class="form-horizontal" role="form" action="{{URL::route('admin.room.edit.do',$room->id)}}"
                              method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10 text-right">
                                    <button type="submit" id="add" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                            <div class="alert alert-danger alert-dismissable" id="result">
                                <a type="button" class="close" data-dismiss="alert"
                                   aria-hidden="true">
                                    &times;
                                </a>
                                <span>{{$result or ''}}</span>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Name</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" name="name" id="name" value="{{$room->name}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword1" class="col-lg-2 col-sm-2 control-label">Description</label>
                                <div class="col-lg-10">
                                    <textarea class="form-control" name="desc" id="desc">{{$room->desc}}</textarea>
                                </div>
                            </div>
                        </form>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                            Delete
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure?
                                    </div>
                                    <form class="form-horizontal" role="form"
                                          action="{{URL::route('admin.room.delete',$room->id)}}"
                                          method="post">
                                        {{csrf_field()}}
                                        <div class="modal-footer">
                                            <a type="button" class="btn btn-default" data-dismiss="modal">Cancel</a>
                                            <button type="submit" class="btn btn-primary">Delete</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{--<div class="form-group">--}}
                        {{--<form class="form-horizontal" role="form"--}}
                        {{--action="{{URL::route('admin.room.delete',$room->id)}}" method="post">--}}
                        {{--{{csrf_field()}}--}}
                        {{--<div class="col-lg-offset-2 col-lg-10 text-center">--}}
                        {{--<button type="submit" class="btn btn-primary">--}}
                        {{--Delete--}}
                        {{--</button>--}}
                        {{--</div>--}}
                        {{--</form>--}}
                        {{--</div>--}}
                    </div>
                </section>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        $(function () {

            if ($('#result span').text().length == 0) {
                $('#result').hide();
            }
        });


    </script>
@endsection
