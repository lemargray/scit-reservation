<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Name' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ isset($lab->name) ? $lab->name : ''}}" required>
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    <label for="description" class="control-label">{{ 'Description' }}</label>
    <input class="form-control" name="description" type="text" id="description" value="{{ isset($lab->description) ? $lab->description : ''}}" >
    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('opening_time') ? 'has-error' : ''}}">
    <label for="opening_time" class="control-label">{{ 'Opening Time' }}</label>
    <input class="form-control" name="opening_time" type="time" id="opening_time" value="{{ isset($lab->opening_time) ? $lab->opening_time : ''}}" required>
    {!! $errors->first('opening_time', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('closing_time') ? 'has-error' : ''}}">
    <label for="closing_time" class="control-label">{{ 'Closing Time' }}</label>
    <input class="form-control" name="closing_time" type="time" id="closing_time" value="{{ isset($lab->closing_time) ? $lab->closing_time : ''}}" required>
    {!! $errors->first('closing_time', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('status_id') ? 'has-error' : ''}}">
    <label for="status_id" class="control-label">{{ 'Status' }}</label>
    <select name="status_id" class="form-control" id="status_id" required>    
        @foreach ($statuses as $status)
            <option value="{{ $status->id }}" {{ (isset($lab->status_id) && $lab->status_id == $status->id) ? 'selected' : ''}}>{{ $status->name }}</option>
        @endforeach
    </select>
    {!! $errors->first('status_id', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
