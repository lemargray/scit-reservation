@extends('layouts.main')

@section('content')
    <div class="card">
        <div class="card-header">LabReservation {{ $labreservation->id }}</div>
        <div class="card-body">

            <a href="{{ url('/lab-reservations') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
            <a href="{{ url('/lab-reservations/' . $labreservation->id . '/edit') }}" title="Edit LabReservation"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

            <form method="POST" action="{{ url('labreservations' . '/' . $labreservation->id) }}" accept-charset="UTF-8" style="display:inline">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger btn-sm" title="Delete LabReservation" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
            </form>
            <br/>
            <br/>

            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>ID</th><td>{{ $labreservation->id }}</td>
                        </tr>
                        <tr><th> Start Date </th><td> {{ $labreservation->start_date }} </td></tr><tr><th> End Date </th><td> {{ $labreservation->end_date }} </td></tr><tr><th> Lab Id </th><td> {{ $labreservation->lab_id }} </td></tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
