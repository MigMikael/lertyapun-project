@extends('template.admin')

@section('content')
<div class="admin-container">
    <div class="row">
        <div class="col-md-6">
            <h4 class="title">โปรโมชัน</h4>
            <span>รายการโปรโมชันทั้งหมด</span>
        </div>
        <div class="col-md-6">
            <div class="pull-right">
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
            <div class="input-group admin-search-wrapper">
                @if ($search != '')
                <input name="query" value="{{ $search }}" type="text" class="form-control" placeholder="ค้นหาตาม ชื่อโปรโมชัน" autocomplete="off">
                @else
                <input name="query" type="text" class="form-control" placeholder="ค้นหาตาม ชื่อโปรโมชัน" autocomplete="off">
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

    @if (count($promotions) === 0)
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
                <th scope="col" width="40%">โปรโมชัน</th>
                <th scope="col" width="25%">ประเภท</th>
                <th class="text-center">จัดการ</th>
                <th class="text-center">ดูข้อมูล</th>
              </tr>
            </thead>
            <tbody>
                @foreach($promotions as $promotion)
                    <tr>
                        <th>
                            {{ $promotions->firstItem() + $loop->index }}
                        </th>
                        <td>
                            ลด {{ $promotion->name }}
                            @if($promotion->type == 'percent')
                            %
                            @elseif($promotion->type == 'discount')
                            บาท
                            @endif
                        </td>
                        <td>
                            @if($promotion->type == 'percent')
                            เปอร์เซ็นต์ (%)
                            @elseif($promotion->type == 'discount')
                            บาท (THB)
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="{{ url('admin/promotions/'.$promotion->slug.'/edit') }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                {!! Form::model($promotion, [
                                    'method' => 'delete',
                                    'url' => 'admin/promotions/'.$promotion->slug,
                                    'class' => '']) !!}
                                <button class="btn btn-danger btn-sm delete-action ml-2">
                                    <i class="fas fa-trash"></i>
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
    @endif
    <div class="d-flex justify-content-center">
        {{ $promotions->render("pagination::bootstrap-4") }}
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
