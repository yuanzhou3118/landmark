@extends('backend.master')
@section('title', 'Room')
@section('css')
    <link href="{{URL::asset('assets/backend/js/fullcalendar/fullcalendar.min.css')}}" rel="stylesheet"/>
    <style>
        .fc-button-content{
            padding: 0.6rem!important;
            height: 100%!important;
            line-height: 100%!important;
        }
        html, body {
            width: 100%;
            height: 100%;
            overflow: hidden;
        }
    </style>
@endsection
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
            <a href="{{URL::route('admin.room.query')}}" class="btn btn-primary" style="position: absolute;top: 50%;transform: translate(-50%,-50%);right: -31px;">Edit Room</a>
        </div>
    </div>
@endsection
@section('content')
    <div class="wrapper">

        <!-- page start-->
        <div class="row">
            <aside class="col-xs-12">
                <section class="panel">
                    <div id="calendar" class="has-toolbar"></div>
                </section>
            </aside>
        </div>
        <!-- page end-->

    </div>
@endsection
@section('script')
    <script>
        window.daliyDoUrl = '{{URL::route('admin.calendar.daily.do')}}';
        window.appointmentEditUrl = '{{URL::route('admin.appointment.edit',1)}}';
        window.appointmentEditUrl = window.appointmentEditUrl.substring(0, window.appointmentEditUrl.length - 1);
    </script>
    <script src="{{URL::asset('assets/backend/js/fullcalendar/fullcalendar.min.js')}}"></script>
    <script src="{{URL::asset('assets/backend/js/external-dragging-calendar.js')}}"></script>
    {{--<script src="{{URL::asset('assets/backend/js/appointment-calendar.js')}}"></script>--}}
@endsection
