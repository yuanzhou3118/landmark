@extends('backend.master')
@section('title', 'User Management')
@section('username', session('bk_name'))
@section('heading')
    <div class="header-section" style="z-index: 9999">
        <a class="toggle-btn"><i class="fa fa-bars"></i></a>
        <div class="page-heading">
            <h3>
                User Management
            </h3>
        </div>
    </div>
@endsection
@section('content')
    <div class="wrapper">
        <div class="row">
            <div class="col-xs-12">
                <div class="clearfix text-center">
                    <div class="btn-group">
                        <a href="{{URL::route('admin.user.create')}}" id="editable-sample_new" class="btn btn-primary">
                            Add User <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                <section class="panel">
                    <table class="table table-hover">
                        <tbody>
                        @foreach($user as $item)
                                <tr>
                                    <td>
                                        <a href="{{URL::route('admin.user.edit',$item->id)}}">
                                            {{$item->account}}<br><span>{{$item->desc}}</span>
                                        </a>
                                    </td>
                                </tr>
                        @endforeach
                        </tbody>
                    </table>
                </section>
            </div>
        </div>
    </div>
@endsection
