<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Name' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ isset($computer->name) ? $computer->name : ''}}" required>
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    <label for="description" class="control-label">{{ 'Description' }}</label>
    <textarea class="form-control" rows="5" name="description" type="textarea" id="description" required>{{ isset($computer->description) ? $computer->description : ''}}</textarea>
    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('lab_id') ? 'has-error' : ''}}">
    <label for="lab_id" class="control-label">{{ 'Lab' }}</label>
    <select name="lab_id" class="form-control" id="lab_id" required>
    @foreach ($labs as $lab)
        <option value="{{ $lab->id }}" {{ (isset($computer) && $computer->lab_id == $lab->id) ? 'selected' : ''}}>{{ $lab->name }}</option>
    @endforeach
</select>
    {!! $errors->first('lab_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('status_id') ? 'has-error' : ''}}">
    <label for="status_id" class="control-label">{{ 'Status' }}</label>
    <select name="status_id" class="form-control" id="status_id" required>
    @foreach ($statuses as $status)
        <option value="{{ $status->id }}" {{ (isset($computer) && $computer->status_id == $status->id) ? 'selected' : ''}}>{{ $status->name }}</option>
    @endforeach
</select>
    {!! $errors->first('status_id', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
