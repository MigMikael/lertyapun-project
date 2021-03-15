@extends('template.admin')

@section('content')
<div class="admin-container">
    <div class="row">
        <div class="col-md-6">
            <h4 class="title">การจัดการบัญชีผู้ใช้งาน</h4>
            <span>บัญชีผู้ใช้งานทั้งหมดในระบบ</span>
        </div>
        <div class="col-md-6">
            <div class="pull-right">
                @include('admin.customer._sort')
                <a class="btn btn-primary" href="{{ url("admin/customers/create") }}">
                    <i class="fas fa-plus"></i>
                    เพิ่มผู้ใช้งาน
                </a>
            </div>
        </div>
    </div>

    <div class="mb-2" style="width: 100%; height: 40px">
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
    </div>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">ชื่อ-นามสกุล</th>
                <th scope="col">อีเมล</th>
                <th scope="col">เบอร์โทรศัพท์</th>
                <th scope="col" class="text-center">สถานะ</th>
                <th scope="col" class="text-center">การจัดการ</th>
                <th scope="col" class="text-center">ดูข้อมูล</th>
            </tr>
            </thead>
            <tbody>
                @foreach($customers as $customer)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $customer->first_name }} {{ $customer->last_name }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->phone }}</td>
                        <td class="text-center">
                            @if($customer->status == 'active')
                            <span class="badge badge-success">กำลังใช้งาน</span>
                            @elseif($customer->status == 'pending')
                            <span class="badge badge-warning">รอดำเนินการ</span>
                            @elseif($customer->status == 'suspend')
                            <span class="badge badge-secondary">ระงับการใช้งาน</span>
                            @elseif($customer->status == 'inactive')
                            <span class="badge badge-danger">ไม่ได้ใช้งานอยู่</span>
                            @endif
                        </td>
                        <td class="text-center">
                            {!! Form::model($customer, [
                                'method' => 'delete',
                                'url' => 'admin/customers/'.$customer->slug,
                                'class' => '']) !!}
                            <a class="btn btn-warning btn-sm" href="{{ url('admin/customers/'.$customer->slug.'/edit') }}">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn btn-danger btn-sm" type="submit" style="margin-left: 5px">
                                <i class="fas fa-trash"></i>
                            </button>
                            {!! Form::close() !!}
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
    {{ $customers->render("pagination::bootstrap-4") }}
</div>
@endsection
