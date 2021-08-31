@extends('admin.layouts.main')
@section('Dashboard','active')
@section('content')
    <section class="row">
      <div class="col-12 col-lg-12">
          <div class="row">
              <div class="col-6 col-lg-3 col-md-6">
                  <div class="card">
                      <div class="card-body px-3 py-4-5">
                          <div class="row">
                              <div class="col-md-4">
                                  <div class="stats-icon purple">
                                      <i class="iconly-boldPaper-Plus"></i>
                                  </div>
                              </div>
                              <div class="col-md-8">
                                  <h6 class="text-muted font-semibold">New Orders</h6>
                                  <h6 class="font-extrabold mb-0">+{{ count($newOrders) }}</h6>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-6 col-lg-3 col-md-6">
                  <div class="card">
                    <div class="card-body px-3 py-4-5">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="stats-icon blue">
                                    <i class="iconly-boldShield-Fail"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-muted font-semibold">Item Out Of Stock</h6>
                                <h6 class="font-extrabold mb-0">{{ count($ofs) }}</h6>
                            </div>
                        </div>
                    </div>
                  </div>
              </div>
              <div class="col-6 col-lg-3 col-md-6">
                  <div class="card">
                    <div class="card-body px-3 py-4-5">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="stats-icon green">
                                    <i class="iconly-boldBag"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-muted font-semibold">Total Item Sold</h6>
                                <h6 class="font-extrabold mb-0">{{ $itemsold }}</h6>
                            </div>
                        </div>
                    </div>
                  </div>
              </div>
              <div class="col-6 col-lg-3 col-md-6">
                  <div class="card">
                    <div class="card-body px-3 py-4-5">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="stats-icon red">
                                    <i class="iconly-boldWallet"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-muted font-semibold">Income All of time</h6>
                                <h6 class="font-extrabold mb-0">{{ $income }}</h6>
                            </div>
                        </div>
                    </div>
                  </div>
              </div>
          </div>
          <div class="row">
              <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Revenue 2021</h4>
                        </div>
                        <div class="card-body">
                            <div id="chart"></div>
                        </div>
                    </div>
              </div>
          </div>
          <div class="card">
              <div class="card-header">
                  <h4>Item Out Of Stock</h4>
              </div>
              <div class="card-body">
                  <table class="table table-bordered">
                      <tr>
                          <th>No</th>
                          <th>Name</th>
                          <th>Size</th>
                          <th>Stock</th>
                      </tr>
                      @php
                        $i=1;
                      @endphp
                      @forelse ($ofs as $item)
                      <tr>
                          <td>{{ $i++ }}</td>
                          <td>{{ $item->name }}</td>
                          <td>{{ $item->size }}</td>
                          <td>{{ $item->qty }}</td>
                      </tr>
                      @empty

                      @endforelse
                  </table>
              </div>
          </div>
      </div>
    </section>
    @push('dashboard')
        <script src="{{ asset('admin/assets/js/pages/dashboard.js')}}"></script>
        <script>
            var options = {
          series: [
          {
            name: 'Rp',
            data: {!! json_encode($data) !!}
          }
        ],
          chart: {
          height: 350,
          type: 'bar'
        },
        plotOptions: {
          bar: {
            columnWidth: '60%'
          }
        },
        colors: ['#00E396'],
        dataLabels: {
          enabled: false
        },
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
        </script>
   @endpush
@endsection
