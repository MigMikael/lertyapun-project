@extends('template.admin')

@section('content')
<div class="admin-container">
    <h4 class="title">แดชบอร์ด</h4>
    <span>ภาพรวมสถานะภายในระบบ</span>
    <hr>
    <div class="row">
        <div class="col-md-6 col-lg-4">
            <div class="card form-group">
                <div class="card-header dashboard-card-header">
                    <h5>ลูกค้าที่ใช้งาน</h5>
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
                    <h5>ลูกค้ารออนุมัติ</h5>
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
                    <h5>ลูกค้าที่ถูกระงับ</h5>
                </div>
                <div class="card-body">
                    <a href="{{ url('admin/customers') }}">
                        <h4>{{ $customerSuspend }}</h4>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <strong>กราฟแสดงภาพรวมผู้ใช้งาน</strong>
            <div id="customer-chart"></div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="card form-group">
                <div class="card-header dashboard-card-header">
                    <h5>คำสั่งซื้อรออนุมัติ</h5>
                </div>
                <div class="card-body">
                    <a href="{{ url('admin/orders') }}">
                        <h4>{{ $orderPending }}</h4>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="card form-group">
                <div class="card-header dashboard-card-header">
                    <h5>คำสั่งซื้อรอชำระเงิน</h5>
                </div>
                <div class="card-body">
                    <a href="{{ url('admin/orders') }}">
                        <h4>{{ $orderPayment }}</h4>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="card form-group">
                <div class="card-header dashboard-card-header">
                    <h5>คำสั่งซื้อสำเร็จ</h5>
                </div>
                <div class="card-body">
                    <a href="{{ url('admin/orders') }}">
                        <h4>{{ $orderSuccess }}</h4>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="card form-group">
                <div class="card-header dashboard-card-header">
                    <h5>คำสั่งซื้อที่ยกเลิก</h5>
                </div>
                <div class="card-body">
                    <a href="{{ url('admin/orders') }}">
                        <h4>{{ $orderCancel }}</h4>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <strong>กราฟแสดงภาพรวมคำสั่งซื้อ</strong>
            <div id="order-chart"></div>
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
            ['ลูกค้าที่ใช้งาน'],
            ['ลูกค้ารออนุมัติ'],
            ['ลูกค้าที่ถูกระงับ'],
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
        var orderSuccess = {{ $orderSuccess }};  
        var orderCancel = {{ $orderCancel }};  
        var options = {
          series: [{
          data: [orderPending, orderPayment, orderSuccess, orderCancel]
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

