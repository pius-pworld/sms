
<div class="form-group {{ $errors->has('sku_name') ? 'has-error' : '' }}">
    <label for="sku_name" class="col-md-2 control-label">Sku Name</label>
    <div class="col-md-10">
        <input class="form-control" name="sku_name" type="text" id="sku_name" value="{{ old('sku_name', optional($skue)->sku_name) }}" minlength="1" maxlength="255" required="true" placeholder="Enter sku name here...">
        {!! $errors->first('sku_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('short_name') ? 'has-error' : '' }}">
    <label for="short_name" class="col-md-2 control-label">Short Name</label>
    <div class="col-md-10">
        <input class="form-control" name="short_name" type="text" id="short_name" value="{{ old('short_name', optional($skue)->short_name) }}" maxlength="255" placeholder="Enter short name here...">
        {!! $errors->first('short_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
    <label for="description" class="col-md-2 control-label">Description</label>
    <div class="col-md-10">
        <textarea class="form-control" name="description" cols="50" rows="10" id="description">{{ old('description', optional($skue)->description) }}</textarea>
        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('is_active') ? 'has-error' : '' }}">
    <label for="is_active" class="col-md-2 control-label">Is Active</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label for="is_active_1">
            	<input id="is_active_1" class="" name="is_active" type="checkbox" value="1" {{ old('is_active', optional($skue)->is_active) == '1' ? 'checked' : '' }}>
                Yes
            </label>
        </div>

        {!! $errors->first('is_active', '<p class="help-block">:message</p>') !!}
    </div>
</div>

