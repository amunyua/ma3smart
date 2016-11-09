@extends('layouts.dt')
@section('title', 'Invoices')
@section('widget-title', 'Manage Invoices')
@section('widget-desc', 'All Invoices')

@section('button')
    <ul class="li list-inline list-unstyled pull-right">
        <li>
            <button type="button" class="btn btn-primary pull-right header-btn" data-toggle="modal" data-target="#add-user-role">
                <i class="fa fa-plus"></i> Create Invoice
            </button>
        </li>
    </ul>
@endsection

@section('content')
    @include('layouts.includes._messages')
    <table id="datatable_tabletools" class="table table-striped table-bordered table-hover" width="100%">
        <thead>
        <tr>
            <th>ID</th>
            <th>Supplier</th>
            <th>Registration Number</th>
            <th>Invoice Date</th>
            <th>View Invoice</th>
        </tr>
        </thead>
        <tbody>
            @if(count($transactions))
                @foreach($transactions as $transaction)
                    <?php $supplier = \App\Supplier::find($transaction->supplier_id);
                            $vehicle = \App\Bus::find($transaction->vehicle_id);
                    ?>
                    <tr>
                        <td>{{ $transaction->id }}</td>
                        <td>{{ $supplier->supplier_name }}</td>
                        <td>{{ $vehicle->number_plate }}</td>
                        <td>{{ $transaction->transaction_date }}</td>
                        <td><?php echo '<a class="btn btn-small btn-success">View </a>'?></td>
                    </tr>
                    @endforeach
                @endif
        </tbody>
    </table>
@endsection

@section('modals')
    <div class="modal fade" id="add-user-role" role="dialog" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title">
                        Create Invoice
                    </h4>
                </div>
                <div class="modal-body no-padding">

                    <form id="add-menu-form" class="smart-form" action="{{ url('raise-invoice') }}" method="post">
                        {{ csrf_field() }}
                        <fieldset>
                            <section>
                                <div class="row">
                                    <label class="label col col-2">Date</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="date" required name="invoice_date" value="{{ date('Y-m-d') }}" autocomplete="off">
                                        </label>
                                    </div>
                                </div>
                            </section>
                            <section id="before">
                                <div class="row">
                                    <label class="label col col-2">Supplier</label>
                                    <div class="col col-10">
                                        <label class="input">
                                            <select name="supplier_id" required id="supplier" class="form-control">
                                                <option value="">Select supplier</option>
                                                @if(count($suppliers))
                                                    @foreach($suppliers as $supplier)
                                                        <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                                                        @endforeach
                                                    @endif
                                            </select>
                                        </label>
                                    </div>
                                </div>
                            </section>
                            <section id="before">
                                <div class="row">
                                    <label class="label col col-2">Vehicle Registration</label>
                                    <div class="col col-10">
                                        <label class="input">
                                            <select name="vehicle_id" required  class="form-control">
                                                <option value="">Select vehicle</option>
                                                @if(count($vehicles))
                                                    @foreach($vehicles as $vehicle)
                                                        <option value="{{ $vehicle->id }}">{{ $vehicle->number_plate }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </label>
                                    </div>
                                </div>
                            </section>
                            <div id="fields">

                            </div>

                        </fieldset>

                        <footer>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i> Save
                            </button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                <i class="fa fa-remove"></i> Cancel
                            </button>

                        </footer>
                    </form>


                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>


    {{--modal for delete--}}

    <div class="modal fade" id="delete-user-role" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title">
                        Delete User Role
                    </h4>
                </div>
                <div class="modal-body no-padding">

                    <form id="delete-role" class="smart-form" action="{{ url('delete-user-role') }}" method="post">
                        {{ csrf_field() }}
                        <fieldset>
                            <section>
                                <div class="row">
                                    <p class="p col col-10">
                                        Are you sure you want to delete this role?
                                    </p>
                                </div>
                            </section>

                            {{ method_field('DELETE') }}

                        </fieldset>

                        <footer>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i> Yes
                            </button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">
                                <i class="fa fa-remove"></i> Cancel
                            </button>

                        </footer>
                    </form>


                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
@endsection

@push('js')
<script src="{{ URL::asset('my_js/supplier/invoice.js') }}"></script>
@endpush