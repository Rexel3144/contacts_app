@extends('layouts.app')
@section('content')
    @foreach($contacts as $contact)
        {{$contact->name}} {{$contact->phone}} <br/>
    @endforeach
@endsection