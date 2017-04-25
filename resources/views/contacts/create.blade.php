@extends('layouts.app')
@section('content')
<form method="POST" action="{{route('contact.store')}}">
    {{csrf_field()}}
    Name<input type="text" name="name"><br/>
    Company<input type="text" name="company"><br/>
    Phone<input type="text" name="phone"><br/>
    <input type="submit">
</form>
@endsection
