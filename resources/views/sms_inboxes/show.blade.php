@extends('layouts.app')

@section('content')
<div class="content-wrapper">
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Sms Inbox' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('sms_inboxes.sms_inbox.destroy', $smsInbox->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('sms_inboxes.sms_inbox.index') }}" class="btn btn-primary" title="Show All Sms Inbox">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('sms_inboxes.sms_inbox.create') }}" class="btn btn-success" title="Create New Sms Inbox">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('sms_inboxes.sms_inbox.edit', $smsInbox->id ) }}" class="btn btn-primary" title="Edit Sms Inbox">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Sms Inbox" onclick="return confirm(&quot;Delete Sms Inbox??&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Sms Inbox Name</dt>
            <dd>{{ $smsInbox->sms_inbox_name }}</dd>
            <dt>Transaction Id</dt>
            <dd>{{ $smsInbox->transactionId }}</dd>
            <dt>Sms Sender Number</dt>
            <dd>{{ $smsInbox->sms_sender_number }}</dd>
            <dt>Sms Content</dt>
            <dd>{{ $smsInbox->sms_content }}</dd>
            <dt>Sms Received</dt>
            <dd>{{ $smsInbox->sms_received }}</dd>
            <dt>Created By</dt>
            <dd>{{ optional($smsInbox->creator)->name }}</dd>
            <dt>Created</dt>
            <dd>{{ $smsInbox->created }}</dd>
            <dt>Replied Datetime</dt>
            <dd>{{ $smsInbox->replied_datetime }}</dd>
            <dt>Status</dt>
            <dd>{{ $smsInbox->status }}</dd>
            <dt>Updated</dt>
            <dd>{{ $smsInbox->updated }}</dd>
            <dt>Updated By</dt>
            <dd>{{ optional($smsInbox->updater)->name }}</dd>
            <dt>Sms Status</dt>
            <dd>{{ $smsInbox->sms_status }}</dd>

        </dl>

    </div>
</div>
</div>

@endsection