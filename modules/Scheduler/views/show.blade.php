@extends('Pluma::layouts.admin')

@section("content")
   <div class="content-wrapper">
        @include("Pluma::partials.breadcrumb")
        <section class="content">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Time Report Summary View</h3>
                    <h5 class="box-title pull-right">{{ $date }}</h5>
                </div>
                <form action="" method="GET">
                    <div class="col-md-6">
                        <div class="row m-t-2 m-b-2">
                            <div class="col-xs-6 col-lg-3">
                                <select name="date" id="" class="form-control">
                                @foreach ( $months as $month )
                                    <option class="form-control" {{ request()->input('date') == $month->date ? 'selected="selected"' : '' }} value="{{ $month->date }}">{{ $month->month_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xs-2 p-l-0">
                                <button class="btn btn-default" type="submit">Select</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="box-body">
                    <section id="example">
                        <div class="wrapper-x">
                            <table class="table table-bordered table-border-sum">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    @foreach ( $calendars as $calendar )
                                    <th class="text-center">{{ $calendar->day_code }}</th>
                                    @endforeach
                                </tr>
                                <tr class="bg-sum-end">
                                    <th>Client Name</th>
                                    <th>Work Done</th>

                                    @foreach ( $calendars as $calendar )
                                    <th class="text-center">{{ $calendar->day }}</th>
                                    @endforeach

                                    <th class="text-center">Total</th>
                                </tr>

                            </thead>
                            <tbody class="list">
                                @foreach ( $resources as $type => $collections )
                                    <tr class="thead-info bg-info">
                                        <th colspan="{{ count($calendars) + 3 }}">{{ $type }}</th>
                                    </tr>
                                    @foreach ( $collections['info'] as $resource )
                                        @foreach ( $resource as $collection )
                                            <tr>
                                                <td>{{ $collection->client->name or "" }}</td>
                                                <td>{{ $collection->description or "" }}</td>
                                                @foreach ( $collection->calendar as $calendar )
                                                    <td class="text-center">{{ $calendar->hours }}</td>
                                                @endforeach
                                                <td class="text-center">{{ $collection->totalhours }}</td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                    <tr class="thead-warning bg-sum">
                                        <th colspan="2">Subtotal</th>
                                        @foreach ( $collections['subtotal']['hours'] as $subtotal )
                                        <th class="text-center">{{ $subtotal }}</th>
                                        @endforeach
                                        <th class="text-center">{{ $collections['subtotal']['totalhours'] or "" }}</th>
                                    </tr>
                                    <tr>
                                    </tr>
                                @endforeach
                                <tr></tr>
                                <tr class="thead-warning bg-sum-end">
                                    <th colspan="2">Grand Total</th>
                                    @foreach ( $grandtotal['hours'] as $total )
                                        <th class="text-center">{{ $total }}</th>
                                    @endforeach
                                    <th class="text-center">{{ $grandtotal['totalhours'] }}</th>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                    </section>
                </div>
                <div class="box box-footer">
                    <form action="{{ route('scheduler.generate', $employee_id) }}" method="POST">
                        {{ csrf_field() }}
                        <input name="date" type="hidden" value="{{ app('request')->input("date") }}">
                        <button class="btn btn-primary pull-right" type="submit"><i class="fa fa-download"></i> Generate Excel</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
@stop

@push('js')
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="{{ asset('vendor/admin-lte/dist/js/app.min.js') }}"></script>
@endpush