@extends('layouts.app')

@section('content')
    <div class="content-wrapper">


        {{--<section class="content-header">--}}
            {{--<h1>--}}
                {{--Order Details--}}
            {{--</h1>--}}
            {{--{!! $breadcrumb !!}--}}
        {{--</section>--}}

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div>
                        <button id="cmd">Generate PDF</button>
                    </div>
                    <div class="box-body"  id="printDoc" style="padding: 10px 40px;">
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <div style="border-bottom: 1px solid #ccc">
                                        <h3>{{$house_info->point_name.' - '.$house_info->market_name}}</h3>
                                        <h5>Propietor Name : {{$house_info->propietor_name}}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="showMessage"></div>
                            <div class="row">

                                <table class="table table-bordered" border="1">
                                    <thead>
                                    <th colspan="2" style="text-align: center">Product Details</th>
                                    <th align="center">Current Stock</th>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $grand_total = 0;
                                    foreach($memo as $k=>$v)
                                    {
                                        $sl = 0;
                                        foreach($v as $vk=>$vv)
                                        {
                                            $convertArrayStock = collect($stocks)->toArray();
                                            $key = array_search($vk, array_column($convertArrayStock , 'short_name'));
                                            if($sl == 0)
                                            {
                                                echo '<tr><td rowspan="'.count($v).'" style="text-align: left; vertical-align: middle;">'.$k.'</td><td>'.$vv.'</td>';
                                            }
                                            else
                                            {
                                                echo '<tr><td>'.$vv.'('.$vk.')'.'</td>';
                                            }


                                            echo '<td style="text-align: center">'.$convertArrayStock [$key]['quantity'].'</td>';
                                            echo '</tr>';
                                            $sl++;
                                        }
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>

                    </div>


                </div>



            </div>
        </div>
        <script>
            $(document).ready(function () {
                $('#cmd').click(function () {
                     console.log($('#printDoc').html());
                });
            })
        </script>
@endsection