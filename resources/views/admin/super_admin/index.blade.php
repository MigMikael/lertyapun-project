@extends('template.admin')

@section('content')
<div class="admin-container">
    <div class="row">
        <div class="col-md-6">
            <h4 class="title">บัญชีผู้ดูแล</h4>
            <span>รายการบัญชีผู้ดูแลทั้งหมดในระบบ</span>
        </div>
        <div class="col-md-6">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ url("admin/super_admins/create") }}">
                    <i class="fas fa-plus"></i>
                    เพิ่มผู้ดูแล
                </a>
            </div>
        </div>
        <div class="col-md-12">
            <hr>
        </div>
        <div class="col-md-12">
            {!! Form::open(['method' => 'post', 'url' => 'admin/super_admins/search']) !!}
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

    @if (count($super_admins) === 0)
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
                <th scope="col">ชื่อ</th>
                <th scope="col">อีเมล</th>
                <th scope="col" class="text-center">จัดการ</th>
            </tr>
            </thead>
            <tbody>
                @foreach($super_admins as $super_admin)
                    <tr>
                        <th>
                            {{ $super_admins->firstItem() + $loop->index }}
                        </th>
                        <td>
                            {{ $super_admin->name }}
                        </td>
                        <td>
                            {{ $super_admin->email }}
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="{{ url('admin/super_admins/'.$super_admin->slug.'/edit') }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
    <div class="d-flex justify-content-center">
        {{ $super_admins->render("pagination::bootstrap-4") }}
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
