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
                            <th class="hide-mobile">#</th><th>Computer</th><th class="hide-mobile">Issue</th><th>Status</th><th class="hide-mobile">Logged By</th><th>Logged At</th><th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($faults as $item)
                        @if($item->parent == null)
                        <tr>
                            <td class="hide-mobile">{{ $item->id }}</td>
                            <td>{{ $item->computer->name }}</td><td class="hide-mobile">{{str_limit($item->description, 30,'...')}}</td>
                            <td>
                                @if($item->status->name == 'Open')
                                <span class="badge badge-primary">{{ $item->status->name }}</span>
                                @endif
                                @if($item->status->name == 'Resolved')
                                <span class="badge badge-success">{{ $item->status->name }}</span>
                                @endif
                                @if($item->status->name == 'Closed')
                                <span class="badge badge-warning">{{ $item->status->name }}</span>
                                @endif
                            </td>
                            <td class="hide-mobile">{{ $item->loggedBy->name }}</td><td>{{date("d/m/Y h:s a", strtotime($item->logged_at))}}</td>
                            <td>
                                <a href="{{ url('/faults/' . $item->id) }}" title="View Fault"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                <!-- <a href="{{ url('/faults/' . $item->id . '/edit') }}" title="Edit Fault"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-alt" aria-hidden="true"></i> Edit</button></a> -->
                                @if($item->status->name == 'Open' && auth()->user()->role->name == 'admin')
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
            </div>
            
            <div class="pagination-wrapper"> {!! $faults->appends(['search' => Request::get('search')])->render() !!} </div>
        </div>
    </div>
@endsection
