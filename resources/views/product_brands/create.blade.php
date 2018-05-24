@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="panel panel-default">

        <div class="panel-heading clearfix">
            
            <span class="pull-left">
                <h4 class="mt-5 mb-5">Create New Product Brand</h4>
            </span>

            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('product_brands.product_brand.index') }}" class="btn btn-primary" title="Show All Product Brand">
                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                </a>
            </div>

        </div>

        <div class="panel-body">
        
            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <form method="POST" action="{{ route('product_brands.product_brand.store') }}" accept-charset="UTF-8" id="create_product_brand_form" name="create_product_brand_form" class="form-horizontal">
            {{ csrf_field() }}
            @include ('product_brands.form', [
                                        'productBrand' => null,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value="Add">
                    </div>
                </div>

            </form>

        </div>
    </div>
 </div>
@endsection


