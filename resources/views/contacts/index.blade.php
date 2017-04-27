@extends('layouts.app')
@section('css')
<link href="{{ asset('css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
@endsection
@section('js')
<script src="{{ asset('js/jquery-1.12.4.js') }}"></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('js/contacts.js') }}"></script>
@endsection
@section('content')
<table id="contacts" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Address</th>
            <th>Age</th>
            <th>Company</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Address</th>
            <th>Age</th>
            <th>Company</th>
            <th>Actions</th>
        </tr>
    </tfoot>
    <tbody>
        @foreach($contacts as $contact)
        <tr data-contact-id="{{$contact->id}}">
            <td data-source="name">
                <div class="col-md-10 value">{{$contact->name}}</div>
                <div class="col-md-2 text-right actions">
                    @can('update',$contact)
                    <span class="glyphicon glyphicon-edit edit"></span>
                    <!--<span class="glyphicon glyphicon-remove remove"></span>-->
                    @endcan
                </div>
            </td>
            <td data-source="phone">
                <div class="col-md-10 value">{{$contact->phone}}</div>
                <div class="col-md-2 text-right actions">
                    @can('update',$contact)
                    <span class="glyphicon glyphicon-edit edit"></span>
                    <!--<span class="glyphicon glyphicon-remove remove"></span>-->
                    @endcan
                </div>
            </td>
            <td data-source="email">
                <div class="col-md-10 value">{{$contact->email}}</div>
                <div class="col-md-2 text-right actions">
                    @can('update',$contact)
                    <span class="glyphicon glyphicon-edit edit"></span>
                    <span class="glyphicon glyphicon-remove remove"></span>
                    @endcan
                </div>
            </td>
            <td data-source="address">
                <div class="col-md-10 value">{{$contact->address}}</div>
                <div class="col-md-2 text-right actions">
                    @can('update',$contact)
                    <span class="glyphicon glyphicon-edit edit"></span>
                    <span class="glyphicon glyphicon-remove remove"></span>
                    @endcan
                </div>
            </td>
            <td data-source="age">
                <div class="col-md-10 value">{{$contact->age}}</div>
                <div class="col-md-2 text-right actions">
                    <!--<span class="glyphicon glyphicon-edit edit"></span>-->
                    <!--<span class="glyphicon glyphicon-remove remove"></span>-->
                </div>
            </td>
            <td data-source="company_name">
                <div class="col-md-10 value">{{$contact->company?$contact->company->name:''}}</div>
                <div class="col-md-2 text-right actions">
                    @can('update',$contact)
                    <span class="glyphicon glyphicon-edit edit"></span>
                    <span class="glyphicon glyphicon-remove remove"></span>
                    @endcan
                </div>
            </td>
            <td class="actions-global text-center">
                <a href='/export/vCard/{{$contact->id}}'>
                    <span class="glyphicon glyphicon-export export"></span>
                </a>
                @can('delete',$contact)
                <span class="glyphicon glyphicon-trash delete"></span>
                @endcan
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection