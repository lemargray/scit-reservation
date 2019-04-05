<div class="form-group {{ $errors->has('start_date') ? 'has-error' : ''}}">
    <label for="start_date" class="control-label">{{ 'Start Date' }}</label>
    <input class="form-control" name="start_date" type="datetime-local" id="start_date" value="{{ isset($labreservation->start_date) ? $labreservation->start_date : ''}}" required>
    {!! $errors->first('start_date', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('end_date') ? 'has-error' : ''}}">
    <label for="end_date" class="control-label">{{ 'End Date' }}</label>
    <input class="form-control" name="end_date" type="datetime-local" id="end_date" value="{{ isset($labreservation->end_date) ? $labreservation->end_date : ''}}" required>
    {!! $errors->first('end_date', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('lab_id') ? 'has-error' : ''}}">
    <label for="lab_id" class="control-label">{{ 'Lab Id' }}</label>
    <input class="form-control" name="lab_id" type="number" id="lab_id" value="{{ isset($labreservation->lab_id) ? $labreservation->lab_id : ''}}" required>
    {!! $errors->first('lab_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('status_id') ? 'has-error' : ''}}">
    <label for="status_id" class="control-label">{{ 'Status Id' }}</label>
    <input class="form-control" name="status_id" type="number" id="status_id" value="{{ isset($labreservation->status_id) ? $labreservation->status_id : ''}}" required>
    {!! $errors->first('status_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('reserved_by') ? 'has-error' : ''}}">
    <label for="reserved_by" class="control-label">{{ 'Reserved By' }}</label>
    <input class="form-control" name="reserved_by" type="number" id="reserved_by" value="{{ isset($labreservation->reserved_by) ? $labreservation->reserved_by : ''}}" required>
    {!! $errors->first('reserved_by', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('reserved_at') ? 'has-error' : ''}}">
    <label for="reserved_at" class="control-label">{{ 'Reserved At' }}</label>
    <input class="form-control" name="reserved_at" type="datetime-local" id="reserved_at" value="{{ isset($labreservation->reserved_at) ? $labreservation->reserved_at : ''}}" required>
    {!! $errors->first('reserved_at', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    <label for="description" class="control-label">{{ 'Description' }}</label>
    <textarea class="form-control" rows="5" name="description" type="textarea" id="description" required>{{ isset($labreservation->description) ? $labreservation->description : ''}}</textarea>
    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('reservable_id') ? 'has-error' : ''}}">
    <label for="reservable_id" class="control-label">{{ 'Reservable Id' }}</label>
    <input class="form-control" name="reservable_id" type="number" id="reservable_id" value="{{ isset($labreservation->reservable_id) ? $labreservation->reservable_id : ''}}" >
    {!! $errors->first('reservable_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('reservable_type') ? 'has-error' : ''}}">
    <label for="reservable_type" class="control-label">{{ 'Reservable Type' }}</label>
    <input class="form-control" name="reservable_type" type="text" id="reservable_type" value="{{ isset($labreservation->reservable_type) ? $labreservation->reservable_type : ''}}" >
    {!! $errors->first('reservable_type', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
