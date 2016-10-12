@extends('backend.master')
@section('title', 'User Management')
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
                                <a href="{{URL::route('admin.user.query')}}" class="btn btn-primary">Cancel</a>
                            </div>
                        </div>
                        <form class="form-horizontal" role="form" action="{{URL::route('admin.user.create.do')}}"
                              method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10 text-right">
                                    <button type="submit" class="btn btn-primary">Save</button>
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
                                    <input type="text" class="form-control" name="name" value="{{$user->username}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword1" class="col-lg-2 col-sm-2 control-label">Email
                                    address</label>
                                <div class="col-lg-10">
                                    <input type="email" class="form-control" name="account" value="{{$user->account}}">
                                    <!--<p class="help-block">Example block-level help text here.</p>-->
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword1" class="col-lg-2 col-sm-2 control-label">Password</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="pwd" name="password"
                                           value="{{$user->password}}">
                                    <!--<p class="help-block">Example block-level help text here.</p>-->
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputPassword1" class="col-lg-2 col-sm-2 control-label">Admin type</label>
                                <div class="col-lg-10">
                                    <select class="form-control m-bot15" name="admin_type" id="admin_type">
                                        <option value="3">PS</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword1" class="col-lg-2 col-sm-2 control-label">Location</label>
                                <div class="col-lg-10">
                                    <select class="form-control m-bot15" name="location">
                                        <option>HK</option>
                                    </select>
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
            var role_id = '{{$role_id}}';
            role_id = parseInt(role_id);
            var myhtml = '';
            switch (role_id) {
                case 1:
                    myhtml = '<option value="1" selected="selected">Site admin</option>'
                            + '<option value="2">PS admin</option>';
                    $('#admin_type').prepend(myhtml);
                    break;
                case 2:
                    myhtml = '<option value="2" selected="selected">PS admin</option>';
                    $('#admin_type').prepend(myhtml);
                    break;
                default:
                    break;
            }

            var admin_type = '{{$user->role_id}}';
            $('#admin_type').val(admin_type);

            if ($('#result span').text().length == 0) {
                $('#result').hide();
            }
        })

    </script>
@endsection
