@extends('template.admin')

@section('content')
<div class="admin-container">
    <div class="row">
        <div class="col-md-6">
            <h4 class="title">สินค้า</h4>
            <span>รายการสินค้าทั้งหมด</span>
        </div>
        <div class="col-md-6">
            <div class="pull-right">
            @include('admin.product._sort')
                <a class="btn btn-primary" href="{{ url("admin/products/create") }}">
                    <i class="fas fa-plus"></i>
                    เพิ่มสินค้า
                </a>
            </div>
        </div>
        <div class="col-md-12">
            <hr>
        </div>
        <div class="col-md-12">
            {!! Form::open(['method' => 'post', 'url' => 'admin/products/search']) !!}
            <div class="input-group admin-search-wrapper">
                @if ($search != '')
                <input name="query" value="{{ $search }}" type="text" class="form-control" placeholder="ค้นหาตาม ชื่อสินค้า" autocomplete="off">
                @else
                <input name="query" type="text" class="form-control" placeholder="ค้นหาตาม ชื่อสินค้า" autocomplete="off">
                @endif
                <div class="input-group-append">
                    <button class="btn btn-light" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

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

    @if (count($products) === 0)
    <div class="text-center">
        <img class="search-no-result-img" src="{{ url('img/no-result.png') }}">
        <h5>ไม่พบข้อมูล</h5>
    </div>
    @else
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">รูปสินค้า</th>
                <th scope="col">ชื่อสินค้า</th>
                <th class="text-center">สถานะสินค้า</th>
                <th class="text-center">จัดการ</th>
                <th class="text-center">ดูข้อมูล</th>
            </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <th>
                            {{ $loop->iteration }}
                        </th>
                        <td>
                            <img src="{{ url('image/show/'.$product->image->slug) }}" class="admin-img-table img-fluid" alt="{{ $product->name }}">
                        </td>
                        <td>
                            {{ $product->name }}
                        </td>
                        <td class="text-center">
                            @if($product->status == 'active')
                            <span class="badge badge-success">กำลังใช้งาน</span>
                            @elseif($product->status == 'suspend')
                            <span class="badge badge-danger-secondary">ระงับการใช้งาน</span>
                            @elseif($product->status == 'inactive')
                            <span class="badge badge-danger">ไม่ได้ใช้งาน</span>
                            @endif
                        </td>
                        <!--
                        <td class="text-right" onclick="window.location='{{ url('admin/products/'.$product->slug) }}'">
                            {{ number_format($product->units['0']->pricePerUnit) }}
                        </td>
                        <td class="text-right" onclick="window.location='{{ url('admin/products/'.$product->slug) }}'">
                            {{ number_format($product->quantity) }} {{ $product->units['0']->unitName }}
                        </td>
                        -->
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="{{ url('admin/products/'.$product->slug.'/edit') }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                {!! Form::model($product, [
                                    'method' => 'delete',
                                    'url' => 'admin/products/'.$product->slug,
                                    'class' => '']) !!}
                                <button class="btn btn-danger btn-sm delete-action ml-2">
                                    <i class="fas fa-trash"></i>
                                </button>
                                {!! Form::close() !!}
                            </div>
                        </td>
                        <td class="text-center">
                            <a class="btn btn-primary btn-sm" href="{{ url('admin/products/'.$product->slug) }}">
                                <i class="fas fa-external-link-square-alt"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
    <div class="d-flex justify-content-center">
        {{ $products->render("pagination::bootstrap-4") }}
    </div>
</div>
@endsection

@section('script')
<script>
    $('.delete-action').click(function(e){
        e.preventDefault()
        if (confirm('Are you sure?')) {
            $(e.target).closest('form').submit()
        }
    })
</script>
@endsection
