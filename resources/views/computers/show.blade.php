@extends('layouts.main')

@section('content')
    <div class="card">
        <div class="card-header">Computer {{ $computer->id }}</div>
        <div class="card-body">

            <a href="{{ url('/computers') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
            <a href="{{ url('/computers/' . $computer->id . '/edit') }}" title="Edit Computer"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

            <form method="POST" action="{{ url('computers' . '/' . $computer->id) }}" accept-charset="UTF-8" style="display:inline">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger btn-sm" title="Delete Computer" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
            </form>
            <br/>
            <br/>

            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>ID</th><td>{{ $computer->id }}</td>
                        </tr>
                        <tr><th> Name </th><td> {{ $computer->name }} </td></tr><tr><th> Description </th><td> {{ $computer->description }} </td></tr><tr><th> Lab Id </th><td> {{ $computer->lab_id }} </td></tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
