@extends('layouts.main')
@section('scripts')
  <script src='{{asset("/js/my-calendar.js")}}'></script>
@endsection;

@section('content')
<input type="hidden" id="lab-id" value="{{$id}}">
<h1>Lab A Schedule</h1>
<div id='calendar'></div>
@endsection
