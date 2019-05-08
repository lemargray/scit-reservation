<div class="form-group {{ $errors->has('computer_id') ? 'has-error' : ''}}">
    <label for="computer_id" class="control-label">{{ 'Computer' }}</label>
    <input type="hidden" name="parent_id" value="{{$parent_id}}">
    <select name="computer_id" id="computer_id" class="form-control" required>
    @foreach($computers as $computer)
        <option value="{{$computer->id}}">Lab: &nbsp;&nbsp;{{$computer->lab->name}} &nbsp;&nbsp;&nbsp;&nbsp;--> &nbsp;&nbsp;&nbsp;&nbsp;Computer: &nbsp;&nbsp;{{$computer->name}}</option>    
    @endforeach
    </select>
    <!-- <input class="form-control" name="computer_id" type="number" id="computer_id" value="{{ isset($fault->computer_id) ? $fault->computer_id : ''}}" required> -->
    {!! $errors->first('computer_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    <label for="description" class="control-label">{{ 'Description' }}</label>
    <textarea class="form-control" rows="5" name="description" type="textarea" id="description" required>{{ isset($fault->description) ? $fault->description : ''}}</textarea>
    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    <label for="file">Upload images of the issue</label>
    <input class="form-control" name="upload[]" id="file" type="file" multiple="multiple" accept="image/*" />
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Report Fault' }}">
</div>
