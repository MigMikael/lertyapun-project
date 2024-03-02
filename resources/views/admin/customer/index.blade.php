@extends('template.admin')

@section('content')
<div class="admin-container">
    <div class="row">
        <div class="col-md-6">
            <h4 class="title">บัญชีผู้ใช้งาน</h4>
            <span>รายการบัญชีผู้ใช้งานทั้งหมดในระบบ</span>
        </div>
        <div class="col-md-6">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ url("admin/customers/create") }}">
                    <i class="fas fa-plus"></i>
                    เพิ่มผู้ใช้งาน
                </a>
            </div>
        </div>
        <div class="col-md-12">
            <hr>
        </div>
        <div class="col-md-12">
            {!! Form::open(['method' => 'post', 'url' => 'admin/customers/search']) !!}
            <div class="input-group admin-search-wrapper">
                @if ($search != '')
                <input name="query" value="{{ $search }}" type="text" class="form-control" placeholder="ค้นหาตาม ชื่อ, นามสกุล, อีเมล" autocomplete="off">
                @else
                <input name="query" type="text" class="form-control" placeholder="ค้นหาตาม ชื่อ, นามสกุล, อีเมล" autocomplete="off">
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

    @if (count($customers) === 0)
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
                <th scope="col">ชื่อร้าน</th>
                <th scope="col">ชื่อ-นามสกุล</th>
                <th scope="col">อีเมล</th>
                <th scope="col">เบอร์โทรศัพท์</th>
                <th scope="col" class="text-center">สถานะ</th>
                <th scope="col" class="text-center">จัดการ</th>
                <th scope="col" class="text-center">ดูข้อมูล</th>
            </tr>
            </thead>
            <tbody>
                @foreach($customers as $customer)
                    <tr>
                        <th>
                            {{ $customers->firstItem() + $loop->index }}
                        </th>
                        <td>
                            {{ $customer->store_name }}
                        </td>
                        <td>
                            {{ $customer->first_name }} {{ $customer->last_name }}
                        </td>
                        <td>
                            {{ $customer->email }}
                        </td>
                        <td>
                            {{ $customer->phone }}
                        </td>
                        <td class="text-center">
                            @if($customer->status == 'active')
                            <span class="badge badge-success">กำลังใช้งาน</span>
                            @elseif($customer->status == 'pending')
                            <span class="badge badge-warning">รอดำเนินการ</span>
                            @elseif($customer->status == 'suspend')
                            <span class="badge badge-danger-secondary">ระงับการใช้งาน</span>
                            @elseif($customer->status == 'inactive')
                            <span class="badge badge-danger">รีเซ็ตรหัสผ่าน</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="{{ url('admin/customers/'.$customer->slug.'/edit') }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                {!! Form::model($customer, [
                                    'method' => 'delete',
                                    'url' => 'admin/customers/'.$customer->slug,
                                    'class' => '']) !!}
                                <button class="btn btn-danger btn-sm delete-action ml-2">
                                    <i class="fas fa-trash"></i>
                                </button>
                                {!! Form::close() !!}
                            </div>
                        </td>
                        <td class="text-center">
                            <a class="btn btn-primary btn-sm" href="{{ url('admin/customers/'.$customer->slug) }}">
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
        {{ $customers->render("pagination::bootstrap-4") }}
    </div>
</div>
@endsection

@section('script')
<script>
    $('.delete-action').click(function(e){
        e.preventDefault()
        if (confirm('คุณแน่ใจที่จะลบข้อมูลดังกล่าว หากลบแล้วจะไม่สามารถกู้คืนข้อมูลได้ ?')) {
            $(e.target).closest('form').submit()
        }
    });
</script>
@endsection
