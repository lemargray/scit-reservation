@extends('layouts.main')

@section('content')
    <div class="card">
        <div class="card-header">Closure {{ $closure->id }}</div>
        <div class="card-body">

            <a href="{{ url('/closures') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
            <a href="{{ url('/closures/' . $closure->id . '/edit') }}" title="Edit Closure"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

            <form method="POST" action="{{ url('closures' . '/' . $closure->id) }}" accept-charset="UTF-8" style="display:inline">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger btn-sm" title="Delete Closure" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
            </form>
            <br/>
            <br/>

            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>ID</th><td>{{ $closure->id }}</td>
                        </tr>
                        <tr><th> Name </th><td> {{ $closure->name }} </td></tr><tr><th> Description </th><td> {{ $closure->description }} </td></tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
