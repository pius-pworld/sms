@extends('layouts.app')

@section('content')
    <div class="content-wrapper">


        <section class="content-header">
            <h1>
                Set Promotions
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Settings</a></li>
                <li class="active">Set Promotions</li>
            </ol>
        </section>



        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Set Promotions</h3>
                    </div>
                    <div class="box-body">
                            @if (\Session::has('success'))
                                <div class="alert alert-success">
                                    <p>{{ \Session::get('success') }}</p>
                                </div><br />
                            @endif
                            <form  data-toggle="validator" role="form" method="POST" action="{{URL::to('promotionSubmit')}}" accept-charset="UTF-8" id="" class="form-horizontal">
                                <div class="col-xs-6">
                                @csrf
                                <div class="form-group ">
                                    <label for="categories_id" class="col-md-4 control-label">Package Name<span style="color: #ff0000;">*</span></label>
                                    <div class="col-md-8">
                                        <input required class="form-control" name="package_name" type="text" id="" value="" placeholder="Enter package name here.">
                                    </div>
                                </div>

                                    <div class="form-group ">
                                        <label for="brand_name" class="col-md-4 control-label">Package Start<span style="color: #ff0000;">*</span></label>
                                        <div class="col-md-8">
                                            <input required class="form-control" name="package_start" type="date" id="" value="" placeholder="Enter start date here...">

                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="brand_name" class="col-md-4 control-label">Package End<span style="color: #ff0000;">*</span></label>
                                        <div class="col-md-8">
                                            <input required class="form-control" name="package_end" type="date" id="" value="" maxlength="255" placeholder="Enter ending date here...">

                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="is_active" class="col-md-4 control-label">Is Active</label>
                                        <div class="col-md-8">
                                            <div class="checkbox">
                                                <label for="is_active_1">
                                                    <input id="" class="" name="is_active" type="checkbox" value="1">
                                                    Yes
                                                </label>
                                            </div>
                                        </div>
                                    </div>





                                </div>
                                <div class="col-xs-6">
                                    <div class="col-xs-6">
                                    <div class="form-group ">

                                        <div class="col-md-12">
                                            <div class="col-md-12" style="text-align: center; background: #ccc;">Package Criteria</div>
                                            <div class="col-md-8">Name</div>
                                            <div class="col-md-4">Qty</div>

                                            <div class="col-md-8">
                                                <select class="form-control" id="" name="package_key[1]">
                                                    <option value="" selected="" disabled="">Select Sku</option>
                                                    @foreach($skues as $skue)
                                                        <option value="{{$skue->id}}">{{$skue->sku_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <input class="form-control" name="package_value[1]" type="number">
                                            </div>
                                            <div class="col-md-8">
                                                <select class="form-control" id="" name="package_key[2]">
                                                    <option value="" selected="" disabled="">Select Sku</option>
                                                    @foreach($skues as $skue)
                                                        <option value="{{$skue->id}}">{{$skue->sku_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <input class="form-control" name="package_value[2]" type="number">
                                            </div>
                                            <div class="col-md-8">
                                                <select class="form-control" id="" name="package_key[3]">
                                                    <option value="" selected="" disabled="">Select Sku</option>
                                                    @foreach($skues as $skue)
                                                        <option value="{{$skue->id}}">{{$skue->sku_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <input class="form-control" name="package_value[3]" type="number">
                                            </div>
                                            <div class="col-md-8">
                                                <select class="form-control" id="" name="package_key[4]">
                                                    <option value="" selected="" disabled="">Select Sku</option>
                                                    @foreach($skues as $skue)
                                                        <option value="{{$skue->id}}">{{$skue->sku_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <input class="form-control" name="package_value[4]" type="number">
                                            </div>
                                        </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-6">
                                        <div class="form-group ">

                                            <div class="col-md-12">
                                                <div class="col-md-12" style="text-align: center; background: #ccc;">Free Items</div>
                                                <div class="col-md-8">Name</div>
                                                <div class="col-md-4">Qty</div>

                                                <div class="col-md-8">
                                                    <select class="form-control" id="" name="free_items[1]">
                                                        <option value="" selected="" disabled="">Select Sku</option>
                                                        @foreach($skues as $skue)
                                                            <option value="{{$skue->id}}">{{$skue->sku_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <input class="form-control" name="free_items_value[1]" type="number">
                                                </div>
                                                <div class="col-md-8">
                                                    <select class="form-control" id="" name="free_items[2]">
                                                        <option value="" selected="" disabled="">Select Sku</option>
                                                        @foreach($skues as $skue)
                                                            <option value="{{$skue->id}}">{{$skue->sku_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <input class="form-control" name="free_items_value[2]" type="number">
                                                </div>
                                                <div class="col-md-8">
                                                    <select class="form-control" id="" name="free_items[3]">
                                                        <option value="" selected="" disabled="">Select Sku</option>
                                                        @foreach($skues as $skue)
                                                            <option value="{{$skue->id}}">{{$skue->sku_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <input class="form-control" name="free_items_value[3]" type="number">
                                                </div>
                                                <div class="col-md-8">
                                                    <select class="form-control" id="" name="free_items[4]">
                                                        <option value="" selected="" disabled="">Select Sku</option>
                                                        @foreach($skues as $skue)
                                                            <option value="{{$skue->id}}">{{$skue->sku_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <input class="form-control" name="free_items_value[4]" type="number">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-offset-2 col-md-10" style="text-align: right; padding-right:44px;">
                                            <input class="btn btn-primary" type="submit" value="Submit">
                                        </div>
                                    </div>
                                </div>
                            </form>


                    </div>
                </div>
            </div>
        </div>
        <style>
            .form-control{
                padding: 0 !important;
            }
        </style>
        <script>
        </script>
@endsection