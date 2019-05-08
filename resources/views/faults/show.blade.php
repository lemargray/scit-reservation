@extends('layouts.main')

@section('content')

    <div class="card">
        <div class="card-header">
            Fault #: {{$fault->id}} <a style="margin-left:30px" class="btn btn-info" href="{{route('faults.create', ['parent_id' => $fault->id])}}"><i class="fas fa-plus"></i> Log Followup</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Logged By</th>
                            <th>Logged At</th>
                            <th>Status</th>
                            <th>Actioned By</th>
                            <th>Actioned At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$fault->loggedBy->name}}</td>
                            <td>{{date("d/m/Y h:s a", strtotime($fault->logged_at))}}</td>
                            <td>
                                @if($fault->status->name == 'Open')
                                <span class="badge badge-primary">{{ $fault->status->name }}</span>
                                @endif
                                @if($fault->status->name == 'Resolved')
                                <span class="badge badge-success">{{ $fault->status->name }}</span>
                                @endif
                                @if($fault->status->name == 'Closed')
                                <span class="badge badge-Warning">{{ $fault->status->name }}</span>
                                @endif
                            </td>
                            <td>{{$fault->actionedBy != null ? $fault->actionedBy->name:''}}</td>
                            <td>{{$fault->actioned_at != null? date("d/m/Y h:s a", strtotime($fault->actioned_at)):''}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="docs-galley" style="padding:20px;border:1px solid #eee; margin-top:30px">{{$fault->description}}</div>
            <div class="docs-pictures clearfix" style="padding:20px">
                <div style="margin-top:10px" class="row">
                @foreach($fault->faultImages as $image)
                    <img data-original="{{$image->path}}" style="width: 200px;height:200px;cursor: -webkit-zoom-in;cursor: zoom-in;" src="{{$image->path}}" class="img-thumbnail">
                @endforeach
                </div>
            </div>
            <!-- <div class="docs-galley">
                <ul class="docs-pictures clearfix">
                @foreach($fault->faultImages as $image)
                    <li><img style="width: 200px;height:200px" data-original="{{$image->path}}" src="{{$image->path}}"></li>
                @endforeach
                </ul>
            </div> -->
        </div>
    </div>

    <div class="accordion" id="accordionExample">
    @foreach($fault->notes as $note)
        <div class="card">
            <div class="card-header" id="note-heading-{{$note->id}}">
                <h2 class="mb-0">
                    <button class="btn btn-info collapse-button" type="button" data-toggle="collapse" data-target="#note-{{$note->id}}" aria-expanded="true" aria-controls="note-{{$note->id}}">
                    Following up by: <span style="font-size:16px;font-weight:bold; text-transform:uppercase">{{$note->loggedBy->name}}</span> 
                    <span style="padding:10px; margin-left:20px; text-transform:uppercase">
                        Logged At: {{date("d/m/Y h:s a", strtotime($note->logged_at))}}
                    <span style="margin-right:5px; margin-left:30px">Issue: </span> [ {{str_limit($note->description, 30, '...')}} ]</span>
                    </button>
                </h2>
            </div>

            <div id="note-{{$note->id}}" class="collapse" aria-labelledby="note-heading-{{$note->id}}" data-parent="#accordionExample">
                <div class="card-body">
                    <div class="docs-galley" style="padding:20px;border:1px solid #eee; margin-top:30px">{{$fault->description}}</div>
                        <div class="docs-pictures clearfix" style="padding:20px">
                        <div style="margin-top:10px" class="row">
                        @foreach($note->faultImages as $noteImage)
                            <img data-original="{{$noteImage->path}}" style="width: 200px;height:200px;cursor: -webkit-zoom-in;cursor: zoom-in;" src="{{$noteImage->path}}" class="img-thumbnail">
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    </div>
@endsection
@section('styles')
<link rel="stylesheet" href="https://unpkg.com/viewerjs/dist/viewer.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/imageviewer/1.0.0/viewer.min.css" />
@endsection

@section('scripts')
<!-- <script src="https://fengyuanchen.github.io/js/common.js"></script> -->
<script src="https://unpkg.com/viewerjs/dist/viewer.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/imageviewer/1.0.0/viewer.min.js"></script>
<script>
$(function () {
  'use strict';

  var console = window.console || { log: function () {} };
  var $images = $('.docs-pictures');
  var $toggles = $('.docs-toggles');
  var $buttons = $('.docs-buttons');
  var options = {
    // inline: true,
    url: 'data-original',
    ready: function (e) {
      console.log(e.type);
    },
    show: function (e) {
      console.log(e.type);
    },
    shown: function (e) {
      console.log(e.type);
    },
    hide: function (e) {
      console.log(e.type);
    },
    hidden: function (e) {
      console.log(e.type);
    },
    view: function (e) {
      console.log(e.type);
    },
    viewed: function (e) {
      console.log(e.type);
    }
  };

  function toggleButtons(mode) {
    if (/modal|inline|none/.test(mode)) {
      $buttons
        .find('button[data-enable]')
          .prop('disabled', true)
        .filter('[data-enable*="' + mode + '"]')
          .prop('disabled', false);
    }
  }

  $images.on({
    ready:  function (e) {
      console.log(e.type);
    },
    show:  function (e) {
      console.log(e.type);
    },
    shown:  function (e) {
      console.log(e.type);
    },
    hide:  function (e) {
      console.log(e.type);
    },
    hidden: function (e) {
      console.log(e.type);
    },
    view:  function (e) {
      console.log(e.type);
    },
    viewed: function (e) {
      console.log(e.type);
    }
  }).viewer(options);

  toggleButtons(options.inline ? 'inline' : 'modal');

  $toggles.on('change', 'input', function () {
    var $input = $(this);
    var name = $input.attr('name');

    options[name] = name === 'inline' ? $input.data('value') : $input.prop('checked');
    $images.viewer('destroy').viewer(options);
    toggleButtons(options.inline ? 'inline' : 'modal');
  });

  $buttons.on('click', 'button', function () {
    var data = $(this).data();
    var args = data.arguments || [];

    if (data.method) {
      if (data.target) {
        $images.viewer(data.method, $(data.target).val());
      } else {
        $images.viewer(data.method, args[0], args[1]);
      }

      switch (data.method) {
        case 'scaleX':
        case 'scaleY':
          args[0] = -args[0];
          break;

        case 'destroy':
          toggleButtons('none');
          break;
      }
    }
  });

  $('[data-toggle="tooltip"]').tooltip();
});
</script>
@endsection