@extends('dashboard.layouts.site')
@section('title')
    Dashboard
@endsection
@section('content')
    <div class="col-lg-12">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-6 col-lg-3">
                    <div class="card card-inverse card-primary">
                        <div class="card-block p-b-0">
                            <div class="btn-group pull-left">
                                <button type="button" class="btn btn-transparent active p-a-0"  aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-user-md"></i>
                                </button>
                            </div>
                            <h4 class="m-b-0 m-l-2">
                            {{ $doctors }}
                          
                            </h4>
                            <p>Doctors</p>
                        </div>
                        <div class="chart-wrapper p-x-1" style="height:70px;">
                            <canvas id="card-chart1" class="chart" height="70"></canvas>
                        </div>
                    </div>
                </div>
                <!--/col-->

                <div class="col-sm-6 col-lg-3">
                    <div class="card card-inverse card-info">
                        <div class="card-block p-b-0">
                            <button type="button" class="btn btn-transparent active p-a-0 pull-left">
                                <i class="fa fa-users"></i>
                            </button>
                            <h4 class="m-b-0 m-l-2"> {{ $patients }}</h4>
                            <p>Patients</p>
                        </div>
                        <div class="chart-wrapper p-x-1" style="height:70px;">
                            <canvas id="card-chart2" class="chart" height="70"></canvas>
                        </div>
                    </div>
                </div>
                <!--/col-->

                <div class="col-sm-6 col-lg-3">
                    <div class="card card-inverse card-warning">
                        <div class="card-block p-b-0">
                            <div class="btn-group pull-left">
                                <button type="button" class="btn btn-transparent active  p-a-0" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-plus-square "></i>
                                </button>
                            </div>
                            <h4 class="m-b-0 m-l-2"> {{ $appointments }}</h4>
                            <p>Apppointments</p>
                        </div>
                        <div class="chart-wrapper" style="height:70px;">
                            <canvas id="card-chart3" class="chart" height="70"></canvas>
                        </div>
                    </div>
                </div>
                <!--/col-->

                <div class="col-sm-6 col-lg-3">
                    <div class="card card-inverse card-danger">
                        <div class="card-block p-b-0">
                            <div class="btn-group pull-left">
                                <button type="button" class="btn btn-transparent active  p-a-0"  aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-medkit"></i>
                                </button>
                            </div>
                            <h4 class="m-b-0 m-l-2"> {{ $types }}</h4>
                            <p>Types</p>
                        </div>
                        <div class="chart-wrapper p-x-1" style="height:70px;">
                            <canvas id="card-chart4" class="chart" height="70"></canvas>
                        </div>
                    </div>
                </div>
                <!--/col-->

            </div>
            <!--/row-->

        </div>
    </div>
@endsection
