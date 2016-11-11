@extends('layouts.dt')
@section('title', 'Masterfiles')
@section('widget-title', 'Manage Masterfiles')
@section('widget-desc', 'All Masterfiles')

@section('breadcrumb')
    <li><a href="{{ url('/') }}"> Home</a></li>
    <li>MasterFiles</li>
    <li>All Masterfiles</li>
@endsection

@section('button')
    <ul class="list-inline list-unstyled pull-right">
    <li>
    <a data-toggle="modal" href="#edit-route" id="edit-masterfile-btn" class="btn btn-warning btn-sm header-btn  pull-right ">
        <i class="fa fa-edit"></i> Edit masterfile
    </a>
    </li>
        <li>
            <a data-toggle="modal" href="#edit-route" id="edit-route-btn" class="btn btn-danger btn-sm header-btn pull-right ">
                <i class="fa fa-edit"></i> Delete masterfile
            </a>
        </li>
    </ul>
    @endsection

@section('content')
    @include('layouts.includes._messages')
    <table id="masterfiles" class="table table-striped table-bordered table-hover " width="100%">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>ID no</th>
            <th>Business Role</th>
            <th>Phone Number</th>
            <th>Email Address</th>
            <th>Physical Addres</th>
            <th>City</th>
            <th>Postal Address</th>
        </tr>
        </thead>
        <tbody>
            @if(count($all_masterfiles))
                @foreach($all_masterfiles as $masterfile)
                    <?php $contact = \App\Contact::where('masterfile_id',$masterfile->id)->first(); ?>
                    <tr>
                        <th>{{ $masterfile->id }}</th>
                        <th>{{ $masterfile->sirname.' '.$masterfile->firstname.' '.$masterfile->middlename }}</th>
                        <th>{{ $masterfile->id_no }}</th>
                        <th>{{ $masterfile->user_role }}</th>
                        <th>{{ (!empty($contact->phone_number))? $contact->phone_number:''  }}</th>
                        <th>{{ (!empty($contact->email))? $contact->email:''  }}</th>
                        <th>{{ (!empty($contact->physical_address))? $contact->physical_address:''  }}</th>
                        <th>{{ (!empty($contact->city))? $contact->city:''  }}</th>
                        <th>{{ (!empty($contact->postal_address))? $contact->postal_address:''  }}</th>
                    </tr>
                    @endforeach
                @endif
        </tbody>
    </table>
@endsection
@push('js')
<script src="{{ URL::asset('my_js/masterfile/all_masterfiles.js') }}"></script>
@endpush

