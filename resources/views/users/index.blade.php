@extends('layouts.master')

@section('content')
<user-component url='{{url('users')}}' csrf='{!! csrf_field('POST') !!}'></user-component>
@endsection
