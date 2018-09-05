@extends('Pluma::layouts.admin')

@section("content")
    <div class="content-wrapper">
        @include("Pluma::partials.breadcrumb")
        <section class="content">
            <div class="row">
                <div class="col-md-6 col-xs-12">

                    @include("Pluma::partials.flash")

                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Schedule</h3>
                        </div>

                        <form class="form-horizontal" action="{{ action('\Modules\Scheduler\SchedulerController@store') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Client Name</label>
                                    <div class="col-md-10">
                                        <div class="control-group input-default">
                                            <select class="demo-default" name="client_id" id="tag-client">
                                                @foreach ( $clients as $id => $client )
                                                <option value="{{ $id }}" {{ old('client_id') == $id ? 'selected="selected"' : '' }}>{{ $client }}</option>
                                                @endforeach
                                            </select>
                                            @include("Pluma::errors.span", ['field' => 'client_id'])
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Description</label>
                                    <div class="col-md-10">
                                        <div class="control-group input-default">
                                            <select class="demo-default" name="description" id="tag-description">
                                                @foreach ($tags as $tag)
                                                    <option value="{{ $tag }}">{{ $tag }}</option>
                                                @endforeach
                                            </select>
                                            @include("Pluma::errors.span", ['field' => 'description'])
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Date</label>
                                    <div class="col-md-10">
                                        <div class="input-group date">
                                            <input type="text" class="form-control" id="datepicker-create" name="date" value="{{ old('date') }}">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar-o"></i>
                                            </div>
                                        </div>
                                        @include("Pluma::errors.span", ['field' => 'date'])
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Start Time</label>
                                    <div class="col-md-10">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="start-time-create" name="start_time" value="{{ old('start_time') }}">
                                            <div class="input-group-addon">
                                                <i class="fa fa-clock-o"></i>
                                            </div>
                                        </div>
                                        @include("Pluma::errors.span", ['field' => 'start_time'])
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">End Time</label>
                                    <div class="col-md-10">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="end-time-create" name="end_time" value="{{ old('end_time') }}">
                                            <div class="input-group-addon">
                                                <i class="fa fa-clock-o"></i>
                                            </div>
                                        </div>
                                        @include("Pluma::errors.span", ['field' => 'end_time'])
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary pull-right">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@stop

@push('css')
     <link rel="stylesheet" href="{{ asset('vendor/admin-lte/dist/css/AdminLTE.min.css') }}">
    <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/css/tether.css">
    <script type="text/javascript" src="{{ asset('vendor/moment/min/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/selectize.js/dist/css/selectize.css') }}">
    <script src="{{ asset('vendor/selectize.js/dist/js/standalone/selectize.min.js') }}"></script>
@endpush

@push('js')


    <script src="{{ asset('vendor/selectize.js/dist/js/selectize.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('vendor/admin-lte/dist/js/app.min.js') }}"></script>
    <script>
        jQuery(function () {
            jQuery('#start-time-create').datetimepicker({
                format: 'LT',
            });
        });

        jQuery(function () {
            jQuery('#end-time-create').datetimepicker({
                format: 'LT',
                useCurrent: false,
            });
            $("#start-time-create").on("dp.change", function (e) {
                $('#end-time-create').data("DateTimePicker").minDate(e.date);
            });
            $("#end-time-create").on("dp.change", function (e) {
                $('#start-time-create').data("DateTimePicker").maxDate(e.date);
            });
        });

        $(function () {
            $('#datepicker-create').datetimepicker({
                format: "YYYY-MM-DD",
            });
        });

        $('#tag-description').selectize({
            plugins: ['restore_on_backspace'],
            delimiter: ',',
            persist: false,
            maxItems: 1,
            create: function(input) {
                return {
                    value: input,
                    text: input
                }
            }
        });

        $('#tag-client').selectize({
            plugins: ['restore_on_backspace'],
            delimiter: ',',
            persist: false,
            maxItems: 1,
            create: function(input) {
                return {
                    value: input,
                    text: input
                }
            }
        });
    </script>
@endpush