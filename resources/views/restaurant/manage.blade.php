@extends('backend.master')
@section('title', 'Restaurant')
@section('username', session('bk_name'))
@section('heading')
    <div class="header-section" style="z-index: 9999">
        <a class="toggle-btn"><i class="fa fa-bars"></i></a>
        <div class="page-heading">
            <h3>
                Restaurant
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
                        <a href="{{URL::route('admin.restaurant.create')}}" id="editable-sample_new"
                           class="btn btn-primary">
                            Add Restaurant <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                <section class="panel">
                    <table class="table table-hover">
                        <tbody>
                        @foreach($restaurant as $item)
                            <tr>
                                <td>
                                    <a href="{{URL::route('admin.restaurant.edit',$item->id)}}">
                                        {{$item->name}}<br>
                                        <span class="booking_style" style="font-size: 10px;">
                                            @if($item->booking_type == 1)
                                                Priority
                                            @elseif($item->booking_type == 0)
                                                Chope
                                            @else
                                                Chope,Priority
                                            @endif
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
