<div class="form-group {{ $errors->has('start_date') ? 'has-error' : ''}}">
    <label for="start_date" class="control-label">{{ 'Start Date' }}</label>
    <input class="form-control" name="start_date" type="datetime-local" id="start_date" value="{{ isset($computerreservation->start_date) ? $computerreservation->start_date : ''}}" required>
    {!! $errors->first('start_date', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('end_date') ? 'has-error' : ''}}">
    <label for="end_date" class="control-label">{{ 'End Date' }}</label>
    <input class="form-control" name="end_date" type="datetime-local" id="end_date" value="{{ isset($computerreservation->end_date) ? $computerreservation->end_date : ''}}" required>
    {!! $errors->first('end_date', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('computer_id') ? 'has-error' : ''}}">
    <label for="computer_id" class="control-label">{{ 'Computer Id' }}</label>
    <input class="form-control" name="computer_id" type="number" id="computer_id" value="{{ isset($computerreservation->computer_id) ? $computerreservation->computer_id : ''}}" required>
    {!! $errors->first('computer_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('status_id') ? 'has-error' : ''}}">
    <label for="status_id" class="control-label">{{ 'Status Id' }}</label>
    <input class="form-control" name="status_id" type="number" id="status_id" value="{{ isset($computerreservation->status_id) ? $computerreservation->status_id : ''}}" required>
    {!! $errors->first('status_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('reserved_by') ? 'has-error' : ''}}">
    <label for="reserved_by" class="control-label">{{ 'Reserved By' }}</label>
    <input class="form-control" name="reserved_by" type="number" id="reserved_by" value="{{ isset($computerreservation->reserved_by) ? $computerreservation->reserved_by : ''}}" required>
    {!! $errors->first('reserved_by', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('reserved_at') ? 'has-error' : ''}}">
    <label for="reserved_at" class="control-label">{{ 'Reserved At' }}</label>
    <input class="form-control" name="reserved_at" type="datetime-local" id="reserved_at" value="{{ isset($computerreservation->reserved_at) ? $computerreservation->reserved_at : ''}}" required>
    {!! $errors->first('reserved_at', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    <label for="description" class="control-label">{{ 'Description' }}</label>
    <textarea class="form-control" rows="5" name="description" type="textarea" id="description" required>{{ isset($computerreservation->description) ? $computerreservation->description : ''}}</textarea>
    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
