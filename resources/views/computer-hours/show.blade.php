@extends('layouts.main')

@section('content')
    <div class="card">
        <div class="card-header">ComputerHour {{ $computerhour->id }}</div>
        <div class="card-body">

            <a href="{{ url('/computer-hours') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
            <a href="{{ url('/computer-hours/' . $computerhour->id . '/edit') }}" title="Edit ComputerHour"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

            <form method="POST" action="{{ url('computerhours' . '/' . $computerhour->id) }}" accept-charset="UTF-8" style="display:inline">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger btn-sm" title="Delete ComputerHour" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
            </form>
            <br/>
            <br/>

            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <!-- <th>ID</th> -->
                            <td>{{ $computerhour->id }}</td>
                        </tr>
                        <tr><th> Duration </th><td> {{ $computerhour->duration }} </td></tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
