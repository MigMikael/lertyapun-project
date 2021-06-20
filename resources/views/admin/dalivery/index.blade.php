@extends('template.admin')

@section('content')
<div class="admin-container">
    <div class="row">
        <div class="col-md-6">
            <h4 class="title">บริการขนส่ง</h4>
            <span>รายการบริการขนส่งทั้งหมด</span>
        </div>
        <div class="col-md-6">
            <div class="pull-right">
                {{-- @include('admin.promotion._sort') --}}
                <a class="btn btn-primary" href="{{ url("admin/deliveries/create") }}">
                    <i class="fas fa-plus"></i>
                    เพิ่มบริการขนส่ง
                </a>
            </div>
        </div>
        <div class="col-md-12">
            <hr>
        </div>
        <div class="col-md-12">
            {!! Form::open(['method' => 'post', 'url' => 'admin/deliveries/search']) !!}
            <div class="input-group admin-search-wrapper">
                @if ($search != '')
                <input name="query" value="{{ $search }}" type="text" class="form-control" placeholder="ค้นหาตาม ชื่อบริการขนส่ง" autocomplete="off">
                @else
                <input name="query" type="text" class="form-control" placeholder="ค้นหาตาม ชื่อบริการขนส่ง" autocomplete="off">
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

    @if (count($deliveries) === 0)
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
                <th scope="col" width="65%">บริการขนส่ง</th>
                <th class="text-center">สถานะ</th>
                <th class="text-center">จัดการ</th>
              </tr>
            </thead>
            <tbody>
                @foreach($deliveries as $dalivery)
                    <tr>
                        <th>
                            {{ $deliveries->firstItem() + $loop->index }}
                        </th>
                        <td>
                            {{ $dalivery->name }}
                        </td>
                        <td class="text-center">
                            {{ $dalivery->status }}
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="{{ url('admin/deliveries/'.$dalivery->slug.'/edit') }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                {!! Form::model($dalivery, [
                                    'method' => 'delete',
                                    'url' => 'admin/deliveries/'.$dalivery->slug,
                                    'class' => '']) !!}
                                <button class="btn btn-danger btn-sm delete-action ml-2">
                                    <i class="fas fa-trash"></i>
                                </button>
                                {!! Form::close() !!}
                            </div>
                        </td>
                        {{-- <td class="text-center">
                            <a class="btn btn-primary btn-sm" href="{{ url('admin/deliveries/'.$dalivery->slug) }}">
                                <i class="fas fa-external-link-square-alt"></i>
                            </a>
                        </td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
    <div class="d-flex justify-content-center">
        {{ $deliveries->render("pagination::bootstrap-4") }}
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
