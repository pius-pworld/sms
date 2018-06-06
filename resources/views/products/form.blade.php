
<div class="form-group {{ $errors->has('key_word') ? 'has-error' : '' }}">
    <label for="key_word" class="col-md-2 control-label">Key Word</label>
    <div class="col-md-10">
        <input class="form-control" name="key_word" type="text" id="key_word" value="{{ old('key_word', optional($product)->key_word) }}" maxlength="255" placeholder="Enter key word here...">
        {!! $errors->first('key_word', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('brands_id') ? 'has-error' : '' }}">
    <label for="brands_id" class="col-md-2 control-label">Brands</label>
    <div class="col-md-10">
        <select class="form-control" id="brands_id" name="brands_id" required="true">
        	    <option value="" style="display: none;" {{ old('brands_id', optional($product)->brands_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select brands</option>
        	@foreach ($brands as $key => $brand)
			    <option value="{{ $key }}" {{ old('brands_id', optional($product)->brands_id) == $key ? 'selected' : '' }}>
			    	{{ $brand }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('brands_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('skues_id') ? 'has-error' : '' }}">
    <label for="skues_id" class="col-md-2 control-label">Skues</label>
    <div class="col-md-10">
        <select class="form-control" id="skues_id" name="skues_id" required="true">
        	    <option value="" style="display: none;" {{ old('skues_id', optional($product)->skues_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select skues</option>
        	@foreach ($skues as $key => $skue)
			    <option value="{{ $key }}" {{ old('skues_id', optional($product)->skues_id) == $key ? 'selected' : '' }}>
			    	{{ $skue }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('skues_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
    <label for="price" class="col-md-2 control-label">Price</label>
    <div class="col-md-10">
        <input class="form-control" name="price" type="number" id="price" value="{{ old('price', optional($product)->price) }}" min="-999999999" max="999999999" placeholder="Enter price here..." step="any">
        {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('quantity') ? 'has-error' : '' }}">
    <label for="quantity" class="col-md-2 control-label">Quantity</label>
    <div class="col-md-10">
        <input class="form-control" name="quantity" type="number" id="quantity" value="{{ old('quantity', optional($product)->quantity) }}" min="-999999999" max="999999999" placeholder="Enter quantity here...">
        {!! $errors->first('quantity', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
    <label for="description" class="col-md-2 control-label">Description</label>
    <div class="col-md-10">
        <textarea class="form-control" name="description" cols="50" rows="10" id="description">{{ old('description', optional($product)->description) }}</textarea>
        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('is_active') ? 'has-error' : '' }}">
    <label for="is_active" class="col-md-2 control-label">Is Active</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label for="is_active_1">
            	<input id="is_active_1" class="" name="is_active" type="checkbox" value="1" {{ old('is_active', optional($product)->is_active) == '1' ? 'checked' : '' }}>
                Yes
            </label>
        </div>

        {!! $errors->first('is_active', '<p class="help-block">:message</p>') !!}
    </div>
</div>

