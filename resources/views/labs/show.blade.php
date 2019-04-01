@extends('layouts.main')

@section('content')
    <div class="card">
        <div class="card-header">Lab {{ $lab->id }}</div>
        <div class="card-body">

            <a href="{{ url('/labs') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
            <a href="{{ url('/labs/' . $lab->id . '/edit') }}" title="Edit Lab"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

            <form method="POST" action="{{ url('labs' . '/' . $lab->id) }}" accept-charset="UTF-8" style="display:inline">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger btn-sm" title="Delete Lab" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
            </form>
            <br/>
            <br/>

            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>ID</th><td>{{ $lab->id }}</td>
                        </tr>
                        <tr><th> Name </th><td> {{ $lab->name }} </td></tr>
                        <tr><th> Description </th><td> {{ $lab->description }} </td></tr>
                        <tr><th> Opening Time </th><td> {{ date('h:i a', strtotime($lab->opening_time)) }} </td></tr>
                        <tr><th> Closing Time </th><td> {{ date('h:i a', strtotime($lab->closing_time)) }} </td></tr>
                        <tr>
                            <th>Status</th>
                            <td><span class="badge badge-{{$lab->status->name == 'Active'? 'success':'danger'}}">{{$lab->status->name}}</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
