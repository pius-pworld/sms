@extends('layouts.app')

@section('content')
    <div class="content-wrapper">

        <section class="content-header">
            <h1>
                Route Wise Performence By Category
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Reports</a></li>
                <li class="active">Route Wise Performence By Category</li>
            </ol>
        </section>

        @include('grid.search_area_unique')

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header" style="overflow: hidden">
                        <span class="box-title" style="float: left;">Route Wise Performence By Category</span>
                        <span class="advanchedSearchToggle" style="float: right;">
                            <button
                                    type="button"
                                    class="btn btn-primary panel-controller"
                                    id="top_search">
                                    <i class="fa fa-search"></i> Advanced Search
                            </button>
                        </span>
                    </div>
                    <div class="box-body showSearchDataUnique" style="overflow: scroll;">
                        @include('reports.route_wise_performence_by_category_ajax')
                    </div>


                </div>



            </div>
        </div>
        <script>
            $(document).ready(function(){
                myConfiguration();
            });
        </script>

@endsection