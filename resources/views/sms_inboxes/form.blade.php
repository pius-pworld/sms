
<div class="form-group {{ $errors->has('sms_inbox_name') ? 'has-error' : '' }}">
    <label for="sms_inbox_name" class="col-md-2 control-label">Sms Inbox Name</label>
    <div class="col-md-10">
        <input class="form-control" name="sms_inbox_name" type="text" id="sms_inbox_name" value="{{ old('sms_inbox_name', optional($smsInbox)->sms_inbox_name) }}" maxlength="100" placeholder="Enter sms inbox name here...">
        {!! $errors->first('sms_inbox_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('transactionId') ? 'has-error' : '' }}">
    <label for="transactionId" class="col-md-2 control-label">Transaction Id</label>
    <div class="col-md-10">
        <input class="form-control" name="transactionId" type="text" id="transactionId" value="{{ old('transactionId', optional($smsInbox)->transactionId) }}" maxlength="30" placeholder="Enter transaction id here...">
        {!! $errors->first('transactionId', '<p class="help-block">:message</p>') !!}
    </div>
</div>

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

<div class="form-group {{ $errors->has('sms_received') ? 'has-error' : '' }}">
    <label for="sms_received" class="col-md-2 control-label">Sms Received</label>
    <div class="col-md-10">
        <input class="form-control" name="sms_received" type="text" id="sms_received" value="{{ old('sms_received', optional($smsInbox)->sms_received) }}" placeholder="Enter sms received here...">
        {!! $errors->first('sms_received', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('created_by') ? 'has-error' : '' }}">
    <label for="created_by" class="col-md-2 control-label">Created By</label>
    <div class="col-md-10">
        <select class="form-control" id="created_by" name="created_by">
        	    <option value="" style="display: none;" {{ old('created_by', optional($smsInbox)->created_by ?: '') == '' ? 'selected' : '' }} disabled selected>Select created by</option>
        	@foreach ($creators as $key => $creator)
			    <option value="{{ $key }}" {{ old('created_by', optional($smsInbox)->created_by) == $key ? 'selected' : '' }}>
			    	{{ $creator }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('created_by', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('created') ? 'has-error' : '' }}">
    <label for="created" class="col-md-2 control-label">Created</label>
    <div class="col-md-10">
        <input class="form-control" name="created" type="text" id="created" value="{{ old('created', optional($smsInbox)->created) }}" placeholder="Enter created here...">
        {!! $errors->first('created', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('replied_datetime') ? 'has-error' : '' }}">
    <label for="replied_datetime" class="col-md-2 control-label">Replied Datetime</label>
    <div class="col-md-10">
        <input class="form-control" name="replied_datetime" type="text" id="replied_datetime" value="{{ old('replied_datetime', optional($smsInbox)->replied_datetime) }}" placeholder="Enter replied datetime here...">
        {!! $errors->first('replied_datetime', '<p class="help-block">:message</p>') !!}
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

<div class="form-group {{ $errors->has('updated') ? 'has-error' : '' }}">
    <label for="updated" class="col-md-2 control-label">Updated</label>
    <div class="col-md-10">
        <input class="form-control" name="updated" type="text" id="updated" value="{{ old('updated', optional($smsInbox)->updated) }}" placeholder="Enter updated here...">
        {!! $errors->first('updated', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('updated_by') ? 'has-error' : '' }}">
    <label for="updated_by" class="col-md-2 control-label">Updated By</label>
    <div class="col-md-10">
        <select class="form-control" id="updated_by" name="updated_by">
        	    <option value="" style="display: none;" {{ old('updated_by', optional($smsInbox)->updated_by ?: '') == '' ? 'selected' : '' }} disabled selected>Select updated by</option>
        	@foreach ($updaters as $key => $updater)
			    <option value="{{ $key }}" {{ old('updated_by', optional($smsInbox)->updated_by) == $key ? 'selected' : '' }}>
			    	{{ $updater }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('updated_by', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('sms_status') ? 'has-error' : '' }}">
    <label for="sms_status" class="col-md-2 control-label">Sms Status</label>
    <div class="col-md-10">
        <input class="form-control" name="sms_status" type="text" id="sms_status" value="{{ old('sms_status', optional($smsInbox)->sms_status) }}" maxlength="100" placeholder="Enter sms status here...">
        {!! $errors->first('sms_status', '<p class="help-block">:message</p>') !!}
    </div>
</div>

