@extends('backend.master')
@section('title', 'Wishlist')
@section('username', session('bk_name'))
@section('heading')
    <div class="header-section" style="z-index: 9999">
        <a class="toggle-btn"><i class="fa fa-bars"></i></a>
        <div class="page-heading">
            <h3>
                Wishlist
            </h3>
        </div>
    </div>
@endsection
@section('content')
    <div class="wrapper">
        <div class="row">
            <div class="col-xs-12">
                <section class="panel">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <td>
                                    <a>

                                        <span class="booking_style" style="font-size: 10px;">

                                        </span>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </section>
            </div>
        </div>
    </div>
@endsection
