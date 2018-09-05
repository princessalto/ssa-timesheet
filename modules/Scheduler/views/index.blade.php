@extends('Pluma::layouts.admin')

@section("content")
    <div class="content-wrapper">
        @include("Pluma::partials.breadcrumb")
        <section class="content">
            {{-- <div class="row">
                <div class="col-sm-3 col-xs-6">
                    <div class="panel bg-purple panel-shadow border-none">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <span class="text-white"><i class="fa fa-tasks fa-2x"></i></span>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge text-white">{{ $widgets['total_tasks'] }}</div>
                                    <div class="text-white">Total Tasks</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-6">
                    <div class="panel bg-blue panel-shadow border-none">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <span class="text-white"><i class="fa fa-bell-o fa-2x"></i></span>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge text-white">0</div>
                                    <div class="text-white">Total Billable</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-6">
                    <div class="panel bg-red panel-shadow border-none">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <span class="text-white"><i class="fa fa-bell-slash-o fa-2x"></i></span>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge text-white">0</div>
                                    <div class="text-white">Total Non-billable</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-6">
                    <div class="panel bg-green panel-shadow border-none">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <span class="text-white"><i class="fa fa-clock-o fa-2x" aria-hidden="true"></i></span>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge text-white">0 / 1000</div>
                                    <div class="text-white">Total Hours Worked</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Time Report</h3>
                </div>
                <form class="form-horizontal">
                    <div class="box-body">
                        <div class="details-btn m-b-2">
                            <a class="btn-summary btn btn-warning" data-href="{{ date("Y-m-d") }}" href="{{ route('scheduler.show', ['scheduler' => auth()->user()->id, 'date' => date("Y-m-d")]) }}"><i class="fa fa-eye"></i> View Summary</a>
                        <span> | </span>
                        <a class="btn btn-success" href="{{ action('\Modules\Scheduler\SchedulerController@create') }}"><i class="fa fa-plus"></i> Add Schedule</a>
                        </div>
                        <div id="scheduler" data-ajax='{"url": "{{ action('\Modules\Scheduler\API\SchedulerController@index') }}", "method": "GET" }'></div>
                        <div class="clear"></div>
                    </div>
                </form>
            </div>
        </section>
    </div>
@stop

@push('js')
    <script src="//code.jquery.com/jquery.js"></script>
    {{-- <script src="{{ asset('vendor/jquery/dist/jquery.min.js') }}"></script> --}}
    {{-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> --}}
    <script src="{{ asset('vendor/bootstrap-3.3.7/dist/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('vendor/admin-lte/dist/js/app.min.js') }}"></script>
    {{-- <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.2/moment.min.js"></script> --}}
    <script src="{{ asset('vendor/moment/moment.js') }}"></script>
    {{-- <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.6.1/fullcalendar.min.js"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.print.css"></script> --}}
    <script src="{{ asset('vendor/fullCalendar/fullcalendar.min.js') }}"></script>

    <script>
        // calendar
        var events = [];
        $('[data-ajax]').each(function () {
            var options = $(this).data('ajax');
            var _dis = this;
            $.ajax({
                url: options.url,
                data: {_token: "{{ csrf_token() }}"},
                method: options.method,
                success: function (data) {
                    console.log(data);
                    var _events = [];
                    for (var i = data.length - 1; i >= 0; i--) {
                        _events.push({
                            id: data[i].id,
                            url: data[i].url,
                            title: data[i].client.name,
                            description: data[i].description,
                            start: data[i].date + " " + data[i].start_time,
                            end: data[i].date + " " + data[i].end_time,
                        });
                    }

                    console.log(_dis);
                    jQuery(_dis).fullCalendar({
                        events:_events,
                        eventRender: function(event, element) {
                            element.find('.fc-title').append( "<span><br/>" + event.description + "</span>" );
                        },
                        header: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'month,agendaWeek,agendaDay,listWeek'
                        },
                        navLinks: true,
                        eventResize: true,
                        editable: false,
                        selectable: false,
                        selectHelper: true,
                        eventLimit: true,
                        allDaySlot: false,
                        businessHours: true,
                        minTime: "08:00:00",
                        maxTime: "24:00:00",
                        businessHours: {
                            dow: [1, 2, 3, 4, 5, 6],
                            start: '08:00:00',
                            end: '24:00:00',
                        },
                    });
                },
            });
        });

        // view summary
        $(document).on('click', '.fc-next-button, .fc-prev-button, .fc-today-button', function () {
            var date = $("#scheduler").fullCalendar('getDate').format("YYYY-MM-DD");
            $('.btn-summary').attr('data-href', date);
        });
        $('.btn-summary').on('click', function (e) {
            var date = $(this).data('href');
            var href = "{{ action('\Modules\Scheduler\SchedulerController@show', auth()->user()->id) }}" + "?date=" + date;
            $(this).attr('href', href);
            window.location = href;
            e.preventDefault();
        });

        $.ajax({
            url: "{{ action('\Modules\Scheduler\API\SchedulerController@widgets', ['date' => '2017-02-01']) }}",
            method: 'POST',
            data: {_token: "{{ csrf_token() }}"},
            success: function (data) {
                console.log(data);
            }
        })
    </script>
@endpush