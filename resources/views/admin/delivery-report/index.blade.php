@extends('template.admin')

@section('content')
    <div class="admin-container">
        <div class="row">
            <div class="col-md-6">
                <h4 class="title">แจ้งจัดส่งสินค้า</h4>
                <span>รายการแจ้งจัดส่งสินค้าทั้งหมด</span>
            </div>
            <div class="col-md-6">
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('admin.delivery.report.create') }}">
                        <i class="fas fa-plus"></i>
                        เพิ่มแจ้งจัดส่งสินค้า
                    </a>
                </div>
            </div>
            <div class="col-md-12">
                <hr>
            </div>
        </div>
        <form action="{{ route('admin.delivery.report.index') }}">
            <div class="row">
                <div class="col-lg-4 form-group">
                    <label>วันที่</label>
                    <input type="date" class="form-control" name="filter_date" value="{{ $filterDate }}"
                    onfocus="this.showPicker()">
                </div>
                <div class="col-lg-4 form-group">
                    <label>ผู้รับสินค้า (ร้านยา/อื่นๆ)</label>
                    <select class="form-control select2" name="filter_customer" style="width:100%;">
                        <option value="">ทั้งหมด</option>
                        <option value="other" {{ $filterCustomer == "other" ? 'selected' : '' }}>อื่นๆ</option>
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}" {{ $customer->id == $filterCustomer ? 'selected' : '' }}>
                                {{ $customer->store_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-4 form-group">
                    <label>ผู้ให้บริการขนส่ง</label>
                    <select class="form-control select2" name="filter_delivery" style="width:100%;">
                        <option value="">ทั้งหมด</option>
                        @foreach ($deliveries as $delivery)
                            <option value="{{ $delivery->id }}" {{ $delivery->id == $filterDelivery ? 'selected' : '' }}>
                                {{ $delivery->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-12 form-group">
                    <label>หมายเลขพัสดุ</label>
                    <div class="input-group">
                        @if ($filterTracking != '')
                            <input name="filter_tracking" value="{{ $filterTracking }}" type="text" class="form-control"
                                placeholder="ค้นหาตาม หมายเลขพัสดุ" autocomplete="off">
                        @else
                            <input name="filter_tracking" type="text" class="form-control"
                                placeholder="ค้นหาตาม หมายเลขพัสดุ" autocomplete="off">
                        @endif
                        <div class="input-group-append">
                            <button class="btn btn-light" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{ session('success', 'Success !') }}
            </div>
        @endif
        @if (session('fail'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{ session('fail', 'Fail !') }}
            </div>
        @endif
        @if (count($deliveryReports) === 0)
            <div class="text-center">
                <img class="search-no-result-img" src="{{ url('img/no-result.png') }}">
                <h5>ไม่พบข้อมูล</h5>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col" width="5%">#</th>
                            <th>วันที่</th>
                            <th style="min-width: 200px;">ผู้รับสินค้า</th>
                            <th style="min-width: 200px;">ผู้ให้บริการขนส่ง</th>
                            <th style="min-width: 200px;">หมายเลขพัสดุ</th>
                            <th style="min-width: 100px;" class="text-center">จำนวนลังที่จัดส่ง</th>
                            <th>จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($deliveryReports as $deliveryReport)
                            <tr>
                                <th>
                                    {{ $deliveryReports->firstItem() + $loop->index }}
                                </th>
                                <td>
                                    {{ \Carbon\Carbon::parse($deliveryReport->delivery_date)->format('d/m/Y') }}
                                </td>
                                <td>
                                    {{ $deliveryReport->customer_name }}
                                </td>
                                <td>
                                    {{ $deliveryReport->delivery_name }}
                                </td>
                                <td>
                                    {{ $deliveryReport->delivery_tracking }}
                                </td>
                                <td class="text-center">
                                    {{ $deliveryReport->delivery_amount }}
                                </td>
                                <td>
                                    <div class="input-group">
                                        <a href="{{ route('admin.delivery.report.edit', $deliveryReport->id) }}"
                                            class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.delivery.report.destroy', $deliveryReport->id) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm delete-action ml-2">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        <div class="d-flex justify-content-center">
            {{ $deliveryReports->render('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('.select2').select2();

        $('.delete-action').click(function(e) {
            e.preventDefault()
            if (confirm('คุณแน่ใจที่จะลบข้อมูลดังกล่าว หากลบแล้วจะไม่สามารถกู้คืนข้อมูลได้ ?')) {
                $(e.target).closest('form').submit()
            }
        });
    </script>
@endsection
