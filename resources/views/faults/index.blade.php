@extends('layouts.main')

@section('content')
    <div class="card">
        <div class="card-header">Faults</div>
        <div class="card-body">
            <a href="{{ url('/faults/create') }}" class="btn btn-success btn-sm" title="Add New Fault">
                <i class="fa fa-plus" aria-hidden="true"></i> Add New
            </a>

            <form method="GET" action="{{ url('/faults') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                            <th>#</th><th>Computer</th><th>Issue</th><th>Status</th><th>Logged By</th><th>Logged At</th><th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($faults as $item)
                        @if($item->parent == null)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->computer->name }}</td><td>{{str_limit($item->description, 30,'...')}}</td><td>{{ $item->status->name }}</td><td>{{ $item->loggedBy->name }}</td><td>{{date("d/m/Y h:s a", strtotime($item->logged_at))}}</td>
                            <td>
                                <a href="{{ url('/faults/' . $item->id) }}" title="View Fault"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                <!-- <a href="{{ url('/faults/' . $item->id . '/edit') }}" title="Edit Fault"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-alt" aria-hidden="true"></i> Edit</button></a> -->
                                @if($item->status->name == 'Open')
                                <form method="POST" action="{{ url('/faults' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete Fault" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-alt" aria-hidden="true"></i> Close Report</button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
                <div class="pagination-wrapper"> {!! $faults->appends(['search' => Request::get('search')])->render() !!} </div>
            </div>

        </div>
    </div>
@endsection
