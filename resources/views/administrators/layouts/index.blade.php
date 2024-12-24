@extends('administrators.layouts.master')
@section('main-content')
      <section class="crancy-adashboard crancy-show" >
        <div class="container container__bscreen">
          {{-- <h2></h2> --}}
          <div class="row">
            <div class="col-xxl-8 col-12 crancy-main__column" style="width: 70%;">
              <div class="crancy-body">
                <!-- Dashboard Inner -->
                <div class="crancy-dsinner">
                  <div class="row">
  {{-- Tổng doanh thu--}}
                    <div class="col-lg-4 col-12 mg-top-30" style="background: #f2c94c">
                      <!-- Progress Card -->
                      <div class="crancy-progress-card" >
             
                        <div class="crancy-progress-card__content" style="height: 102px">
                          <div class="crancy-progress-card__history">
                            <span style="font-size: 20px">Tổng doanh thu trong tháng</span>
                          </div>
                          <div style="text-align: center">
                            <b class="number crancy-color1" style="font-size: 30px;">{{ number_format($totalRevenue,0,'.','.') }} VNĐ</b>
                          </div>
                        </div>
                      </div>
                      <!-- End Progress Card -->
                    </div>
{{-- Sản phẩm tồn --}}
                    <div class="col-lg-4 col-12 mg-top-30" style="background: #f2c94c">
                      <!-- Progress Card -->
                      <div class="crancy-progress-card">
                        
                        <div class="crancy-progress-card__content"  style="height: 102px">
                          <div class="crancy-progress-card__history">
                            <span style="font-size: 20px">Tổng đơn hàng trong tháng</span>
                          </div>
                          <div style="text-align: center">
                            <b class="number crancy-color1"  style="font-size: 30px;">{{$totalOrders}}</b>
                          </div>
                        </div>
                      </div>
                      <!-- End Progress Card -->
                    </div>
{{-- Tổng đơn hàng trong tháng --}}
                    <div class="col-lg-4 col-12 mg-top-30" style="background: #f2c94c">
                      <!-- Progress Card -->
                      <div class="crancy-progress-card">
                        <div class="crancy-progress-card__content"  style="height: 102px;">
                          <div class="crancy-progress-card__history" style="height: 52px; ">
                            <span style="font-size: 20px">Sản phầm trong kho</span>
                          </div>
                          <div style="text-align: center">
                            <b class="number crancy-color1"  style="font-size: 30px;">{{$totalStock}}</b>
                          </div>
                        </div>
                      </div>
                      <!-- End Progress Card -->
                    </div>
                  </div>

                  <div class="row">
                    <div>
                      <!-- Charts One -->
                      <div class="charts-main charts-home-one mg-top-30">
                        <!-- Top Heading -->
                        <div class="charts-main__heading mg-btm-20">
                          <h4 class="charts-main__title">Lịch sử đơn hàng</h4>
                          <div class="charts-main__middle">
                            <ul
                              class="crancy-progress-list crancy-progress-list__inline"
                            >
                              <li>
                                <span
                                  class="crancy-progress-list__color"
                                ></span>
                                <p>Đơn hàng bán thành công</p>
                              </li>
                              <li>
                                <span
                                  class="crancy-progress-list__color crancy-color9__bg"
                                ></span>
                                <p>Đơn hàng đã hủy</p>
                              </li>
                            </ul>
                          </div>
                          <!-- Chart Dropdown Menu -->
                          
                          <!-- End Chart Dropdown Menu -->
                        </div>
                        <div class="charts-main__one">
                          <div class="tab-content" id="nav-tabContent">
                            <div
                              class="tab-pane fade show active"
                              id="crancy-chart__t1"
                              role="tabpanel"
                              aria-labelledby="crancy-chart__t1"
                            >
                              <div
                                class="crancy-chart__inside crancy-chart__one"
                              >
                                <!-- Chart One -->
                                <canvas id="myChart_one"></canvas>
                                
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- End Charts One -->
                    </div>
                  </div>
                </div>
                <!-- End Dashboard Inner -->
              </div>
            </div>

            <div class="col-xxl-4 col-12 crancy-main__sidebar" style="width: 30%;">
              <!-- Crancy Sidebar -->
              <div class="crancy-sidebar mg-top-30">
                    <!-- crancy Single Sidebar -->
                    <div class="crancy-sidebar__single">
                      <div class="crancy-sidebar__heading">
                        <h4 class="crancy-sidebar__title">Lịch</h4>
                      </div>
                      <div id="crancy-calender" class="crancy-default-cd" style="width: 300px;"></div>
                    </div>
              </div>
              <!-- End Crancy Sidebar -->
            </div>
          </div>
        </div>
        
      </section>
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
     <script>
      // Chart One
      const ctx = document.getElementById("myChart_one").getContext("2d");
      const myChart_one = new Chart(ctx, {
        type: "bar",

        data: {
          labels: [
            "Tháng 1",
            "Tháng 2",
            "Tháng 3",
            "Tháng 4",
            "Tháng 5",
            "Tháng 6",
            "Tháng 7",
            "Tháng 8",
            "Tháng 9",
            "Tháng 10",
            "Tháng 11",
            "Tháng 12",
          ],
          datasets: [
            {
              label: "Thành công ",
              data: @json($successfulOrdersCounts),
              backgroundColor: [
                "#0A82FD",
                "#0A82FD",
                "#0A82FD",
                "#0A82FD",
                "#0A82FD",
                "#0A82FD",
                "#0A82FD",
                "#0A82FD",
                "#0A82FD",
                "#0A82FD",
                "#0A82FD",
                "#0A82FD",
              ],
              hoverBackgroundColor: "#0A82FD",
              fill: true,
              tension: 0.4,
              borderWidth: 0,
              borderSkipped: false,
              borderRadius: 8,
              borderRadius: {
                topLeft: 8, // Apply border radius to the top-left corner
                topRight: 8, // Apply border radius to the top-right corner
                bottomLeft: 0, // Keep bottom-left corner square
                bottomRight: 0, // Keep bottom-right corner square
              },
              barPercentage: 0.8,
              categoryPercentage: 0.5,
            },
            {
              label: "Hủy",
              data: @json($cancelledOrdersCounts),
              backgroundColor: [
                "#F2C94C",
                "#F2C94C",
                "#F2C94C",
                "#F2C94C",
                "#F2C94C",
                "#F2C94C",
                "#F2C94C",
                "#F2C94C",
                "#F2C94C",
                "#F2C94C",
                "#F2C94C",
                "#F2C94C",
              ],
              hoverBackgroundColor: [
                "#F2C94C",
                "#F2C94C",
                "#F2C94C",
                "#F2C94C",
                "#F2C94C",
                "#F2C94C",
                "#F2C94C",
                "#F2C94C",
                "#F2C94C",
                "#F2C94C",
                "#F2C94C",
                "#F2C94C",
              ],
              borderWidth: 0,
              borderSkipped: false,
              borderRadius: 8,
              borderRadius: {
                topLeft: 8, // Apply border radius to the top-left corner
                topRight: 8, // Apply border radius to the top-right corner
                bottomLeft: 0, // Keep bottom-left corner square
                bottomRight: 0, // Keep bottom-right corner square
              },
              barPercentage: 0.8,
              categoryPercentage: 0.5,
            },
          ],
        },

        options: {
          maintainAspectRatio: false,
          responsive: true,
          scales: {
            x: {
              ticks: {
                color: "#5D6A83",
              },
              grid: {
                display: false,
                drawBorder: false,
                color: "#D7DCE7",
              },
            },
            y: {
            ticks: {
              color: "#5D6A83",
              stepSize: 1,
              max: {{$totalOrders}},
              callback: function (value, index, values) {
                  return value;
              },
          },
        //   ticks: {
        //     color: "#5D6A83",
        //     stepSize: 1,
        //     callback: function (value, index, values) {
        //         var totalOrders = {{$totalOrders}};
        //         return value <= totalOrders ? value : totalOrders;
        //     },
        // },

              grid: {
                drawBorder: false,
                color: "#D7DCE7",
                borderDash: [5, 5],
              },
            },
          },
          plugins: {
            tooltip: {
              padding: 10,
              displayColors: true,
              yAlign: "bottom",
              backgroundColor: "#fff",
              titleColor: "#000",
              titleFont: { weight: "normal" },
              bodyColor: "#2F3032",
              cornerRadius: 12,
              boxPadding: 3,
              usePointStyle: true,
              borderWidth: 0,
              font: {
                size: 14,
              },
              caretSize: 9,
              bodySpacing: 100,
            },
            legend: {
              position: "top",
              display: false,
            },
            title: {
              display: false,
              text: "Sell History",
            },
          },
        },
      });
    </script>
@endsection
