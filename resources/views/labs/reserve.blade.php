@extends('layouts.main')

@section('scripts')
  <script src='{{asset("/js/reserve-lab.js")}}'></script>
@endsection

@section('content')
<input type="hidden" id="lab-id" value="{{$id}}">
<input type="hidden" id="csrf" value="{{csrf_token()}}">

<h1>Reserve Lab</h1>
<div id='calendar'></div>
@endsection
