@extends('backend.master')
@section('title', 'Notification')
@section('username', session('bk_name'))
@section('heading')
    <div class="header-section" style="z-index: 9999">
        <a class="toggle-btn"><i class="fa fa-bars"></i></a>
        <div class="page-heading">
            <h3>
                Notification
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
                        <a href="{{URL::route('admin.notification.create')}}" id="editable-sample_new"
                           class="btn btn-primary">
                            New Notification <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                <section class="panel">
                    <table class="table table-hover">
                        <tbody>
                        @foreach($notification as $item)
                            <tr>
                                <td>
                                    <a href="{{URL::route('admin.notification.edit',$item->id)}}">
                                        {{$item->type or 'News Update'}}
                                        <span>{{$item->created_at}}</span>
                                        <span class="booking_style" style="font-size: 10px;">
                                            {{$item->send_rate}}
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
