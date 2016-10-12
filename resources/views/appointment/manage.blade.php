@extends('backend.master')
@section('title', 'Appointment')
@section('username', session('bk_name'))
@section('heading')
    <div class="header-section" style="z-index: 9999">
        <a class="toggle-btn"><i class="fa fa-bars"></i></a>
        <div class="page-heading">
            <h3>
                Appointment
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
                        <a href="{{URL::route('admin.appointment.create')}}" id="editable-sample_new"
                           class="btn btn-primary">
                            Make an appointment <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                <section class="panel">
                    <table class="table table-hover">
                        <tbody>
                        @foreach($appointment as $item)
                            <tr>
                                <td>
                                    <a href="{{URL::route('admin.appointment.edit',$item->id)}}">
                                        {{$item->date}}/{{$item->time_from}}:00<br>
                                        <span class="booking_style" style="font-size: 10px;">
                                            {{$item->name}}
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
