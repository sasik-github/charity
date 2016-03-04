@extends('layouts.app')

@section('content')

    <div class="row">
        <table class="table table-stripped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Имя</th>
                    <th>Телефон</th>
                    <th>Балы</th>
                    <th>День рождения</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @foreach($volunteers as $volunteer)
                <tr>
                    <th>{{ $volunteer->id }}</th>
                    <td>{{ $volunteer->name }}</td>
                    <td>{{ $volunteer->telephone}}</td>
                    <td>{{ $volunteer->points }}</td>
                    <td>{{ $volunteer->birthday }}</td>
                    <td>{{ $volunteer->birthday }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>

    <div class="row text-center">
        <div class="">
            {!! $volunteers->links() !!}
        </div>
    </div>

@endsection