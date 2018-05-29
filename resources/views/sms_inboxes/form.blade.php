
<div class="form-group {{ $errors->has('sender') ? 'has-error' : '' }}">
    <label for="sender" class="col-md-2 control-label">Sender</label>
    <div class="col-md-10">
        <input class="form-control" name="sender" type="text" id="sender" value="{{ old('sender', optional($smsInbox)->sender) }}" minlength="1" maxlength="15" required="true" placeholder="Enter sender here...">
        {!! $errors->first('sender', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('sms_content') ? 'has-error' : '' }}">
    <label for="sms_content" class="col-md-2 control-label">Sms Content</label>
    <div class="col-md-10">
        <textarea class="form-control" name="sms_content" cols="50" rows="10" id="sms_content" required="true" placeholder="Enter sms content here...">{{ old('sms_content', optional($smsInbox)->sms_content) }}</textarea>
        {!! $errors->first('sms_content', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
    <label for="status" class="col-md-2 control-label">Status</label>
    <div class="col-md-10">
        <select class="form-control" id="status" name="status">
        	    <option value="" style="display: none;" {{ old('status', optional($smsInbox)->status ?: '') == '' ? 'selected' : '' }} disabled selected>Enter status here...</option>
        	@foreach (['Active' => 'Active',
'Inactive' => 'Inactive',
'Pending' => 'Pending',
'Replied' => 'Replied',
'Unread' => 'Unread'] as $key => $text)
			    <option value="{{ $key }}" {{ old('status', optional($smsInbox)->status) == $key ? 'selected' : '' }}>
			    	{{ $text }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('sms_status') ? 'has-error' : '' }}">
    <label for="sms_status" class="col-md-2 control-label">Sms Status</label>
    <div class="col-md-10">
        <input class="form-control" name="sms_status" type="text" id="sms_status" value="{{ old('sms_status', optional($smsInbox)->sms_status) }}" maxlength="100" placeholder="Enter sms status here...">
        {!! $errors->first('sms_status', '<p class="help-block">:message</p>') !!}
    </div>
</div>

