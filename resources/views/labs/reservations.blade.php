@extends('layouts.main')
@section('scripts')
  <script src='{{asset("/js/my-calendar.js")}}'></script>
@endsection

@section('styles')
<style>
  .fc-event{
    background-color: #ffdada !important;
    border: 1px solid #ffc8c8;
  }
</style>
@endsection

@section('content')
<input type="hidden" id="lab-id" value="{{$lab->id}}">
<h1>{{$lab->name}} Schedule <a href="{{route('reserve.lab', $lab->id)}}"><i style="color:#5b6fb9;cursor:pointer" class="far fa-edit" title="Modify schedule"></i></a></h1>
<div id='calendar'></div>
@endsection
