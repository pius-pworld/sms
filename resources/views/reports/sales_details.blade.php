@extends('layouts.app')

@section('content')
    <div class="content-wrapper">


        <section class="content-header">
            <h1>
                {{$pageTitle}}
            </h1>
            {!! $breadcrumb !!}
        </section>

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    {{--<div class="box-header" style="overflow: hidden">--}}
                    {{--<span class="box-title" style="float: left;">Order Details</span>--}}

                    {{--</div>--}}
                    <div class="box-body" style="padding: 10px 40px;">

                        <form id="order_details_frm" action="{{URL::to('primary-sales-create')}}" method="post">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <div style="border-bottom: 1px solid #ccc">
                                        <h3>{{$sales_info->point_name.' - '.$sales_info->market_name}}</h3>
                                        <h5>House Phone : {{$sales_info->dh_phone}}</h5>
                                        <h5>ASO/SO Name : {{$sales_info->sender_name}}</h5>
                                        <h5>ASO/SO Phone : {{$sales_info->sender_phone}}</h5>
                                        <h5 style="overflow: hidden;">
                                            <span style="float: left;">Order Date : {{$sales_info->order_date}}</span>
                                            {{--<span style="float: right; color: #0000F0; font-weight: bold;">--}}
                                                {{--Current Balance : <span class="current_balance">{{number_format($sales_info->current_balance,2)}}</span>--}}
                                            {{--</span>--}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <input type="hidden" name="asm_rsm_id" value="{{$sales_info->asm_rsm_id}}">
                                    <input type="hidden" name="sender_name" value="{{$sales_info->sender_name}}">
                                    <input type="hidden" name="sender_phone" value="{{$sales_info->sender_phone}}">
                                    <input type="hidden" name="dh_id" value="{{$sales_info->dbid}}">
                                    <input type="hidden" name="dh_name" value="{{$sales_info->dh_name}}">
                                    <input type="hidden" name="dh_phone" value="{{$sales_info->dh_phone}}">
                                    <input type="hidden" name="order_id" value="{{$sales_info->id}}">
                                    <input type="hidden" name="order_date" value="{{$sales_info->order_date}}">
                                </div>
                            </div>
                            <div class="showMessage"></div>
                            <div class="row">

                                <table class="table table-bordered">
                                    <thead>
                                    <th colspan="2" style="text-align: center">Product Details</th>
                                    <th>Order Quantity</th>
                                    <th>Sale Quantity</th>
                                    <th style="text-align: right">Rate</th>
                                    <th style="text-align: right">Sub Total</th>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $grand_total = 0;
                                    foreach($memo as $k=>$v)
                                    {
                                        $sl = 0;
                                        foreach($v as $vk=>$vv)
                                        {
                                            $convertArrayOrder = collect($sales)->toArray();
                                            $key = array_search($vk, array_column($convertArrayOrder, 'short_name'));
                                            $grand_total += ($convertArrayOrder[$key]->quantity*$convertArrayOrder[$key]->price);
                                            if($sl == 0)
                                            {
                                                echo '<tr><td rowspan="'.count($v).'" style="text-align: left; vertical-align: middle;">'.$k.'</td><td>'.$vv.'</td>';
                                            }
                                            else
                                            {
                                                echo '<tr><td>'.$vv.'('.$vk.')'.'</td>';
                                            }


                                            echo '<td class="request_quantity">'.floor($convertArrayOrder[$key]->quantity).'</td>';
                                            echo '<td>
                                                            <input type="hidden" name="short_name[]" value="'.$convertArrayOrder[$key]->short_name.'">
                                                            <input type="hidden" name="price['.$convertArrayOrder[$key]->short_name.']" value="'.$convertArrayOrder[$key]->price.'">
                                                            <input
                                                                readonly
                                                                class="order_quantity"
                                                                style="width: 100px;"
                                                                name="quantity['.$convertArrayOrder[$key]->short_name.']"
                                                                type="number"
                                                                oldValue="'.floor($convertArrayOrder[$key]->quantity).'"
                                                                value="'.floor($convertArrayOrder[$key]->quantity).'"></td>';
                                            echo '<td style="text-align: right" class="price_rate">'.number_format($convertArrayOrder[$key]->price,2).'</td>';
                                            echo '<td style="text-align: right" class="sub_total">'.number_format(($convertArrayOrder[$key]->price*$convertArrayOrder[$key]->quantity),2).'</td>';
                                            echo '</tr>';
                                            $sl++;
                                        }
                                    }
                                    ?>
                                    <tr>
                                        <th style="text-align: right">Total</th>
                                        <th>&nbsp;</th>
                                        <th class="total_quantity">{{$sales_info->sale_total}}</th>
                                        <th class="total_order_quantity">{{$sales_info->sale_total}}</th>
                                        <th>&nbsp;</th>
                                        <th class="grand_total" style="text-align: right">
                                            {{number_format($grand_total,2)}}
                                        </th>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-12 text-right">
                                {{--<input class="btn btn-primary" type="submit" value="Process">--}}
                            </div>
                        </form>
                    </div>


                </div>



            </div>
        </div>
        <script>
            {{--$(document).on('input','.order_quantity',function () {--}}
                {{--var order_quentity = $(this).val();--}}
                {{--var oldValue = parseInt($(this).attr('oldValue'));--}}
                {{--var request_quantity = parseInt($(this).parent().parent().find('.request_quantity').text());--}}
                {{--var current_balance = parseInt($('.current_balance').text());--}}

                {{--var rate = parseInt($(this).parent().parent().find('.price_rate').text());--}}
                {{--var sub_total =order_quentity*rate;--}}
                {{--$(this).parent().parent().find('.sub_total').text(sub_total);--}}

                {{--var grand_total = 0;--}}
                {{--var total_order_quantity = 0;--}}
                {{--$('.order_quantity').each(function(){--}}
                    {{--var get_sub_total = parseInt($(this).parent().parent().find('.sub_total').text());--}}
                    {{--var get_total_quantity = parseInt($(this).val());--}}
                    {{--grand_total = grand_total+get_sub_total;--}}
                    {{--total_order_quantity = total_order_quantity+get_total_quantity;--}}
                {{--});--}}
                {{--$('.grand_total').text(grand_total);--}}
                {{--$('.total_order_quantity').text(total_order_quantity);--}}
                {{--var t = $(this);--}}
                {{--$.ajax({--}}
                    {{--url:'{{URL::to("check-distribution-balack")}}',--}}
                    {{--type:'POST',--}}
                    {{--data:$('#order_details_frm').serialize(),--}}
                    {{--success:function (data) {--}}
                        {{--var htm = '<div class="alert alert-danger alert-dismissible">';--}}
                        {{--htm += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';--}}

                        {{--var current_value = parseInt(data);--}}
                        {{--if(data > current_balance)--}}
                        {{--{--}}
                            {{--htm += 'You have exit the current balance.<br/>';--}}
                        {{--}--}}
                        {{--if(order_quentity > request_quantity)--}}
                        {{--{--}}
                            {{--htm += 'You can not exit the request quantity.';--}}
                        {{--}--}}
                        {{--htm += '</div>';--}}
                        {{--$('.showMessage').html(htm);--}}
                    {{--}--}}
                {{--});--}}

            {{--});--}}
        </script>
@endsection