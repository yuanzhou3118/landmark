@extends('backend.master')
@section('title', 'Room')
@section('username', session('bk_name'))
@section('heading')
    <div class="header-section" style="z-index: 9999">
        <a class="toggle-btn"><i class="fa fa-bars"></i></a>
        <div class="page-heading">
            <h3>
                Room
            </h3>
        </div>
        <div>
            <a href="{{URL::route('admin.calendar.daily')}}" class="btn btn-primary" style="position: absolute;top: 50%;transform: translate(-50%,-50%);right: -12px;">Back</a>
        </div>
    </div>
@endsection
@section('content')
    <div class="wrapper">
        <div class="row">
            <div class="col-xs-12">
                <div class="clearfix text-center">
                    <div class="btn-group">
                        <a href="{{URL::route('admin.room.create')}}" id="editable-sample_new"
                           class="btn btn-primary">
                            Add New Room <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                <section class="panel">
                    <table class="table table-hover">
                        <tbody>
                        @foreach($room as $item)
                            <tr>
                                <td>
                                    <a href="{{URL::route('admin.room.edit',$item->id)}}">
                                        {{$item->name}}<br>
                                        <span class="booking_style" style="font-size: 10px;">
                                            {{$item->desc}}
                                        </span>
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
