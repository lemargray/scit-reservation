<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Name' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ isset($course->name) ? $course->name : ''}}" required>
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    <label for="description" class="control-label">{{ 'Description' }}</label>
    <textarea class="form-control" rows="5" name="description" type="textarea" id="description" required>{{ isset($course->description) ? $course->description : ''}}</textarea>
    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('duration') ? 'has-error' : ''}}">
    <label for="duration" class="control-label">{{ 'Duration (hrs)' }}</label>
    <input class="form-control" name="duration" type="number" min="0" step="1" id="duration" value="{{ isset($course->duration) ? $course->duration : ''}}" required>
    {!! $errors->first('duration', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('weeks') ? 'has-error' : ''}}">
    <label for="weeks" class="control-label">{{ 'Duration of semester in weeks' }}</label>
    <input class="form-control" name="weeks" type="number" min="0" max="15" step="1" id="weeks" value="{{ isset($course->weeks) ? $course->weeks : ''}}" required>
    {!! $errors->first('weeks', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
