@extends('layouts.main')

@section('content')
    <div class="card">
        <div class="card-header">Computerhours</div>
        <div class="card-body">
            <a href="{{ url('/computer-hours/create') }}" class="btn btn-success btn-sm" title="Add New ComputerHour">
                <i class="fa fa-plus" aria-hidden="true"></i> Add New
            </a>

            <form method="GET" action="{{ url('/computer-hours') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                            <!-- <th>#</th> -->
                            <th>Duration</th><th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($computerhours as $item)
                        <tr>
                            <!-- <td>{{ $loop->iteration }}</td> -->
                            <td>{{ $item->duration }} hrs</td>
                            <td>
                                <a href="{{ url('/computer-hours/' . $item->id) }}" title="View ComputerHour"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                <a href="{{ url('/computer-hours/' . $item->id . '/edit') }}" title="Edit ComputerHour"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-alt" aria-hidden="true"></i> Edit</button></a>

                                <form method="POST" action="{{ url('/computer-hours' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete ComputerHour" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-alt" aria-hidden="true"></i> Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="pagination-wrapper"> {!! $computerhours->appends(['search' => Request::get('search')])->render() !!} </div>
            </div>

        </div>
    </div>
@endsection
