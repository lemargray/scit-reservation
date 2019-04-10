@extends('layouts.main')

@section('content')
    <div class="card">
        <div class="card-header">Labs</div>
        <div class="card-body">
            <a href="{{ url('/labs/create') }}" class="btn btn-success btn-sm" title="Add New Lab">
                <i class="fa fa-plus" aria-hidden="true"></i> Add New
            </a>

            <form method="GET" action="{{ url('/labs') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                <table class="table table-mobile">
                    <thead>
                        <tr>
                            <!-- <th>#</th> -->
                            <th>Name</th>
                            <!-- <th>Description</th> -->
                            <th class="hide-mobile">Opening Time</th>
                            <th class="hide-mobile">Closing Time</th>
                            <th class="hide-mobile">Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($labs as $item)
                        <tr>
                            <!-- <td>{{ $loop->iteration }}</td> -->
                            <td>{{ $item->name }}</td>
                            <!-- <td>{{ $item->description }}</td> -->
                            <td class="hide-mobile">{{ date('h:i a', strtotime($item->opening_time)) }}</td>
                            <td class="hide-mobile">{{ date('h:i a', strtotime($item->closing_time)) }}</td>
                            <td class="hide-mobile"><span class="badge badge-{{$item->status->name == 'Active'? 'success':'danger'}}">{{$item->status->name}}</span></td>
                            <td>
                                <a href="{{route('labs.reservations', ['id' => $item->id])}}"><button class="btn btn-primary btn-sm"><i class="fa fa-calendar" aria-hidden="true"></i> <span class="hide-mobile">Schedule</span></button></a>
                                <a href="{{ url('/labs/' . $item->id) }}" title="View Lab"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> <span class="hide-mobile">View</span></button></a>
                                <a href="{{ url('/labs/' . $item->id . '/edit') }}" title="Edit Lab"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-alt" aria-hidden="true"></i> <span class="hide-mobile">Edit</span></button></a>

                                <form method="POST" action="{{ url('/labs' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete Lab" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-alt" aria-hidden="true"></i> <span class="hide-mobile">Delete</span></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="pagination-wrapper"> {!! $labs->appends(['search' => Request::get('search')])->render() !!} </div>
            </div>

        </div>
    </div>
@endsection
