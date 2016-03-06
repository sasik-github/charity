@extends('layouts.app')

@section('title')
@endsection

@section('content')

    <h2>{{ $volunteer->id }}</h2>
    <p>{{ $volunteer->name }}</p>
    <p>{{ $volunteer->telephone}}</p>
    <p>{{ $volunteer->points }}</p>
    <p>{{ $volunteer->birthday }}</p>
    <p>{{ $volunteer->birthday }}</p>

@endsection
