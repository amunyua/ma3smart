@extends('layouts.dt')
@section('title', 'Suppliers')
@section('widget-title', 'Manage Suppliers')
@section('widget-desc', 'All Suppliers')

@section('button')

    <ul class="list-inline list-unstyled pull-right">
        <li>
            <a type="button" class="btn btn-primary pull-right header-btn hidden-mobile" data-toggle="modal" data-target="#add-user-role">
                <i class="fa fa-plus"></i> Add Supplier
            </a>
        </li>
        {{--<li>--}}
            {{--<a data-toggle="modal" href="#edit-route" id="edit-masterfile-btn" class="btn btn-warning btn-sm header-btn  pull-right ">--}}
                {{--<i class="fa fa-edit"></i> Edit Supplier--}}
            {{--</a>--}}
        {{--</li>--}}
        {{--<li>--}}
            {{--<a data-toggle="modal" href="#delete-supplier" id="edit-route-btn" class="btn btn-danger btn-sm header-btn pull-right ">--}}
                {{--<i class="fa fa-edit"></i> Delete supplier--}}
            {{--</a>--}}
        {{--</li>--}}
    </ul>
@endsection

@section('content')
    @include('layouts.includes._messages')
    <table id="datatable_tabletools" class="table table-striped table-bordered table-hover" width="100%">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Code</th>
            <th>Supplier Role</th>
            <th>Status</th>
            <th>Phone Number</th>
            <th>City</th>
            <th>Physical Addres</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
            @if(count($suppliers))
                @foreach($suppliers as $supplier)
                    <tr>
                        <td>{{ $supplier->id }}</td>
                        <td>{{ $supplier->supplier_name }}</td>
                        <td>{{ $supplier->code }}</td>
                        <td>{{ $supplier->role }}</td>
                        <td>{{ $supplier->status }}</td>
                        <td>{{ '0'.$supplier->phone_number }}</td>
                        <td>{{ $supplier->city }}</td>
                        <td>{{ $supplier->physical_location }}</td>
                        <td><a href="#edit-supplier" edit-id ="{{ $supplier->id }}" id="edit-supplier-btn" action="{{ url('store-supplier') }}" data-toggle="modal" class="btn btn-warning btn-xs">Edit</a></td>
                        <td><a href="#delete-supplier" action="{{ url('delete-supplier/'.$supplier->id) }}" id="delete-supplier-btn" data-toggle="modal" class="btn btn-danger btn-xs">Delete</a></td>
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
                        Add Supplier
                    </h4>
                </div>
                <div class="modal-body no-padding">

                    <form id="add-menu-form" class="smart-form" action="{{ url('store-supplier') }}" method="post">
                        {{ csrf_field() }}
                        <fieldset>
                            <section>
                                <div class="row">
                                    <label class="label col col-2">Supplier Name</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="text" required name="supplier_name" autocomplete="off">
                                        </label>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <div class="row">
                                    <label class="label col col-2">Supplier Role</label>
                                    <div class="col col-10">
                                        <label class="input">
                                            <select name="role" required class="form-control">
                                                <option value="Garage">Garage</option>
                                            </select>
                                        </label>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <div class="row">
                                    <label class="label col col-2">Code</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="text" required name="code" autocomplete="off">
                                        </label>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <div class="row">
                                    <label class="label col col-2">Registration Number</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="number"  name="registration_number" autocomplete="off">
                                        </label>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <div class="row">
                                    <label class="label col col-2">Phone Number</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="number" required name="phone_number" autocomplete="off">
                                        </label>
                                    </div>
                                </div>
                            </section>
                            <section>
                                <div class="row">
                                    <label class="label col col-2">City</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="text" required name="city" autocomplete="off">
                                        </label>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <div class="row">
                                    <label class="label col col-2">Physical Location</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="text" required name="physical_location" autocomplete="off">
                                        </label>
                                    </div>
                                </div>
                            </section>





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

    {{--modal for edit--}}
    <div class="modal fade" id="edit-supplier" role="dialog" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title">
                        Edit Supplier
                    </h4>
                </div>
                <div class="modal-body no-padding">

                    <form id="add-menu-form" class="smart-form"  method="post">
                        {{ csrf_field() }}
                        <fieldset>
                            <section>
                                <div class="row">
                                    <label class="label col col-2">Supplier Name</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="text" required name="supplier_name" autocomplete="off">
                                        </label>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <div class="row">
                                    <label class="label col col-2">Supplier Role</label>
                                    <div class="col col-10">
                                        <label class="input">
                                            <select name="role" required class="form-control">
                                                <option value="Garage">Garage</option>
                                            </select>
                                        </label>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <div class="row">
                                    <label class="label col col-2">Code</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="text" required name="code" autocomplete="off">
                                        </label>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <div class="row">
                                    <label class="label col col-2">Registration Number</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="text"  name="registration_number" autocomplete="off">
                                        </label>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <div class="row">
                                    <label class="label col col-2">Phone Number</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="number" required name="phone_number" autocomplete="off">
                                        </label>
                                    </div>
                                </div>
                            </section>
                            <section>
                                <div class="row">
                                    <label class="label col col-2">City</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="text" required name="city" autocomplete="off">
                                        </label>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <div class="row">
                                    <label class="label col col-2">Physical Location</label>
                                    <div class="col col-10">
                                        <label class="input"> <i class="icon-append fa fa-keyboard-o"></i>
                                            <input type="text" required name="physical_location" autocomplete="off">
                                        </label>
                                    </div>
                                </div>
                            </section>





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

    <div class="modal fade" id="delete-supplier" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title">
                        Delete Supplier
                    </h4>
                </div>
                <div class="modal-body no-padding">

                    <form id="delete-supplier-form" class="smart-form"  method="post">
                        {{ csrf_field() }}
                        <fieldset>
                            <section>
                                <div class="row">
                                    <p class="p col col-10">
                                        Are you sure you want to delete this supplier?
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
<script src="{{ URL::asset('my_js/supplier/all_suppliers.js') }}"></script>
@endpush