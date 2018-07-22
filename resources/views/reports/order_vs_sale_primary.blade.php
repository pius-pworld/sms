@extends('layouts.app')

@section('content')
    <div class="content-wrapper">


        <section class="content-header">
            <h1>
                Order Vs Sale (Primary)
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Order vs Sale</a></li>
                <li class="active">Primary</li>
            </ol>
        </section>

        @include('grid.search_area_unique')
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header" style="overflow: hidden">
                        <span class="box-title" style="float: left;">Order vs Sale Primary</span>
                        <span class="advanchedSearchToggle" style="float: right;">
                            <button
                                    type="button"
                                    class="btn btn-primary panel-controller"
                                    id="top_search">
                                    <i class="fa fa-search"></i> Advanced Search
                            </button>
                        </span>
                    </div>
                    <div class="box-body showSearchDataUnique">
                        @include('reports.order_vs_sale_primary_ajax')
                    </div>

                </div>

            </div>
        </div>
        <script>
            $(document).ready(function(){
                myConfiguration();
                 $post_data= @if(isset($post_data)) {!! $post_data !!} @else null @endif;
                 if($post_data !== null){
                     $category_id=$post_data.category_id;
                     $brands_id=$post_data.brands_id;
                     $sku_id=$post_data.skues_id;
                     $date_range =$post_data.created_at;
                     $('.category_id').val($category_id);
                     $('.brands_id').val($brands_id);
                     $('.skues_id').val($sku_id);
                     $('.date_range_converted').val($date_range);
                 }
            });
        </script>
    <style>
        th{background: #fff;}
        th, td { white-space: nowrap; }
        div.dataTables_wrapper {
            width: 100%;
            margin: 0 auto;
        }
        thead th{
            padding:3px 18px;
        }
        .boo-table thead th{
            vertical-align:middle;
        }
        table.dataTable thead th, table.dataTable thead td {
            border-bottom: 0!important;
        }
        .DTFC_LeftBodyWrapper{
            top:-14px !important;
        }
    </style>
@endsection