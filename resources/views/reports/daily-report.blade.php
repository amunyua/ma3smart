@extends('layouts.dt')
@section('title', 'Daily Report')
@section('breadcrumb')
    <li><a href="{{ url('/') }}">Home</a></li>
    <li>Reports</li>
    <li>Daily Report</li>
@endsection
@section('widget-title', 'Daily Transaction Report')
@section('widget-desc', 'Daily Report')

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
            <th>Date</th>
            <th></th>
            <th>Expense</th>
            <th>Amount</th>
        </tr>
        </thead>
        <tbody>
        @if(count($daily_reports))
            <?php $total_expenses = 0;
            $count=0;
            ?>
            @foreach($daily_reports as $report)
                <?php
                    $count++;
                    $total_expenses = $total_expenses + $report->amount;
                    $expense_name = \App\Expense::find($report->expense_id);
//                        print_r($daily_reports[0])
                ?>
            <tr>
                <td>{{ $count }}</td>
                <td></td>
                <td></td>
                <td style="text-align:right;">{{ $expense_name->expense_name }}</td>
                <td style="text-align:right;">{{ number_format($report->amount,2) }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="2" style="text-align:right;font-weight:Bold;font-style: italic">Total Collected:</td>
                <td colspan="1" style="text-align:right;font-weight:bold">{{ number_format($daily_reports[0]->total_amount_collected,2) }}</td>
                <td colspan="1" style="text-align:right;font-weight:bold">Total Expenses:</td>

                <td style="text-align:right;font-weight:bold"><?php echo number_format($total_expenses,2)?> </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:right;font-weight:normal;font-style: italic">Bank Expected:</td>
                <td colspan="1" style="text-align:right;font-weight:bold"><?php  $expected = $daily_reports[0]->total_amount_collected - $total_expenses; echo number_format($expected,2) ?></td>

                <td colspan="2" style="text-align:right;font-weight:bold"></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:right;font-weight:normal;font-style: italic">Actual Banked:</td>
                <td colspan="1" style="text-align:right;font-weight:bold"><?php $actual=$daily_reports[0]->actual_banked; echo number_format($actual,2) ?></td>

                <td colspan="2" style="text-align:right;font-weight:bold"></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:right;font-weight:normal;font-style: italic">Variance:</td>
                <td colspan="1" style="text-align:right;font-weight:bold">{{ number_format($expected - $actual) }}</td>

                <td colspan="2" style="text-align:right;font-weight:bold"></td>
            </tr>



            <tr>
                <td colspan="6" style="text-align:right;font-weight:bold"> []</td>
                {{--<td colspan="2" style="text-align:right;font-weight:bold"></td>--}}
            </tr>
        @endif
        </tbody>
    </table>
@endsection

