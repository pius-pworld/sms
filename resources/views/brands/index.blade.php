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
        <small>Brands</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Brands</a></li>
        <li class="active">Brands</li>
      </ol>
    </section>
	
	
	
		<div class="row">
        <div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Brands</h3>
				</div>
				 <div class="btn-group btn-group-sm pull-right" role="group">
					<a href="{{ route('brands.brand.create') }}" class="btn btn-success" title="Create New Brand">
						<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
					</a>
				</div>
				@if(count($brands) == 0)
					<div class="text-center">
						<h4>No Brands Available!</h4>
					</div>
				@else
				<div class="box-body">
                <table id="example2" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                                                    <th>Categories</th>
                            <th>Brand Name</th>
                            <th>Segment</th>

                        <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($brands as $brand)
                        <tr>
                                                        <td>{{ optional($brand->category)->category_name }}</td>
                            <td>{{ $brand->brand_name }}</td>
                            <td>{{ $brand->segment }}</td>

                            <td>

                                <form method="POST" action="{!! route('brands.brand.destroy', $brand->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        <a href="{{ route('brands.brand.show', $brand->id ) }}" class="btn btn-info" title="Show Brand">
                                            <span class="glyphicon glyphicon-open" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('brands.brand.edit', $brand->id ) }}" class="btn btn-primary" title="Edit Brand">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="Delete Brand" onclick="return confirm(&quot;Delete Brand?&quot;)">
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
            {!! $brands->render() !!}
        </div>
        
        @endif
    
    </div>
    </div>
@endsection