<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Time Report</title>
        <style>
            body { font-family:'Open Sans',sans-serif; background:#fff; }
            body, .table, .table th, .table td { border:1px solid #666; padding:3px; font-size:9px; }
            thead th { font-size: 9px; text-transform: uppercase; }
            thead td { font-size: 9px; }
            tbody th { font-size: 9px; }
            tbody td { font-size: 9px; }
            .table th { text-align: left; font-size: 9px; }
            th { font-size: 9px; }
            .table-bordered>tbody>tr>th { border: 1px solid #e2e2e2; }
        </style>
    </head>

    <body>
        <table>
            <thead>
                <tr><td style="text-transform: uppercase; text-align: left; font-weight: bold;">SSA Consulting Group</td></tr>
                <tr><td style="text-transform: uppercase; text-align: left; font-weight: bold;">Time Report</td></tr>
                <tr><td style="text-transform: uppercase; text-align: left; font-weight: bold;">For the Month of {{ "$month, $year" }}</td></tr>
                <tr><td></td></tr>
                <tr>
                    <td style="text-align: left; font-size: 9px; font-weight: bold;">Staff Name:</td>
                    <td style="text-align:">{{ ($employee->fullname) }}</td>
                </tr>
                <tr>
                    <td style="font-size: 9px; font-weight: bold;">Position:</td>
                    <td>{{ isset($employee->detail->designation) ? $employee->detail->designation : "" }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
            </thead>

            <tbody class="table table-bordered">
                <tr>
                    <td></td>
                    <td></td>
                    @foreach ( $calendars as $calendar )
                    <td class="text-center">{{ $calendar->day_code }}</td>
                    @endforeach
                </tr>

                <tr style="background: #d9d9d9; font-weight: bold;">
                    <td>Entity</td>
                    <td width="50">Work Done</td>
                    @foreach($calendars as $calendar)
                    <td width="3" style="text-align: center;">{{ $calendar->day }}</td>
                    @endforeach
                    <td width="100" style="text-align: center;">TOTAL</td>
                </tr>

                @foreach ( $resources as $type => $collections )
                    <tr>
                        <td style="background: #cce3f1; font-weight: bold;" colspan="{{ count($calendars) + 3 }}">{{ $type }}</td>
                    </tr>
                    @foreach ( $collections['info'] as $resource )
                        @foreach ( $resource as $collection )
                            <tr>
                                <td>{{ $collection->client->name or "" }}</td>
                                <td>{{ $collection->description or "" }}</td>
                                @foreach ( $collection->calendar as $calendar )
                                    <td width="5" style="text-align: center;">{{ $calendar->hours }}</td>
                                @endforeach
                                <td width="5" style="text-align: center;">{{ $collection->totalhours }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                    <tr>
                        <td style="background: #f4f4f4; text-align: center;" colspan="2" style="font-weight: bold;">Subtotal</th>
                        @foreach ( $collections['subtotal']['hours'] as $subtotal )
                        <td style="background: #f4f4f4;text-align: center;">{{ $subtotal }}</th>
                        @endforeach
                        <td style="background: #f4f4f4;text-align: center;">{{ $collections['subtotal']['totalhours'] or "" }}</th>
                    </tr>

                @endforeach
                {{-- <tr></tr> --}}
                <tr>
                    <td colspan="2" style="font-weight: bold;">Grand Total</th>
                    @foreach ( $grandtotal['hours'] as $total )
                        <td style="text-align: center; font-weight: bold; background: #d9d9d9;">{{ $total }}</th>
                    @endforeach
                    <td style="background: #d9d9d9; text-align: center; font-weight: bold;">{{ $grandtotal['totalhours'] }}</th>
                </tr>
            </tbody>
        </table>
    </body>
</html>
{{-- {{ dd($resources) }} --}}