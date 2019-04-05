@extends('layouts.main')

@section('content')
    <div class="card">
        <div class="card-header">Course {{ $course->id }}</div>
        <div class="card-body">

            <a href="{{ url('/courses') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
            <a href="{{ url('/courses/' . $course->id . '/edit') }}" title="Edit Course"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

            <form method="POST" action="{{ url('courses' . '/' . $course->id) }}" accept-charset="UTF-8" style="display:inline">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger btn-sm" title="Delete Course" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
            </form>
            <br/>
            <br/>

            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>ID</th><td>{{ $course->id }}</td>
                        </tr>
                        <tr><th> Name </th><td> {{ $course->name }} </td></tr><tr><th> Description </th><td> {{ $course->description }} </td></tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
