@extends('layouts.main')

@section('styles')
<style>
    .collapse-button:hover{
        background-color: #e7f4ff !important;
    }

    .collapse-button{
        color: #488ee0 !important;
        background-color: #f6f6f6;
    }
</style>
@endsection



@section('content')
    <!-- <div class="alert alert-success">
        Not yet implemented.
    </div> -->

    <h3>Reserve a computer</h3>
    <br>

    <div class="card">
        <div class="card-header">
            Search for available computers
        </div>
        <div class="card-body">
            <h5 class="card-title">Enter the date, time and lab you want to reserve a computer</h5>
            <form action="{{route('computers-available')}}">
                <div class="form-group">
                    <label for="start_time">Start time</label>
                    <input type="text" value="{{old('start_time')}}" required class="form-control datetimepicker-input" name="start_time" id="start_time" data-toggle="datetimepicker" data-target="#start_time">
                </div>
                <div class="form-group">
                    <label for="end_time">end time</label>
                    <input type="text" value="{{old('end_time')}}" required class="form-control datetimepicker-input" name="end_time" id="end_time"  data-toggle="datetimepicker" data-target="#end_time">
                </div>
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="text" value="{{old('date')}}" required class="form-control datetimepicker-input" name="date" id="date"  data-toggle="datetimepicker" data-target="#date">
                </div>
                <button class="btn btn-info">Search</button>
            </form>
        </div>
    </div>

    <div class="accordion" id="accordionExample">
    @foreach($labs as $lab)
        <div class="card">
            <div class="card-header" id="lab-heading-{{$lab->id}}">
                <h2 class="mb-0">
                    <button class="btn collapse-button" type="button" data-toggle="collapse" data-target="#lab-{{$lab->id}}" aria-expanded="true" aria-controls="lab-{{$lab->id}}">
                   <span style="font-size:16px;font-weight:bold; text-transform:uppercase">{{$lab->name}}</span> <span style="padding:10px; margin-left:20px; text-transform:uppercase" class="badge badge-pill badge-primary"><i class="fas fa-desktop" style="margin-right:10px"></i>  <span style="margin-right:5px">Computers</span> [ {{count($lab->computers)}} ]</span>
                    </button>
                </h2>
            </div>

            <div id="lab-{{$lab->id}}" class="collapse" aria-labelledby="lab-heading-{{$lab->id}}" data-parent="#accordionExample">
                <div class="card-body">
                    <h5>Computers</h5>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th><th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($lab->computers as $computer)
                                <tr>
                                    <td>{{$computer->name}}</td>
                                    <td>
                                        <a href="{{route('reserve.computer', $computer->id)}}" class="btn btn-info"><i class="far fa-calendar-plus"></i> <span>Schedule</span></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    </div>
    <script type="text/javascript">
    $(function () {
        $('#date').datetimepicker({format: "L", useCurrent: true});
        $('#start_time').datetimepicker({format: "LT"});
        $('#end_time').datetimepicker({format: "LT", useCurrent: false});
        // $("#start_time").on("change.datetimepicker", function (e) {
        //     $('#end_time').datetimepicker('minDate', e.date);
        // });
        // $("#end_time").on("change.datetimepicker", function (e) {
        //     $('#start_time').datetimepicker('maxDate', e.date);
        // });
    });
</script>
@endsection