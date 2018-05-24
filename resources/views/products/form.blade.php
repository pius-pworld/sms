
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="col-md-2 control-label">Name</label>
    <div class="col-md-10">
        <input class="form-control" name="name" type="text" id="name" value="{{ old('name', optional($product)->name) }}" minlength="1" maxlength="25" placeholder="Enter name here...">
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('product_brands_id') ? 'has-error' : '' }}">
    <label for="product_brands_id" class="col-md-2 control-label">Product Brands</label>
    <div class="col-md-10">
        <select class="form-control" id="product_brands_id" name="product_brands_id">
        	    <option value="" style="display: none;" {{ old('product_brands_id', optional($product)->product_brands_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select product brands</option>
        	@foreach ($productBrands as $key => $productBrand)
			    <option value="{{ $key }}" {{ old('product_brands_id', optional($product)->product_brands_id) == $key ? 'selected' : '' }}>
			    	{{ $productBrand }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('product_brands_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('product_categories_id') ? 'has-error' : '' }}">
    <label for="product_categories_id" class="col-md-2 control-label">Product Categories</label>
    <div class="col-md-10">
        <select class="form-control" id="product_categories_id" name="product_categories_id">
        	    <option value="" style="display: none;" {{ old('product_categories_id', optional($product)->product_categories_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select product categories</option>
        	@foreach ($productCategories as $key => $productCategory)
			    <option value="{{ $key }}" {{ old('product_categories_id', optional($product)->product_categories_id) == $key ? 'selected' : '' }}>
			    	{{ $productCategory }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('product_categories_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
    <label for="description" class="col-md-2 control-label">Description</label>
    <div class="col-md-10">
        <textarea class="form-control" name="description" cols="50" rows="10" id="description" minlength="1" maxlength="1000">{{ old('description', optional($product)->description) }}</textarea>
        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
    <label for="image" class="col-md-2 control-label">Image</label>
    <div class="col-md-10">
        <input class="form-control" name="image" type="number" id="image" value="{{ old('image', optional($product)->image) }}" placeholder="Enter image here...">
        {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('created_by') ? 'has-error' : '' }}">
    <label for="created_by" class="col-md-2 control-label">Created By</label>
    <div class="col-md-10">
        <select class="form-control" id="created_by" name="created_by">
        	    <option value="" style="display: none;" {{ old('created_by', optional($product)->created_by ?: '') == '' ? 'selected' : '' }} disabled selected>Select created by</option>
        	@foreach ($creators as $key => $creator)
			    <option value="{{ $key }}" {{ old('created_by', optional($product)->created_by) == $key ? 'selected' : '' }}>
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
        	    <option value="" style="display: none;" {{ old('updated_by', optional($product)->updated_by ?: '') == '' ? 'selected' : '' }} disabled selected>Select updated by</option>
        	@foreach ($updaters as $key => $updater)
			    <option value="{{ $key }}" {{ old('updated_by', optional($product)->updated_by) == $key ? 'selected' : '' }}>
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
            	<input id="is_active_1" class="" name="is_active" type="checkbox" value="1" {{ old('is_active', optional($product)->is_active) == '1' ? 'checked' : '' }}>
                Yes
            </label>
        </div>

        {!! $errors->first('is_active', '<p class="help-block">:message</p>') !!}
    </div>
</div>

