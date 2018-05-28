
<div class="form-group {{ $errors->has('sms_sender_number') ? 'has-error' : '' }}">
    <label for="sms_sender_number" class="col-md-2 control-label">Sms Sender Number</label>
    <div class="col-md-10">
        <input class="form-control" name="sms_sender_number" type="text" id="sms_sender_number" value="{{ old('sms_sender_number', optional($smsInbox)->sms_sender_number) }}" min="1" max="15" required="true" placeholder="Enter sms sender number here...">
        {!! $errors->first('sms_sender_number', '<p class="help-block">:message</p>') !!}
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

