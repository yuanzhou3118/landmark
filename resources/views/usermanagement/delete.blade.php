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
                        <div class="form-group" style="position: absolute">
                            <div class="col-lg-offset-2 col-lg-10" style="padding: 0">
                                <a href="{{URL::route('admin.user.query')}}" class="btn btn-primary">Back</a>
                            </div>
                        </div>

                    </div>
                    <div class="panel-body">
                        <div class="alert alert-success">{{$result}}</div>
                    </div>
                </section>

            </div>
        </div>
    </div>

@endsection

