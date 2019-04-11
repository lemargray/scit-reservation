@extends('layouts.main')

@section('scripts')
  <script src='{{asset("/js/reserve-lab.js")}}'></script>
@endsection

@section('content')
<input type="hidden" id="lab-id" value="{{$lab->id}}">
<input type="hidden" id="csrf" value="{{csrf_token()}}">

<h1>Reserve - {{$lab->name}}</h1>
<div class="row">
<div id='external-events' class="col-md-2">
  <p>
    <strong>Draggable Events</strong>
  </p>
  @foreach($courses as $course)
    <div class='fc-event' title="Drag and drop on calendar" style="color:#000; cursor:pointer;padding:5px;margin-bottom:5px;" 
    data-event='{ "title": "{{$course->name}}", "duration": "{{gmdate("H:i:s", floor($course->duration * 3600))}}", 
    "description": "{{$course->description}}", 
      "reservable_id": {{$course->id}},
      "reservable_type": "App\\Course",
      "lab_id": {{$lab->id}} }'>
        <div id="title">{{$course->name}}</div>
        <div id="description">{{$course->description}} - {{(float)$course->duration}}hrs</div>
        
    </div>
  @endforeach

  @foreach($closures as $closure)
    <div class='fc-event'  title="Drag and drop on calendar" style="color:#000; cursor:pointer;padding:5px;margin-bottom:5px;" 
    data-event='{ "title": "{{$closure->name}}", "duration": "{{gmdate("H:i:s", floor($closure->duration * 3600))}}", 
    "description": "{{$closure->description}}", 
      "reservable_id": {{$closure->id}},
      "reservable_type": "App\\closure",
      "lab_id": {{$lab->id}} }'>
        <div id="title">{{$closure->name}}</div>
        <div id="description">{{$closure->description}} - {{(float)$closure->duration}}hrs</div>
        
    </div>
  @endforeach
</div>

<div id='calendar' class="col-sm-10"></div>

</div>
@endsection
