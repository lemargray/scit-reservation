@extends('layouts.main')

@section('content')
    <div class="card">
        <div class="card-header">Labreservations</div>
        <div class="card-body">
            <a href="{{ url('/lab-reservations/create') }}" class="btn btn-success btn-sm" title="Add New LabReservation">
                <i class="fa fa-plus" aria-hidden="true"></i> Add New
            </a>

            <form method="GET" action="{{ url('/lab-reservations') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                    <span class="input-group-append">
                        <button class="btn btn-secondary" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </form>

            <br/>
            <br/>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th><th>Start Date</th><th>End Date</th><th>Lab Id</th><th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($labreservations as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->start_date }}</td><td>{{ $item->end_date }}</td><td>{{ $item->lab_id }}</td>
                            <td>
                                <a href="{{ url('/lab-reservations/' . $item->id) }}" title="View LabReservation"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                <a href="{{ url('/lab-reservations/' . $item->id . '/edit') }}" title="Edit LabReservation"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-alt" aria-hidden="true"></i> Edit</button></a>

                                <form method="POST" action="{{ url('/lab-reservations' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete LabReservation" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-alt" aria-hidden="true"></i> Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="pagination-wrapper"> {!! $labreservations->appends(['search' => Request::get('search')])->render() !!} </div>
            </div>

        </div>
    </div>
@endsection
