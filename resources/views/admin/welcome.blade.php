@extends('backend.master')
@section('title', 'Dashboard')
@section('username', session('bk_name'))
@section('heading')
    <div class="header-section" style="z-index: 9999">
        <a class="toggle-btn"><i class="fa fa-bars"></i></a>
        <div class="page-heading">
            <h3>
                Dashboard
            </h3>
        </div>
    </div>
@endsection
@section('content')
    <div class="wrapper">
        <div class="row">
            <div class="col-xs-12">
                <!--more statistics box start-->
                <div class="panel deep-purple-box">
                    <div class="panel-body">
                        <div class="row">
                            <h1 style="padding: 10px;margin: 0;">欢迎您，{{session('bk_name')}} 来到维护界面。</h1>
                        </div>
                    </div>
                </div>
                <!--more statistics box end-->
            </div>
        </div>
    </div>
@endsection
