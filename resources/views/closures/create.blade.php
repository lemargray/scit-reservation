@extends('layouts.main')

@section('content')
    <div class="card">
        <div class="card-header">Create New Closure</div>
        <div class="card-body">
            <a href="{{ url('/closures') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
            <br />
            <br />

            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <form method="POST" action="{{ url('/closures') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}

                @include ('closures.form', ['formMode' => 'create'])

            </form>

        </div>
    </div>
@endsection
