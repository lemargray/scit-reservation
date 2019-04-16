@extends('layouts.main')

@section('content')
    <div class="alert alert-info">
       Welcome <i class="fa fa-exclamation"></i> Here you will be able to see all your reservations <i class="far fa-calendar-alt"></i>.
    </div>

    <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box my-bg-info">
              <div class="inner">
                <h3>3</h3>

                <p>Upcoming Reservations</p>
              </div>
              <div class="icon">
                <i class="fas fa-calendar-alt"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success text-white">
              <div class="inner">
                <h3>April 25, 2019<sup style="font-size: 20px"> <i class="fa fa-calendar-alt"></i> </sup></h3>

                <p>Lab A - Computer: 100001</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>44 <sup style="font-size:20px"><i class="fa fa-exclamation-circle"></i></sup></h3>

                <p>Cancelled Reservations</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer text-dark">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger text-white">
              <div class="inner">
                <h3>65 <sup style="font-size:20px"><i class="fa fa-envelope"></i></sup></h3>

                <p>Notifications</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
@endsection