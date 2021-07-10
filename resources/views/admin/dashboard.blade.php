@extends('template.admin')

@section('content')
<style>
  .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
    color: #fff;
    background-color: #2e6bd3;
}
 
.nav-pills .nav-link > a {
    color: #2e6bd3;
}
</style>
<div class="admin-container">
  <h4 class="title">แดชบอร์ด</h4>
  <span>ภาพรวมสถานะภายในระบบ</span>
  <hr>
  <div class="row">
    <div class="col-md-12">
      <ul class="nav nav-pills mb-3 nav-justified" id="pills-tab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="user-tab" data-toggle="pill" href="#user" role="tab" aria-controls="user"
            aria-selected="false">ผู้ใช้งานทั้งหมด</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="order-tab" data-toggle="pill" href="#order" role="tab" aria-controls="order"
            aria-selected="false">คำสั่งซื้อทั้งหมด</a>
        </li>
      </ul>
      <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="user" role="tabpanel" aria-labelledby="user-tab">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <h4>สถานะผู้ใช้งานทั้งหมด</h4>
              </div>
            </div>
            <div class="col-md-6 col-lg-4">
              <div class="card form-group">
                <div class="card-header dashboard-card-header">
                  <h5>กำลังใช้งาน</h5>
                </div>
                <div class="card-body">
                  <a href="{{ url('admin/customers') }}">
                    <h4>{{ $customerActive }}</h4>
                  </a>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-4">
              <div class="card form-group">
                <div class="card-header dashboard-card-header">
                  <h5>รอดำเนินการ</h5>
                </div>
                <div class="card-body">
                  <a href="{{ url('admin/customers') }}">
                    <h4>{{ $customerPending }}</h4>
                  </a>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-4">
              <div class="card form-group">
                <div class="card-header dashboard-card-header">
                  <h5>ระงับการใช้งาน</h5>
                </div>
                <div class="card-body">
                  <a href="{{ url('admin/customers') }}">
                    <h4>{{ $customerSuspend }}</h4>
                  </a>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <h4>กราฟแสดงสถานะผู้ใช้งานทั้งหมด</h4>
              <div id="customer-chart"></div>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="order" role="tabpanel" aria-labelledby="order-tab">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <h4>สถานะคำสั่งซื้อทั้งหมด</h4>
              </div>
            </div>
            <div class="col-md-6 col-lg-4">
              <div class="card form-group">
                <div class="card-header dashboard-card-header">
                  <h5>รอการอนุมัติ</h5>
                </div>
                <div class="card-body">
                  <a href="{{ url('admin/orders') }}">
                    <h4>{{ $orderPending }}</h4>
                  </a>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-4">
              <div class="card form-group">
                <div class="card-header dashboard-card-header">
                  <h5>รอการชำระเงิน</h5>
                </div>
                <div class="card-body">
                  <a href="{{ url('admin/orders') }}">
                    <h4>{{ $orderPayment }}</h4>
                  </a>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-4">
              <div class="card form-group">
                <div class="card-header dashboard-card-header">
                  <h5>เครดิต</h5>
                </div>
                <div class="card-body">
                  <a href="{{ url('admin/orders') }}">
                    <h4>{{ $orderCredit }}</h4>
                  </a>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-4">
              <div class="card form-group">
                <div class="card-header dashboard-card-header">
                  <h5>สำเร็จ</h5>
                </div>
                <div class="card-body">
                  <a href="{{ url('admin/orders') }}">
                    <h4>{{ $orderSuccess }}</h4>
                  </a>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-4">
              <div class="card form-group">
                <div class="card-header dashboard-card-header">
                  <h5>ยกเลิก</h5>
                </div>
                <div class="card-body">
                  <a href="{{ url('admin/orders') }}">
                    <h4>{{ $orderCancel }}</h4>
                  </a>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <h4>กราฟแสดงสถานะคำสั่งซื้อทั้งหมด</h4>
              <div id="order-chart"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
@section('script')
<script>
  var customerActive = {{ $customerActive }};
        var customerPending = {{ $customerPending }}; 
        var customerSuspend = {{ $customerSuspend }};  
       var options = {
          series: [{
          data: [customerActive, customerPending, customerSuspend]
        }],
          chart: {
          height: 350,
          type: 'bar',
          events: {
            click: function(chart, w, e) {
              // console.log(chart, w, e)
            }
          }
        },
        plotOptions: {
          bar: {
            columnWidth: '25%',
            distributed: true,
          }
        },
        dataLabels: {
          enabled: false
        },
        legend: {
          show: false
        },
        xaxis: {
          categories: [
            ['กำลังใช้งาน'],
            ['รอดำเนินการ'],
            ['ระงับการใช้งาน'],
          ],
          labels: {
            style: {
              fontSize: '12px'
            }
          }
        }
        };

        var chart = new ApexCharts(document.querySelector("#customer-chart"), options);
        chart.render();
</script>
<script>
  var orderPending = {{ $orderPending }};
        var orderPayment = {{ $orderPayment }};
        var orderCredit = {{ $orderCredit }};  
        var orderSuccess = {{ $orderSuccess }};  
        var orderCancel = {{ $orderCancel }};  
        var options = {
          series: [{
          data: [orderPending, orderPayment, orderCredit, orderSuccess, orderCancel]
        }],
          chart: {
          height: 350,
          type: 'bar',
          events: {
            click: function(chart, w, e) {
              // console.log(chart, w, e)
            }
          }
        },
        plotOptions: {
          bar: {
            columnWidth: '35%',
            distributed: true,
          }
        },
        dataLabels: {
          enabled: false
        },
        legend: {
          show: false
        },
        xaxis: {
          categories: [
            ['คำสั่งซื้อรออนุมัติ'],
            ['คำสั่งซื้อรอชำระเงิน'],
            ['คำสั่งซื้อเครดิต'],
            ['คำสั่งซื้อสำเร็จ'],
            ['คำสั่งซื้อยกเลิก'],
          ],
          labels: {
            style: {
              fontSize: '12px'
            }
          }
        }
        };

        var chart = new ApexCharts(document.querySelector("#order-chart"), options);
        chart.render();
</script>
@endsection