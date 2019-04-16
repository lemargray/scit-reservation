<div class="form-group {{ $errors->has('duration') ? 'has-error' : ''}}">
    <label for="duration" class="control-label">{{ 'Duration (hrs)' }}</label>
    <input class="form-control" name="duration" type="number" step="0.5" min="0.5" id="duration" value="{{ isset($computerhour->duration) ? $computerhour->duration : ''}}" required>
    {!! $errors->first('duration', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
