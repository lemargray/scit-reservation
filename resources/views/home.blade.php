@extends('layouts.main')

@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="alert alert-success" role="alert">
        Welcome! to SCIT Computer Reeservation System. Only User Management working right now.
    </div>


@endsection
