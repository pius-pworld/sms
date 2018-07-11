@extends('layouts.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
      </h1>
      {{--<ol class="breadcrumb">--}}
        {{--<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>--}}
        {{--<li class="active">Dashboard</li>--}}
      {{--</ol>--}}
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">

        <!-- ./col -->
        <div class="col-lg-4">
          <div class="col-lg-12">
            <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">
                <h5>Strike Rate</h5>
                <h3>79.14<sup style="font-size: 20px">%</sup>
                  <i style="position: relative; bottom: 10px; left: 5px;" class="fa fa-sort-down"></i>
                  -3.09<span style="font-size: 16px; position: relative; bottom: 7px;">(SDLW)</span>
                </h3>

                <p>Till Date Strike Rate : 81.29%</p>
              </div>

            </div>
          </div>
          <div class="col-lg-12">
            <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">
                <h3 class="text-center" style="border-bottom: 1px solid #fff;">Non Lifter</h3>
                <h3 class="text-center">113</h3>
              </div>

            </div>
          </div>
          <div class="col-lg-12">
            <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">
                <h3 class="text-center" style="border-bottom: 1px solid #fff;">No Order</h3>
                <h3 class="text-center">250</h3>
              </div>

            </div>
          </div>
          <div class="col-lg-12">
            <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">
                <h3 class="text-center" style="border-bottom: 1px solid #fff;">No Sales</h3>
                <h3 class="text-center">235</h3>
              </div>

            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4">
          <div class="col-lg-12">
            <!-- small box -->
            <div class="small-box bg-yellow">
              <div class="inner">
                <table class="dashboardTable">
                  <tr><td>Target Outlet</td><td>:</td><td>371284</td></tr>
                  <tr><td>Successfull Call</td><td>:</td><td>203843</td></tr>
                  <tr><td>Visited Outlet</td><td>:</td><td>321281</td></tr>
                </table>
              </div>

            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4">
          <div class="col-lg-12">
            <!-- small box -->
            <div class="small-box bg-red">
              <div class="inner">
                <div style="text-align: center; font-size: 25px; font-weight: bold; border-bottom: 1px solid #fff;">Brand Wise Productiveity</div>
                <table class="dashboardTable">
                  <tr><td>Tiger</td><td>80.04</td><td><i style="position: relative; bottom: 4px; left: 5px;" class="fa fa-sort-down"></i>&nbsp;&nbsp;-71.79</td></tr>
                  <tr><td>Black Horse</td><td>80.04</td><td><i style="position: relative; bottom: 4px; left: 5px;" class="fa fa-sort-down"></i>&nbsp;&nbsp;-21.79</td></tr>
                  <tr><td>Fizz upp</td><td>80.04</td><td><i style="position: relative; bottom: 4px; left: 5px;" class="fa fa-sort-up"></i>&nbsp;&nbsp;+34.79</td></tr>
                  <tr><td>Uro Cola</td><td>80.04</td><td><i style="position: relative; bottom: 4px; left: 5px;" class="fa fa-sort-down"></i>&nbsp;&nbsp;-56.79</td></tr>

                  <tr><td>Uro Cola</td><td>80.04</td><td><i style="position: relative; bottom: 4px; left: 5px;" class="fa fa-sort-down"></i>&nbsp;&nbsp;-56.79</td></tr>
                  <tr><td>Uro Lemon</td><td>80.04</td><td><i style="position: relative; bottom: 4px; left: 5px;" class="fa fa-sort-down"></i>&nbsp;&nbsp;-56.79</td></tr>
                  <tr><td>Uro Orance</td><td>80.04</td><td><i style="position: relative; bottom: 4px; left: 5px;" class="fa fa-sort-down"></i>&nbsp;&nbsp;-56.79</td></tr>
                  <tr><td>Uro Zeera</td><td>80.04</td><td><i style="position: relative; bottom: 4px; left: 5px;" class="fa fa-sort-down"></i>&nbsp;&nbsp;-56.79</td></tr>
                  <tr><td>Uro Lemonjee</td><td>80.04</td><td><i style="position: relative; bottom: 4px; left: 5px;" class="fa fa-sort-down"></i>&nbsp;&nbsp;-56.79</td></tr>
                  <tr><td>Mangolee</td><td>80.04</td><td><i style="position: relative; bottom: 4px; left: 5px;" class="fa fa-sort-down"></i>&nbsp;&nbsp;-56.79</td></tr>
                  <tr><td>Mango King</td><td>80.04</td><td><i style="position: relative; bottom: 4px; left: 5px;" class="fa fa-sort-down"></i>&nbsp;&nbsp;-56.79</td></tr>
                  <tr><td>Lychena</td><td>80.04</td><td><i style="position: relative; bottom: 4px; left: 5px;" class="fa fa-sort-down"></i>&nbsp;&nbsp;-56.79</td></tr>
                  <tr><td>Alma</td><td>80.04</td><td><i style="position: relative; bottom: 4px; left: 5px;" class="fa fa-sort-down"></i>&nbsp;&nbsp;-56.79</td></tr>
                </table>
              </div>

            </div>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->

      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<style>
  .dashboardTable td {
    font-size: 25px;
    padding: 4px 10px;
  }
</style>
@stop