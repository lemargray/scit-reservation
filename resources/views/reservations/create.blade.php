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

            <div id="lab-{{$lab->id}}" class="collapse" aria-labelledby="lab-heading-{{$lab->id}}"" data-parent="#accordionExample">
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
@endsection