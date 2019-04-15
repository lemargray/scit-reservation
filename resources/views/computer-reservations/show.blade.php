@extends('layouts.main')

@section('content')
    <div class="card">
        <div class="card-header">ComputerReservation {{ $computerreservation->id }}</div>
        <div class="card-body">

            <a href="{{ url('/computer-reservations') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
            <a href="{{ url('/computer-reservations/' . $computerreservation->id . '/edit') }}" title="Edit ComputerReservation"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

            <form method="POST" action="{{ url('computerreservations' . '/' . $computerreservation->id) }}" accept-charset="UTF-8" style="display:inline">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger btn-sm" title="Delete ComputerReservation" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
            </form>
            <br/>
            <br/>

            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>ID</th><td>{{ $computerreservation->id }}</td>
                        </tr>
                        <tr><th> Start Date </th><td> {{ $computerreservation->start_date }} </td></tr><tr><th> End Date </th><td> {{ $computerreservation->end_date }} </td></tr><tr><th> Computer Id </th><td> {{ $computerreservation->computer_id }} </td></tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
