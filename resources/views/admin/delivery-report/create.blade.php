@extends('template.admin')

@section('content')
    <div class="admin-container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="title">เพิ่มการแจ้งจัดส่งสินค้า</h4>
                <span>เจ้าหน้าที่สามารถเพิ่มการแจ้งจัดส่งสินค้า</span>
            </div>
        </div>
        <hr>
        <form action="{{ route('admin.delivery.report.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>วันที่จัดส่ง (วัน/เดือน/ปี)<span class="required">*</span></label>
                        <input type="date" class="form-control" name="delivery_date"
                            value="" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>ร้านขายยา <span class="required">*</span></label>
                        <select class="form-control select2" name="customer_id" required
                        style="width:100%;">
                            <option value="">กรุณาระบุร้านขายยา</option>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->store_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>ผู้ให้บริการขนส่ง <span class="required">*</span></label>
                        <select class="form-control select2" name="delivery_id" required
                        style="width:100%;">
                            <option value="">กรุณาระบุผู้ให้บริการขนส่ง</option>
                            @foreach ($deliveries as $delivery)
                                <option value="{{ $delivery->id }}">{{ $delivery->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>หมายเลขพัสดุ <span class="required">*</span></label>
                        <input type="text" class="form-control" name="delivery_tracking" value="" required>
                    </div>
                </div>
                <div class="col-md-12 mt-3">
                    <button type="submit" class="btn btn-primary btn-block">เพิ่มการแจ้งจัดส่งสินค้า</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>
        $('.select2').select2();
    </script>
@endsection
