@extends('template.admin')

@section('content')
<div class="admin-container">
    <div class="row">
        <div class="col-md-6">
            <h4 class="title">การจัดการโปรโมชัน</h4>
            <span>รายการโปรโมชันทั้งหมด</span>
        </div>
        <div class="col-md-6">
            <div class="pull-right">
                @include('admin.promotion._sort')
                <a class="btn btn-primary" href="{{ url("admin/promotions/create") }}">
                    <i class="fas fa-plus"></i>
                    เพิ่มโปรโมชัน
                </a>
            </div>
        </div>
        <div class="col-md-12">
            <hr>
        </div>
        <div class="col-md-12">
            {!! Form::open(['method' => 'post', 'url' => 'admin/promotions/search']) !!}
            <div class="input-group">
                @if ($search != '')
                <input name="query" value="{{ $search }}" type="text" class="form-control" placeholder="ค้นหาตามชื่อโปรโมชัน">
                @else
                <input name="query" type="text" class="form-control" placeholder="ค้นหาตามชื่อโปรโมชัน">
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
                <th scope="col" width="5%">#</th>
                <th scope="col" width="65%">โปรโมชัน</th>
                <th class="text-center">จัดการ</th>
                <th class="text-center">ดูข้อมูล</th>
              </tr>
            </thead>
            <tbody>
                @foreach($promotions as $promotion)
                    <tr>
                        <th onclick="window.location='{{ url('admin/promotions/'.$promotion->slug) }}'">
                            {{ $loop->iteration }}
                        </th>
                        <td onclick="window.location='{{ url('admin/promotions/'.$promotion->slug) }}'">
                            ลด {{ $promotion->name }}%
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="{{ url('admin/promotions/'.$promotion->slug.'/edit') }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                    แก้ไข
                                </a>
                                {!! Form::model($promotion, [
                                    'method' => 'delete',
                                    'url' => 'admin/promotions/'.$promotion->slug,
                                    'class' => '']) !!}
                                <button class="btn btn-danger btn-sm delete-action ml-2">
                                    <i class="fas fa-trash"></i> ลบ
                                </button>
                                {!! Form::close() !!}
                            </div>
                        </td>
                        <td class="text-center">
                            <a class="btn btn-primary btn-sm" href="{{ url('admin/promotions/'.$promotion->slug) }}">
                                <i class="fas fa-external-link-square-alt"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center">
        {{ $promotions->render("pagination::bootstrap-4") }}
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
    });
</script>
@endsection
