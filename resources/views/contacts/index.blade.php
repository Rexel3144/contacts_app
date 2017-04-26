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
        </tr>
    </tfoot>
    <tbody>
        @foreach($contacts as $contact)
        <tr>
            <td>{{$contact->name}}</td>
            <td>{{$contact->phone}}</td>
            <td>{{$contact->email}}</td>
            <td>{{$contact->address}}</td>
            <td>{{$contact->age}}</td>
            <td>{{$contact->company->name}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection