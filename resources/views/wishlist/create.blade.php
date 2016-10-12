@extends('backend.master')
@section('title', 'Appointment')
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
                                <a href="{{URL::route('admin.appointment.query')}}" class="btn btn-primary">Cancel</a>
                            </div>
                        </div>
                        <form class="form-horizontal" role="form" action="{{URL::route('admin.appointment.create.do')}}"
                              method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10 text-right">
                                    <button type="submit" id="add" class="btn btn-primary">Make</button>
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
                                <label for="inputPassword1" class="col-lg-2 col-sm-2 control-label">Location</label>
                                <div class="col-lg-10">
                                    <select class="form-control m-bot15" name="location" id="location">
                                        <option>HK</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword1" class="col-lg-2 col-sm-2 control-label">Room</label>
                                <div class="col-lg-10">
                                    <select class="form-control m-bot15" name="room_id" id="room_id">
                                        @foreach($room as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 col-sm-2 control-label">Date</label>
                                <div class="col-lg-10">
                                    <div class="col-xs-12 input-group" id="date">
                                        <select style="width: 33%" class="form-control m-bot15" name="year" id="year"></select>
                                        <select style="width: 33%" class="form-control m-bot15" name="month" id="month"></select>
                                        <select style="width: 33%" class="form-control m-bot15" name="day" id="day"></select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 col-sm-2 control-label">Time</label>
                                <div class="col-lg-10">
                                    <div class="col-xs-12 input-group">
                                        <span class="input-group-btn">
                                            <a class="btn btn-default" type="button">From</a>
                                        </span>
                                        <select class="form-control m-bot15" name="time_from" id="openfrom"></select>
                                        <span class="input-group-btn">
                                            <a class="btn btn-default" type="button">TO</a>
                                        </span>
                                        <select class="form-control m-bot15" name="time_to" id="opentill"></select>
                                    </div>
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
    <script src="{{URL::asset('assets/javascript/date.js')}}"></script>
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

            $('#openfrom').val({{$appointment->time_from}});
            $('#opentill').val({{$appointment->time_to}});

            $("#date").birthday();

        });
    </script>
@endsection
