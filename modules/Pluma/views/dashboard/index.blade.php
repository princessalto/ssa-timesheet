@extends('Pluma::layouts.admin')

@section("content")
    <div class="content-wrapper">
        @include("Pluma::partials.breadcrumb")

        <section class="content">
        <div class="text-center">
            <code>Under Maintenance</code>
        </div>
            {{-- <div class="container-fluid">
                <img width="500" class="img-responsive" src="{{ asset('resources/images/soon.jpg') }}">
            </div> --}}
            {{-- <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Total Hours of Tasks per Month</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>

                <div class="box-body">
                    <div class="tab-content no-padding">
                        <div class="chart">
                            <canvas id="monthly-tasks" height="500"></canvas>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-sm-3 col-xs-6">
                            <div class="description-block border-right">
                                <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>
                                <h5 class="description-header">999</h5>
                                <span class="description-text text-uppercase">Over All Billable Tasks</span>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-6">
                            <div class="description-block border-right">
                                <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span>
                                <h5 class="description-header">999</h5>
                                <span class="description-text text-uppercase">Over All Billable Hours</span>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-6">
                            <div class="description-block border-right">
                                <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 20%</span>
                                <h5 class="description-header">999</h5>
                                <span class="description-text text-uppercase">Over All Non- billable Tasks</span>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-6">
                            <div class="description-block">
                                <span class="description-percentage text-red"><i class="fa fa-caret-down"></i> 18%</span>
                                <h5 class="description-header">999</h5>
                                <span class="description-text text-uppercase">Over All Non - billable Hours</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-5">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Monthly Breakdown of Tasks</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>

                        <div class="box-body">
                            <table class="table text-center">
                                <tbody>
                                    <tr>
                                        <th>Month</th>
                                        <th>Total Billable Tasks</th>
                                        <th>Total Non - billable Tasks</th>
                                    </tr>
                                    <tr>
                                        <td>January</td>
                                        <td>100</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td>February</td>
                                        <td>100</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td>March</td>
                                        <td>100</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td>April</td>
                                        <td>100</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td>May</td>
                                        <td>100</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td>June</td>
                                        <td>100</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td>July</td>
                                        <td>100</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td>August</td>
                                        <td>100</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td>September</td>
                                        <td>100</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td>October</td>
                                        <td>100</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td>November</td>
                                        <td>100</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td>December</td>
                                        <td>100</td>
                                        <td>0</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-7">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Monthly Breakdown of Hours</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>

                        <div class="box-body">
                            <table class="table text-center">
                                <tbody>
                                    <tr>
                                        <th>Month</th>
                                        <th>Total Billable Hours</th>
                                        <th>Total Non - billable Hours</th>
                                        <th>Progress</th>
                                        <th>Label</th>
                                    </tr>
                                    <tr>
                                        <td>January</td>
                                        <td>100</td>
                                        <td>0</td>
                                        <td>
                                            <div class="progress progress-xs progress-striped active">
                                                <div class="progress-bar progress-bar-primary" style="width: 70%"></div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-light-blue">70%</span></td>
                                    </tr>
                                    <tr>
                                        <td>February</td>
                                        <td>100</td>
                                        <td>0</td>
                                        <td>
                                            <div class="progress progress-xs progress-striped active">
                                                <div class="progress-bar progress-bar-danger" style="width: 90%"></div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-red">90%</span></td>
                                    </tr>
                                    <tr>
                                        <td>March</td>
                                        <td>100</td>
                                        <td>0</td>
                                        <td>
                                            <div class="progress progress-xs progress-striped active">
                                                <div class="progress-bar progress-bar-primary" style="width: 70%"></div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-light-blue">75%</span></td>
                                    </tr>
                                    <tr>
                                        <td>April</td>
                                        <td>100</td>
                                        <td>0</td>
                                        <td>
                                            <div class="progress progress-xs progress-striped active">
                                                <div class="progress-bar progress-bar-primary" style="width: 70%"></div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-light-blue">70%</span></td>
                                    </tr>
                                    <tr>
                                        <td>May</td>
                                        <td>100</td>
                                        <td>0</td>
                                        <td>
                                            <div class="progress progress-xs progress-striped active">
                                                <div class="progress-bar progress-bar-primary" style="width: 70%"></div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-light-blue">70%</span></td>
                                    </tr>
                                    <tr>
                                        <td>June</td>
                                        <td>100</td>
                                        <td>0</td>
                                        <td>
                                            <div class="progress progress-xs progress-striped active">
                                                <div class="progress-bar progress-bar-danger" style="width: 90%"></div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-red">90%</span></td>
                                    </tr>
                                    <tr>
                                        <td>July</td>
                                        <td>100</td>
                                        <td>0</td>
                                        <td>
                                            <div class="progress progress-xs progress-striped active">
                                                <div class="progress-bar progress-bar-danger" style="width: 90%"></div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-red">90%</span></td>
                                    </tr>
                                    <tr>
                                        <td>August</td>
                                        <td>100</td>
                                        <td>0</td>
                                        <td>
                                            <div class="progress progress-xs progress-striped active">
                                                <div class="progress-bar progress-bar-danger" style="width: 90%"></div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-red">90%</span></td>
                                    </tr>
                                    <tr>
                                        <td>September</td>
                                        <td>100</td>
                                        <td>0</td>
                                        <td>
                                            <div class="progress progress-xs progress-striped active">
                                                <div class="progress-bar progress-bar-danger" style="width: 90%"></div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-red">90%</span></td>
                                    </tr>
                                    <tr>
                                        <td>October</td>
                                        <td>100</td>
                                        <td>0</td>
                                        <td>
                                            <div class="progress progress-xs progress-striped active">
                                                <div class="progress-bar progress-bar-danger" style="width: 90%"></div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-red">90%</span></td>
                                    </tr>
                                    <tr>
                                        <td>November</td>
                                        <td>100</td>
                                        <td>0</td>
                                        <td>
                                            <div class="progress progress-xs progress-striped active">
                                                <div class="progress-bar progress-bar-primary" style="width: 70%"></div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-light-blue">70%</span></td>

                                    </tr>
                                    <tr>
                                        <td>December</td>
                                        <td>100</td>
                                        <td>0</td>
                                        <td>
                                            <div class="progress progress-xs progress-striped active">
                                                <div class="progress-bar progress-bar-danger" style="width: 90%"></div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-red">90%</span></td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> --}}
        </section>
    </div>
@stop

@push('js')
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.2/moment.min.js"></script>

	<script src="{{ asset('vendor/admin-lte/dist/js/app.min.js') }}"></script>
	<script src="{{ asset('vendor/admin-lte/dist/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('vendor/admin-lte/dist/js/demo.js') }}"></script>

    {{-- chartJs --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.bundle.min.js"></script>
    <script scr="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>

    <script>
        // line-tasks
        var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        var nonbillable = [20, 29, 20, 15, 12, 13, 22, 19, 13, 15, 12, 13];
        var billable    = [30, 35, 30, 25, 15, 20, 25, 20, 15, 25, 22, 13];
        var options = {
            type: 'line',
            data: {
                labels: months,
                datasets: [

                    {
                        label: 'Non-billable',
                        data: nonbillable,
                        backgroundColor: 'rgba(221, 75, 57, 0.2)',
                        borderColor:'rgba(221, 75, 57, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Billable',
                        data: billable,
                        backgroundColor:  'rgba(0, 115, 183, 0.2)',
                        borderColor:
                            'rgba(0, 115, 183, 1)',
                        borderWidth: 1
                    },
                ]
            },
            options: {
                tooltips: {
                    backgroundColor: 'rgba(0,0,0,0.6)',
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            reverse: false
                        }
                    }]
                }
            }
        }
        var ctx = document.getElementById('monthly-tasks').getContext('2d');
        new Chart(ctx, options);
    </script>
@endpush