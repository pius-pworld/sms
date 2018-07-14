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
                <h3 style="font-size: 25px; text-align: center; border-bottom: 2px solid #fff;">Strike Rate</h3>
                <P style="text-align: center; font-size: 20px;">79.14%
                  &nbsp;<i style="" class="fa fa-sort-down"></i>&nbsp;
                  -3.09<span style="">(SDLW)</span>
                </P>

                <p style="text-align: center">Till Date Strike Rate : 81.29%</p>
              </div>

            </div>
          </div>
          <div class="col-lg-12">
            <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">
                <h3 class="text-center" style="border-bottom: 1px solid #fff; font-size: 25px;">Non Lifter</h3>
                <p class="text-center" style="font-size: 20px;">113</p>
              </div>

            </div>
          </div>
          <div class="col-lg-12">
            <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">
                <h3 class="text-center" style="border-bottom: 1px solid #fff; font-size: 25px;">No Order</h3>
                <p class="text-center" style="font-size: 20px;">250</p>
              </div>

            </div>
          </div>
          <div class="col-lg-12">
            <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">
                <h3 class="text-center" style="border-bottom: 1px solid #fff; font-size: 25px;">No Sales</h3>
                <p class="text-center" style="font-size: 20px;">235</p>
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
                <table class="table dashboardTable">
                  <thead>
                  <tr><th>Name</th><th>&nbsp;</th><th>Value</th></tr>
                  </thead>
                  <tbody>
                  <tr><td>Target Outlet</td><td>:</td><td>371284</td></tr>
                  <tr><td>Successfull Call</td><td>:</td><td>203843</td></tr>
                  <tr><td>Visited Outlet</td><td>:</td><td>321281</td></tr>
                  </tbody>
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
                <table class="table table-border dashboardTable">
                  <tr><td>Tiger</td><td>80.04</td><td><i style="position: relative; bottom: 4px; left: 5px;" class="fa fa-sort-down"></i>&nbsp;&nbsp;-71.79<span style="font-size: 16px;">(SDLW)</span></td></tr>
                  <tr><td>Black Horse</td><td>80.04</td><td><i style="position: relative; bottom: 4px; left: 5px;" class="fa fa-sort-down"></i>&nbsp;&nbsp;-21.79<span style="font-size: 16px;">(SDLW)</span></td></tr>
                  <tr><td>Fizz upp</td><td>80.04</td><td><i style="position: relative; bottom: 4px; left: 5px;" class="fa fa-sort-up"></i>&nbsp;&nbsp;+34.79<span style="font-size: 16px;">(SDLW)</span></td></tr>
                  <tr><td>Uro Cola</td><td>80.04</td><td><i style="position: relative; bottom: 4px; left: 5px;" class="fa fa-sort-down"></i>&nbsp;&nbsp;-56.79<span style="font-size: 16px;">(SDLW)</span></td></tr>

                  <tr><td>Uro Cola</td><td>80.04</td><td><i style="position: relative; bottom: 4px; left: 5px;" class="fa fa-sort-down"></i>&nbsp;&nbsp;-56.79<span style="font-size: 16px;">(SDLW)</span></td></tr>
                  <tr><td>Uro Lemon</td><td>80.04</td><td><i style="position: relative; bottom: 4px; left: 5px;" class="fa fa-sort-down"></i>&nbsp;&nbsp;-56.79<span style="font-size: 16px;">(SDLW)</span></td></tr>
                  <tr><td>Uro Orance</td><td>80.04</td><td><i style="position: relative; bottom: 4px; left: 5px;" class="fa fa-sort-down"></i>&nbsp;&nbsp;-56.79<span style="font-size: 16px;">(SDLW)</span></td></tr>
                  <tr><td>Uro Zeera</td><td>80.04</td><td><i style="position: relative; bottom: 4px; left: 5px;" class="fa fa-sort-down"></i>&nbsp;&nbsp;-56.79<span style="font-size: 16px;">(SDLW)</span></td></tr>
                  <tr><td>Uro Lemonjee</td><td>80.04</td><td><i style="position: relative; bottom: 4px; left: 5px;" class="fa fa-sort-down"></i>&nbsp;&nbsp;-56.79<span style="font-size: 16px;">(SDLW)</span></td></tr>
                  <tr><td>Mangolee</td><td>80.04</td><td><i style="position: relative; bottom: 4px; left: 5px;" class="fa fa-sort-down"></i>&nbsp;&nbsp;-56.79<span style="font-size: 16px;">(SDLW)</span></td></tr>
                  <tr><td>Mango King</td><td>80.04</td><td><i style="position: relative; bottom: 4px; left: 5px;" class="fa fa-sort-down"></i>&nbsp;&nbsp;-56.79<span style="font-size: 16px;">(SDLW)</span></td></tr>
                  <tr><td>Lychena</td><td>80.04</td><td><i style="position: relative; bottom: 4px; left: 5px;" class="fa fa-sort-down"></i>&nbsp;&nbsp;-56.79<span style="font-size: 16px;">(SDLW)</span></td></tr>
                  <tr><td>Alma</td><td>80.04</td><td><i style="position: relative; bottom: 4px; left: 5px;" class="fa fa-sort-down"></i>&nbsp;&nbsp;-56.79<span style="font-size: 16px;">(SDLW)</span></td></tr>
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
  .dashboardTable td, th{
    font-size: 20px;
    padding: 4px 0px;
  }
  .content-wrapper {
    background-color: #ccc !important;
  }
</style>
@stop