@extends('layouts.dt')
@section('title', 'On Demand Report')
@section('breadcrumb')
    <li><a href="{{ url('/') }}">Home</a></li>
    <li>Reports</li>
    <li>On Demand Report</li>
@endsection
@section('widget-title', 'Transaction Report')
@section('widget-desc', 'General Report')

@section('button')
    {{--<button type="button" class="btn btn-primary pull-right header-btn hidden-mobile" data-toggle="modal" data-target="#add-user-role">--}}
    {{--<i class="fa fa-plus"></i> Create Transaction--}}
    {{--</button>--}}
@endsection

@section('content')
    @include('layouts.includes._messages')
    <table class="table table-striped table-bordered table-hover" width="100%">
        <thead>
        <tr>
            <th>ID</th>
            <th>Vehicle</th>
            <th>Date</th>
            <th>Driver</th>
            <th>Total Coll.</th>
            <th>Total Trips</th>
            <th>Total Expenses</th>
            <th>Bank Expected</th>
            <th>Actual Banked</th>
            <th>Variance</th>
        </tr>
        </thead>
        <tbody>
        @if(count($reports))
            <?php $total_amount_col = 0;
                    $total_trips = 0;
                    $total_expenses = 0;
                    $total_expected=0;
                    $total_banked = 0;
                    $total_variance = 0;
                    $variance_t = 0
            ?>
            @foreach($reports as $report)
                <?php $bank_details = \Illuminate\Support\Facades\DB::table('daily_bank_accumulations')
                    ->where('transaction_id',$report->id)->first();
                    $vehicle_plates = \App\Bus::find($report->bus_id);
                    $driver = \App\Masterfile::find($report->driver_id);
                    $total_amount_col = $total_amount_col + $report->total_amount_collected;
                    $total_trips = $total_trips + $report->total_trips;
                    $total_expenses = $total_expenses + $report->total_expenses;
                    $total_expected=0;
                    $total_banked = $total_banked  + $bank_details->actual_banked ;
                    $total_variance = 0;
                    $t_C = $report->total_amount_collected;
                    $e = $report->total_expenses;
                    $e_b = $t_C - $e;
                    $variance = $e_b - $bank_details->actual_banked;
                    $variance_t = $variance_t + $variance;
                    ?>
                <tr>
                    <td>{{ $report->id }}</td>
                    <td>{{ $vehicle_plates->number_plate }}</td>
                    <td>{{ $report->transaction_date }}</td>
                    <td>{{ $driver->surname.' '.$driver->firstname.' '.$driver->middlename }}</td>
                    <td><?php echo number_format($report->total_amount_collected,2) ?></td>
                    <td>{{ $report->total_trips }}</td>
                    <td>{{  number_format($report->total_expenses,2) }}</td>
                    <td>{{ number_format($t_C - $e,2) }}</td>
                    <td>{{ number_format($bank_details->actual_banked,2) }}</td>
                    <td>{{ $variance }}</td>
                </tr>
            @endforeach
                <tr>

                    <td colspan="4" style="text-align:center;font-weight:bold;font-style: italic">Totals:</td>
                    <td style="font-weight:bold">{{ number_format($total_amount_col,2) }}</td>
                    <td style="font-weight:bold">{{ $total_trips }}</td>
                    <td style="font-weight:bold">{{ number_format($total_expenses,2) }}</td>
                    <td style="font-weight:bold">{{ number_format($total_amount_col - $total_expenses,2) }}</td>
                    <td style="font-weight:bold">{{ number_format($total_banked,2) }}</td>
                    <td style="font-weight:bold">{{ number_format($variance_t,2) }}</td>

                </tr>
                <tr>
                    <td colspan="10" style="text-align:right;font-weight:bold"> []</td>
                    {{--<td colspan="2" style="text-align:right;font-weight:bold"></td>--}}
                </tr>
            @endif
        </tbody>
    </table>
@endsection

