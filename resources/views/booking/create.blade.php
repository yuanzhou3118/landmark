@extends('backend.master')
@section('title', 'Booking')
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
                                <a href="{{URL::route('admin.booking.query')}}" class="btn btn-primary">Cancel</a>
                            </div>
                        </div>
                        <form class="form-horizontal" role="form" action="{{URL::route('admin.booking.create.do')}}"
                              method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10 text-right">
                                    <button type="submit" id="add" class="btn btn-primary">Add</button>
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
                                    <input type="text" class="form-control" name="name" id="name"
                                           value="{{$booking->name}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword1" class="col-lg-2 col-sm-2 control-label">Open Hours</label>
                                <div class="col-lg-10">
                                    <div class="col-xs-12 input-group">
                                        <span class="input-group-btn">
                                                <a class="btn btn-default" type="button">From</a>
                                        </span>
                                        <select class="form-control m-bot15" name="openfrom" id="openfrom">

                                        </select>
                                        <span class="input-group-btn">
                                               <a class="btn btn-default" type="button">TO</a>
                                        </span>
                                        <select class="form-control m-bot15" name="opentill" id="opentill">

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword1" class="col-lg-2 col-sm-2 control-label">Floorplan Url</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" name="floorplan_url" value="{{$booking->floorplan_url}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 col-sm-2 control-label">Title</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" name="title"
                                           value="{{$booking->title}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 col-sm-2 control-label">Description</label>
                                <div class="col-lg-10">
                                    <textarea class="form-control" name="description">
                                        {{$booking->description}}
                                    </textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 col-sm-2 control-label">Logo Url</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" name="logo_url" id="logo_url"
                                           value="{{$booking->logo_url}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 col-sm-2 control-label">Contact Name</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" name="contact_name" id="contact_name"
                                           value="{{$booking->contact_name}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 col-sm-2 control-label">Contact
                                    Phone</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" name="contact_phone" id="contact_phone"
                                           value="{{$booking->contact_phone}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 col-sm-2 control-label">Location</label>
                                <div class="col-lg-10">
                                    <select class="form-control m-bot15" name="location" id="location">
                                        <option>HK</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 col-sm-2 control-label">Booking type</label>
                                <div class="col-lg-10">
                                    <label class="checkbox-inline">
                                        <input type="checkbox" id="booking_style" value="0" name="booking_style[]">Chope
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" id="booking_style" value="1" name="booking_style[]">Priority
                                        Booking
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword1" class="col-lg-2 col-sm-2 control-label">Status</label>
                                <div class="col-lg-10">
                                    <label class="checkbox-inline">
                                        <input type="checkbox" id="active" name="active">Active
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword1" class="col-lg-2 col-sm-2 control-label">booking
                                    URL</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" name="url" id="url"
                                           value="{{$booking->url}}">
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
            $('#openfrom')[0].onchange = function () {
                var openfrom = +this.value;

                $('#opentill').empty();
                for (var j = openfrom + 1; j < 24; j++) {
                    if (j < 13) {
                        document.getElementById("opentill").innerHTML += '<option value="' + j + '">' + j + ':00AM</option>';
                    } else {
                        document.getElementById("opentill").innerHTML += '<option value="' + j + '">' + (j - 12) + ':00PM</option>';
                    }
                }
            };

            var booking_style = '{{$booking->booking_type}}';
            if (booking_style == 2) {
                $('input:checkbox').eq(0).attr("checked", 'true');
                $('input:checkbox').eq(1).attr("checked", 'true');
            } else {
                $('input:checkbox').eq(booking_style).attr("checked", 'true');
            }

            if ($('#result span').text().length == 0) {
                $('#result').hide();
            }

            for (var k = 0; k < 24; k++) {
                if (k < 13) {
                    document.getElementById("openfrom").innerHTML += '<option value="' + k + '">' + k + ':00AM</option>';
                } else {
                    document.getElementById("openfrom").innerHTML += '<option value="' + k + '">' + (k - 12) + ':00PM</option>';
                }
            }

            $('#openfrom').val({{$booking->openfrom}});
            $('#opentill').val({{$booking->opentill}});

            if ('{{$booking->active}}' == 1) {
                $('#active').attr('checked', 'true')
            }


        });


    </script>
@endsection
