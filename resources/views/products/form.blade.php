
<div class="form-group {{ $errors->has('product_types_id') ? 'has-error' : '' }}">
    <label for="product_types_id" class="col-md-2 control-label">Product Types</label>
    <div class="col-md-10">
        <select class="form-control" id="product_types_id" name="product_types_id">
        	    <option value="" style="display: none;" {{ old('product_types_id', optional($product)->product_types_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select product types</option>
        	@foreach ($productTypes as $key => $productType)
			    <option value="{{ $key }}" {{ old('product_types_id', optional($product)->product_types_id) == $key ? 'selected' : '' }}>
			    	{{ $productType }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('product_types_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('categories_id') ? 'has-error' : '' }}">
    <label for="categories_id" class="col-md-2 control-label">Categories</label>
    <div class="col-md-10">
        <select class="form-control" id="categories_id" name="categories_id">
        	    <option value="" style="display: none;" {{ old('categories_id', optional($product)->categories_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select categories</option>
        	@foreach ($categories as $key => $category)
			    <option value="{{ $key }}" {{ old('categories_id', optional($product)->categories_id) == $key ? 'selected' : '' }}>
			    	{{ $category }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('categories_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('brand_name') ? 'has-error' : '' }}">
    <label for="brand_name" class="col-md-2 control-label">Brand Name</label>
    <div class="col-md-10">
        <input class="form-control" name="brand_name" type="text" id="brand_name" value="{{ old('brand_name', optional($product)->brand_name) }}" maxlength="255" placeholder="Enter brand name here...">
        {!! $errors->first('brand_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('product_name') ? 'has-error' : '' }}">
    <label for="product_name" class="col-md-2 control-label">Product Name</label>
    <div class="col-md-10">
        <input class="form-control" name="product_name" type="text" id="product_name" value="{{ old('product_name', optional($product)->product_name) }}" maxlength="255" placeholder="Enter product name here...">
        {!! $errors->first('product_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('segment') ? 'has-error' : '' }}">
    <label for="segment" class="col-md-2 control-label">Segment</label>
    <div class="col-md-10">
        <input class="form-control" name="segment" type="text" id="segment" value="{{ old('segment', optional($product)->segment) }}" maxlength="255" placeholder="Enter segment here...">
        {!! $errors->first('segment', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
    <label for="description" class="col-md-2 control-label">Description</label>
    <div class="col-md-10">
        <textarea class="form-control" name="description" cols="50" rows="10" id="description">{{ old('description', optional($product)->description) }}</textarea>
        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('file') ? 'has-error' : '' }}">
    <label for="file" class="col-md-2 control-label">File</label>
    <div class="col-md-10">
        <div class="input-group uploaded-file-group">
            <label class="input-group-btn">
                <span class="btn btn-default">
                    Browse <input type="file" name="file" id="file" class="hidden">
                </span>
            </label>
            <input type="text" class="form-control uploaded-file-name" readonly>
        </div>

        @if (isset($product->file) && !empty($product->file))
            <div class="input-group input-width-input">
                <span class="input-group-addon">
                    <input type="checkbox" name="custom_delete_file" class="custom-delete-file" value="1" {{ old('custom_delete_file', '0') == '1' ? 'checked' : '' }}> Delete
                </span>

                <span class="input-group-addon custom-delete-file-name">
                    {{ basename($product->file) }}
                </span>
            </div>
        @endif
        {!! $errors->first('file', '<p class="help-block">:message</p>') !!}
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

