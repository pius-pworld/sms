
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="col-md-2 control-label">Name</label>
    <div class="col-md-10">
        <input class="form-control" name="name" type="text" id="name" value="{{ old('name', optional($district)->name) }}" maxlength="255" placeholder="Enter name here...">
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('divisions_id') ? 'has-error' : '' }}">
    <label for="divisions_id" class="col-md-2 control-label">Divisions</label>
    <div class="col-md-10">
        <select class="form-control" id="divisions_id" name="divisions_id">
        	    <option value="" style="display: none;" {{ old('divisions_id', optional($district)->divisions_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select divisions</option>
        	@foreach ($divisions as $key => $division)
			    <option value="{{ $key }}" {{ old('divisions_id', optional($district)->divisions_id) == $key ? 'selected' : '' }}>
			    	{{ $division }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('divisions_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
    <label for="description" class="col-md-2 control-label">Description</label>
    <div class="col-md-10">
        <input class="form-control" name="description" type="text" id="description" value="{{ old('description', optional($district)->description) }}" maxlength="1000">
        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('created_by') ? 'has-error' : '' }}">
    <label for="created_by" class="col-md-2 control-label">Created By</label>
    <div class="col-md-10">
        <select class="form-control" id="created_by" name="created_by">
        	    <option value="" style="display: none;" {{ old('created_by', optional($district)->created_by ?: '') == '' ? 'selected' : '' }} disabled selected>Select created by</option>
        	@foreach ($creators as $key => $creator)
			    <option value="{{ $key }}" {{ old('created_by', optional($district)->created_by) == $key ? 'selected' : '' }}>
			    	{{ $creator }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('created_by', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('updated_by') ? 'has-error' : '' }}">
    <label for="updated_by" class="col-md-2 control-label">Updated By</label>
    <div class="col-md-10">
        <select class="form-control" id="updated_by" name="updated_by">
        	    <option value="" style="display: none;" {{ old('updated_by', optional($district)->updated_by ?: '') == '' ? 'selected' : '' }} disabled selected>Select updated by</option>
        	@foreach ($updaters as $key => $updater)
			    <option value="{{ $key }}" {{ old('updated_by', optional($district)->updated_by) == $key ? 'selected' : '' }}>
			    	{{ $updater }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('updated_by', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('is_active') ? 'has-error' : '' }}">
    <label for="is_active" class="col-md-2 control-label">Is Active</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label for="is_active_1">
            	<input id="is_active_1" class="" name="is_active" type="checkbox" value="1" {{ old('is_active', optional($district)->is_active) == '1' ? 'checked' : '' }}>
                Yes
            </label>
        </div>

        {!! $errors->first('is_active', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('countries_id') ? 'has-error' : '' }}">
    <label for="countries_id" class="col-md-2 control-label">Countries</label>
    <div class="col-md-10">
        <select class="form-control" id="countries_id" name="countries_id">
        	    <option value="" style="display: none;" {{ old('countries_id', optional($district)->countries_id ?: '') == '' ? 'selected' : '' }} disabled selected>Enter countries here...</option>
        	@foreach ($countries as $key => $country)
			    <option value="{{ $key }}" {{ old('countries_id', optional($district)->countries_id) == $key ? 'selected' : '' }}>
			    	{{ $country }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('countries_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

