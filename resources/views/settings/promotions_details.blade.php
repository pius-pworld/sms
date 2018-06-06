@extends('layouts.app')

@section('content')
    <div class="content-wrapper">


        <section class="content-header">
            <h1>
                Promotions Details
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Settings</a></li>
                <li class="active">Promotions Details</li>
            </ol>
        </section>



        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Promotions Details &nbsp; &nbsp; &nbsp;<a style="font-size:12px; text-decoration:underline; color:#00f;" href="{{URL::to('promotionsList')}}">Back to List</a> </h3>
                    </div>
                    <div class="box-body">
                        <div class="col-xs-6">
                            <div style="text-align: center; font-weight: bold;">Package Details</div>
                            <table id="sort" class="table table-bordered table-striped">
                                <tbody>
                                    @foreach($package_details as $skue)
                                        <tr>
                                            <td>{{$skue->sku_name}}</td>
                                            <td>{{$ddetails[$skue->id]}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-xs-6">
                            <div style="text-align: center; font-weight: bold;">Free Items</div>
                            <table id="sort" class="table table-bordered table-striped">
                                <tbody>
                                @foreach($items_details as $skue)
                                    <tr>
                                        <td>{{$skue->sku_name}}</td>
                                        <td>{{$items[$skue->id]}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>


                </div>



            </div>
        </div>
        <script>

        </script>
@endsection