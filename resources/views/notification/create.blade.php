@extends('backend.master')
@section('title', 'Notification')
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
                                {{--<a href="{{URL::route('admin.notification.query')}}" class="btn btn-primary">Cancel</a>--}}
                                <a onclick="history.back(-1);" class="btn btn-primary">Cancel</a>
                            </div>
                        </div>
                        <form class="form-horizontal" role="form"
                              action="{{URL::route('admin.notification.create.do')}}"
                              method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10 text-right">
                                    <a id="add" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                        Send
                                    </a>
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
                                <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Title</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" name="title" id="title"
                                           value="{{$notification->title}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword1" class="col-lg-2 col-sm-2 control-label">Message</label>
                                <div class="col-lg-10">
                                    <textarea class="form-control" name="message"
                                              id="message">{{$notification->message}}</textarea>
                                </div>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog"
                                 aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Send Notification</h4>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" id="add" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#myModal">Send
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
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
