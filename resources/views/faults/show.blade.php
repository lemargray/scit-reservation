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
                            <td>{{$fault->status->name}}</td>
                            <td>{{$fault->actionedBy != null ? $fault->actionedBy->name:''}}</td>
                            <td>{{$fault->actioned_at != null? date("d/m/Y h:s a", strtotime($fault->actioned_at)):''}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div style="padding:20px;border:1px solid #eee; margin-top:30px">{{$fault->description}}</div>
            <div style="padding:20px">
                <div style="margin-top:10px" class="row">
                @foreach($fault->faultImages as $image)
                    <a href="{{$image->path}}" target="_blank"><img style="width: 200px;height:200px" src="{{$image->path}}" class="img-thumbnail mx-auto d-block"></a>
                @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="accordion" id="accordionExample">
    @foreach($fault->notes as $note)
        <div class="card">
            <div class="card-header" id="note-heading-{{$note->id}}">
                <h2 class="mb-0">
                    <button class="btn collapse-button" type="button" data-toggle="collapse" data-target="#note-{{$note->id}}" aria-expanded="true" aria-controls="note-{{$note->id}}">
                    <span style="font-size:16px;font-weight:bold; text-transform:uppercase">{{$note->loggedBy->name}}</span> 
                    <span style="padding:10px; margin-left:20px; text-transform:uppercase">
                        {{date("d/m/Y h:s a", strtotime($note->logged_at))}}
                    <span style="margin-right:5px; margin-left:30px">Issue: </span> [ {{str_limit($note->description, 30, '...')}} ]</span>
                    </button>
                </h2>
            </div>

            <div id="note-{{$note->id}}" class="collapse" aria-labelledby="note-heading-{{$note->id}}" data-parent="#accordionExample">
                <div class="card-body">
                    <div style="padding:20px;border:1px solid #eee; margin-top:30px">{{$note->description}}</div>
                    <div style="padding:20px">
                        <div style="margin-top:10px" class="row">
                        @foreach($note->faultImages as $noteImage)
                            <a href="{{$noteImage->path}}" target="_blank"><img style="width: 200px;height:200px" src="{{$noteImage->path}}" class="img-thumbnail mx-auto d-block"></a>
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    </div>
@endsection
