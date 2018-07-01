@extends('layouts.app')

@section('content')
    <div class="content-wrapper">


        <section class="content-header">
            <h1>
                Order Details
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Reports</a></li>
                <li class="active">Order Details</li>
            </ol>
        </section>

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header" style="overflow: hidden">
                        <span class="box-title" style="float: left;">Order Details</span>

                    </div>
                    <div class="box-body">
                        <form action="{{URL::to('primary-sales-create')}}" method="post">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-lg-6">

                                    ASM/RSM Name : {{$orders_info->requester_name}}<br/>
                                    ASM/RSM Mobile : {{$orders_info->requester_phone}}<br/>
                                    Request Date : {{$orders_info->created_at}}<br/>
                                    Distribution House : {{$orders_info->dh_name}}<br/>
                                    Distribution Phone : {{$orders_info->dh_phone}}<br/><br>
                                </div>
                                <div class="col-lg-6">
                                    <input type="hidden" name="asm_rsm_id" value="{{$orders_info->asm_rsm_id}}">
                                    <input type="hidden" name="sender_name" value="{{$orders_info->requester_name}}">
                                    <input type="hidden" name="sender_phone" value="{{$orders_info->requester_phone}}">
                                    <input type="hidden" name="dh_name" value="{{$orders_info->dh_name}}">
                                    <input type="hidden" name="dh_phone" value="{{$orders_info->dh_phone}}">
                                    <input type="hidden" name="order_id" value="{{$orders_info->id}}">
                                </div>
                            </div>
                            <div class="row">
                                @foreach($orders as $order)
                                    @if($order->quantity > 0)
                                        <div class="col-lg-3">
                                            <div class="col-lg-12 text-bold">{{$order->brand_name.' '.$order->sku_name.'('.$order->short_name.')'}}</div>
                                            <div class="col-lg-6">
                                                <div>Request&nbsp;Quantity</div>
                                                <input style="width: 100px;" type="text" value="{{$order->quantity}}">
                                            </div>
                                            <div class="col-lg-6">
                                                <div>Order&nbsp;Quantity</div>
                                                <input type="hidden" name="short_name[]" value="{{$order->short_name}}">
                                                <input style="width: 100px;" name="quantity[{{$order->short_name}}]" type="text" value="">
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div class="col-lg-12 text-right">
                                <input class="btn btn-primary" type="submit" value="Save">
                            </div>
                        </form>
                    </div>


                </div>



            </div>
        </div>
        <script>
//            $(document).ready(function(){
//                myConfiguration();
//            });
        </script>
@endsection