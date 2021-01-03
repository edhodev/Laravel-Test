@extends('layouts.app')

@section('title', 'Dashboard')
@section('content')
<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-primary">
          <i class="far fa-user"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total User</h4>
          </div>
          <div class="card-body">
            {{ User::total() }}
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-danger">
          <i class="fas fa-dollar-sign"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Income (IDR)</h4>
          </div>
          <div class="card-body">
            {{ number_format(Income::total(), 0, ',', '.') }}
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-warning">
          <i class="fas fa-dollar-sign"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Expense (IDR)</h4>
          </div>
          <div class="card-body">
            {{ number_format(Expense::total(), 0, ',', '.') }}
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-success">
          <i class="fas fa-dollar-sign"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Profit (IDR)</h4>
          </div>
          <div class="card-body">
            {{ number_format($profit, 0, ',', '.') }}
          </div>
        </div>
      </div>
    </div>
  </div>    
  <div class="row">
    <div class="col-lg-8 col-md-12 col-12 col-sm-12">
      <div class="card">
        <div class="card-header">
          <h4>Statistics</h4>
        </div>
        <div class="card-body">
          <canvas id="myChart" height="508" width="839" class="chartjs-render-monitor" style="display: block; width: 839px; height: 508px;"></canvas>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-12 col-12 col-sm-12">
      <div class="card">
        <div class="card-header">
          <h4>Recent Activities</h4>
        </div>
        <div class="card-body">
          <ul class="list-unstyled list-unstyled-border">
            @foreach ($log as $item)
              <li class="media">
                <img class="mr-3 rounded-circle" width="50" src="../assets/img/avatar/avatar-1.png" alt="avatar">
                <div class="media-body">
                  <div class="media-title">{{ $item->username }}</div>
                  <span class="text-small text-muted">{{ $item->activity }}.</span>
                  <br>
                  <span class="text-small text-muted">{{ $item->timestamp }}.</span>
                </div>
              </li>
            @endforeach
          </ul>
          <div class="text-center pt-1 pb-1">
            <a href="#" class="btn btn-primary btn-lg btn-round">
              View All
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

