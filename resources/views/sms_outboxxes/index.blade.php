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
        <small>Sms Outboxxes</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Sms Outboxxes</a></li>
        <li class="active">Sms Outboxxes</li>
      </ol>
    </section>
	
	
	
		<div class="row">
        <div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Sms Outboxxes</h3>
				</div>
				 <div class="btn-group btn-group-sm pull-right" role="group">
					<a href="{{ route('sms_outboxxes.sms_outboxx.create') }}" class="btn btn-success" title="Create New Sms Outboxx">
						<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
					</a>
				</div>
				@if(count($smsOutboxxes) == 0)
					<div class="text-center">
						<h4>No Sms Outboxxes Available!</h4>
					</div>
				@else
				<div class="box-body">
                <table id="example2" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                                                    <th>Sms Receiver Number</th>
                            <th>Sms Content</th>
                            <th>Order Type</th>

                        <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($smsOutboxxes as $smsOutboxx)
                        <tr>
                                                        <td>{{ $smsOutboxx->sms_receiver_number }}</td>
                            <td>{{ $smsOutboxx->sms_content }}</td>
                            <td>{{ $smsOutboxx->order_type }}</td>

                            <td>

                                <form method="POST" action="{!! route('sms_outboxxes.sms_outboxx.destroy', $smsOutboxx->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        <a href="{{ route('sms_outboxxes.sms_outboxx.show', $smsOutboxx->id ) }}" class="btn btn-info" title="Show Sms Outboxx">
                                            <span class="glyphicon glyphicon-open" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('sms_outboxxes.sms_outboxx.edit', $smsOutboxx->id ) }}" class="btn btn-primary" title="Edit Sms Outboxx">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="Delete Sms Outboxx" onclick="return confirm(&quot;Delete Sms Outboxx?&quot;)">
                                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                        </button>
                                    </div>

                                </form>
                                
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>

        <div class="panel-footer">
            {!! $smsOutboxxes->render() !!}
        </div>
        
        @endif
    
    </div>
    </div>
@endsection