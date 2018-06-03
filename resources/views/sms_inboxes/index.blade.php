@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    @if(Session::has('success_message'))
        <div class="alert alert-success">
            <span class="glyphicon glyphicon-ok"></span>
            {!! session('success_message') !!}

            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>
    @endif
	
	<section class="content-header">
      <h1>
        Data Tables
        <small>Sms Inboxes</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Sms Inboxes</a></li>
        <li class="active">Sms Inboxes</li>
      </ol>
    </section>
	
	
	
		<div class="row">
        <div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Sms Inboxes</h3>
				</div>
				 <div class="btn-group btn-group-sm pull-right" role="group">
					<a href="{{ route('sms_inboxes.sms_inbox.create') }}" class="btn btn-success" title="Create New Sms Inbox">
						<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
					</a>
				</div>
				@if(count($smsInboxes) == 0)
					<div class="text-center">
						<h4>No Sms Inboxes Available!</h4>
					</div>
				@else
				<div class="box-body">
                <table id="example2" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Sender</th>
                            <th>Sms Content</th>
                            <th>Sms Status</th>
                            <th>Action</th>
                            <th>Process</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($smsInboxes as $smsInbox)
                        <tr>
                            <td>{{ $smsInbox->sender }}</td>
                            <td>{{ $smsInbox->sms_content }}</td>
                            <td>{{ $smsInbox->sms_status }}</td>
                            <td>
                                <form method="POST" action="{!! route('sms_inboxes.sms_inbox.destroy', $smsInbox->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        <a href="{{ route('sms_inboxes.sms_inbox.show', $smsInbox->id ) }}" class="btn btn-info" title="Show Sms Inbox">
                                            <span class="glyphicon glyphicon-open" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('sms_inboxes.sms_inbox.edit', $smsInbox->id ) }}" class="btn btn-primary" title="Edit Sms Inbox">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="Delete Sms Inbox" onclick="return confirm(&quot;Delete Sms Inbox?&quot;)">
                                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                        </button>
                                    </div>

                                </form>
                                
                            </td>
                            <td>
                                <a href="{{ route('sms_inboxes.sms_inbox.process', $smsInbox->id ) }}" class="btn btn-primary" title="Edit Sms Inbox">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>

        <div class="panel-footer">
            {!! $smsInboxes->render() !!}
        </div>
        
        @endif
    
    </div>
    </div>
@endsection