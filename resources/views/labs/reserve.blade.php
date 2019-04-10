@extends('layouts.main')

@section('scripts')
  <script src='{{asset("/js/reserve-lab.js")}}'></script>
@endsection

@section('content')
<input type="hidden" id="lab-id" value="{{$id}}">
<input type="hidden" id="csrf" value="{{csrf_token()}}">

<h1>Reserve Lab</h1>
<div class="row">
<div id='external-events' class="col-md-2">
  <p>
    <strong>Draggable Events</strong>
  </p>
  @foreach($courses as $course)
    <div class='fc-event' style="color:#000; cursor:pointer;padding:5px;margin-bottom:5px;" 
    data-event='{ "title": "{{$course->name}}", "duration": "05:00", "description": "{{$course->description}}" }'>
        <div id="title">{{$course->name}}</div>
        <div id="description">{{$course->description}}</div>
        
    </div>
  @endforeach
</div>

<div id='calendar' class="col-sm-10"></div>

</div>
@endsection
