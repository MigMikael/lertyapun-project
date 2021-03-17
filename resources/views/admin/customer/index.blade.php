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
        <div class="col-md-12">
            <hr>
        </div>
        <div class="col-md-12">
            {!! Form::open(['method' => 'post', 'url' => 'admin/customers/search']) !!}
            <div class="input-group">
                @if ($search != '')
                <input name="query" value="{{ $search }}" type="text" class="form-control" placeholder="ค้นหาตามชื่อผู้ใช้งาน">
                @else
                <input name="query" type="text" class="form-control" placeholder="ค้นหาตามชื่อผู้ใช้งาน">
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
            </tr>
            </thead>
            <tbody>
                @foreach($customers as $customer)
                    <tr>
                        <th onclick="window.location='{{ url('admin/customers/'.$customer->slug) }}'">
                            {{ $loop->iteration }}
                        </th>
                        <td onclick="window.location='{{ url('admin/customers/'.$customer->slug) }}'">
                            {{ $customer->first_name }} {{ $customer->last_name }}
                        </td>
                        <td onclick="window.location='{{ url('admin/customers/'.$customer->slug) }}'">
                            {{ $customer->email }}
                        </td>
                        <td onclick="window.location='{{ url('admin/customers/'.$customer->slug) }}'">
                            {{ $customer->phone }}
                        </td>
                        <td class="text-center" onclick="window.location='{{ url('admin/customers/'.$customer->slug) }}'">
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
                            <div class="dropdown">
                                <button type="button" class="btn btn-default btn-sm" data-toggle="dropdown" onclick="event.preventDefault()'">
                                    <i class="fa fa-ellipsis-v"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="{{ url('admin/customers/'.$customer->slug.'/edit') }}">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    {!! Form::model($customer, [
                                        'method' => 'delete',
                                        'url' => 'admin/customers/'.$customer->slug,
                                        'class' => '']) !!}
                                    <button class="dropdown-item text-danger" type="submit">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $customers->render("pagination::bootstrap-4") }}
</div>
@endsection
