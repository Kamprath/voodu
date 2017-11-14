@extends('layout')

@section('bootstrapped')
    window.bootstrapped = @json($bootstrapped);
@endsection