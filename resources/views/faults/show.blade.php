@extends('layouts.main')

@section('content')
    <div class="card">
        <div class="card-header">Fault {{ $fault->id }}</div>
        <div class="card-body">

            <a href="{{ url('/faults') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
            <a href="{{ url('/faults/' . $fault->id . '/edit') }}" title="Edit Fault"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

            <form method="POST" action="{{ url('faults' . '/' . $fault->id) }}" accept-charset="UTF-8" style="display:inline">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger btn-sm" title="Delete Fault" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
            </form>
            <br/>
            <br/>

            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>ID</th><td>{{ $fault->id }}</td>
                        </tr>
                        <tr><th> Computer Id </th><td> {{ $fault->computer_id }} </td></tr><tr><th> Status Id </th><td> {{ $fault->status_id }} </td></tr><tr><th> Logged By </th><td> {{ $fault->logged_by }} </td></tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
