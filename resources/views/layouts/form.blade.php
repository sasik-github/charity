@extends('layouts.app')

@section('title')
    @yield('title')
@endsection

@section('content')
    @include ('common.errors')
    @yield('form')
@endsection