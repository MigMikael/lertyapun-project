@extends('template.customer')

@section('content')
    <section style="padding: 30px !important;">
        <div class="container" style="
        background: #FFF;
        padding: 25px;
        padding-top: 35px;
        padding-bottom: 35px;
        border-radius: 0.25rem;
        min-height: 85vh;
        box-shadow: 0 0.15rem 1.75rem 0 rgb(58 59 69 / 15%) !important;">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center">
                        <h4 class="title">แจ้งจัดส่งสินค้า</h4>
                    </div>
                </div>
                <div class="col-md-12">
                    <hr>
                </div>
            </div>
            <form action="{{ route('delivery.report.index') }}">
                <div class="row mt-2 mb-3">
                    <div class="col-lg-4 form-group">
                        <label>วันที่</label>
                        <input type="date" class="form-control" name="filter_date" value="{{ $filterDate }}"
                            onfocus="this.showPicker()">
                    </div>
                    <div class="col-lg-6 form-group">
                        <label>ผู้รับสินค้า</label>
                        <div class="input-group">
                            @if ($filterSearch != '')
                                <input name="filter_search" value="{{ $filterSearch }}" type="text"
                                    class="form-control" placeholder="ค้นหาตาม ชื่อผู้รับสินค้า" autocomplete="off">
                            @else
                                <input name="filter_search" type="text" class="form-control"
                                    placeholder="ค้นหาตาม ชื่อผู้รับสินค้า" autocomplete="off">
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-2 form-group">
                        <label class="search-wrapper-label">ค้นหา</label>
                        <button class="btn btn-light btn-block" type="submit" style="height: 40px;">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-md-12">
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
                                        <th>วันที่</th>
                                        <th>ผู้รับสินค้า</th>
                                        <th>ผู้ให้บริการขนส่ง</th>
                                        <th>หมายเลขพัสดุ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($deliveryReports as $deliveryReport)
                                        <tr>
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
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p class="text-muted text-center" style="margin-top: 5px; margin-bottom: 0px !important;">&copy;
                        LERTYAPHAN <?php echo date('Y'); ?>. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </footer>

@endsection
