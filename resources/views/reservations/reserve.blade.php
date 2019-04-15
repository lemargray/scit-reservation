@extends('layouts.main')

@section('scripts')
  <script src='{{asset("/js/reserve-computer.js")}}'></script>
@endsection

@section('content')
<input type="hidden" id="lab-id" value="{{$computer->lab->id}}">
<input type="hidden" id="computer-id" value="{{$computer->id}}">
<input type="hidden" id="csrf" value="{{csrf_token()}}">

<h1>Reserve - {{$computer->name}}</h1>
<div class="row">
<div id='external-events' class="col-md-2 col-sm-12">
  <p>
    <strong>Draggable Events</strong>
  </p>
  @foreach($hours as $hour)
    <div class='fc-event' title="Drag and drop on calendar" style="color:#000; cursor:pointer;padding:5px;margin-bottom:5px;" 
    data-event='{ "title": "{{auth()->user()->name}}", "duration": "{{gmdate("H:i:s", floor($hour->duration * 3600))}}", 
    "description": "{{$hour->duration}}hrs",
    "computer_id": "{{$computer->id}}",
      "constraint": "businessHours" }'>
        <div id="title">{{auth()->user()->name}}</div>
        <div id="description">{{$hour->duration}}hrs</div>
        
    </div>
  @endforeach

</div>

<div id='calendar' class="col-md-10 col-sm-12"></div>

</div>
@endsection
