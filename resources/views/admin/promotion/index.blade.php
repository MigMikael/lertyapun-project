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
                @include('admin.tag._sort')
            <a class="btn btn-primary" href="{{ url("admin/promotions/create") }}">
                <i class="fas fa-plus"></i>
                เพิ่มโปรโมชัน
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
                <th scope="col">โปรโมชัน</th>
                <th scope="col" class="text-center">การจัดการ</th>
                <th scope="col" class="text-center">ดูข้อมูล</th>
              </tr>
            </thead>
            <tbody>
                @foreach($promotions as $promotion)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $promotion->name }}</td>
                        <td class="text-center">
                            {!! Form::model($promotion, [
                                'method' => 'delete',
                                'url' => 'admin/promotions/'.$promotion->slug,
                                'class' => '']) !!}
                            <a class="btn btn-warning btn-sm" href="{{ url('admin/promotions/'.$promotion->slug.'/edit') }}">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn btn-danger btn-sm" type="submit" style="margin-left: 5px">
                                <i class="fas fa-trash"></i>
                            </button>
                            {!! Form::close() !!}
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
