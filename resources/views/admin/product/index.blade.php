@extends('template.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mt-4 mb-1">Product</h1>
        <div class="d-flex mt-4 mb-1" style="flex-direction: row">
            {!! Form::open(['method' => 'post', 'url' => 'admin/products/search']) !!}
            <div class="input-group" style="height: 30px">
                @if ($search != '')
                <input name="query" value="{{ $search }}" type="text" class="form-control" placeholder="Search">
                @else
                <input name="query" type="text" class="form-control" placeholder="Search">
                @endif
                <div class="input-group-append">
                    <button class="btn btn-info" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
            {!! Form::close() !!}
            @include('admin.product._sort')
            <div>
                <a class="btn btn-primary" href="{{ url("admin/products/create") }}" style="height: 38px; width:80px">
                    <i class="fas fa-plus"></i>
                    Add
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
        <table class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Image</th>
                <th scope="col">Name</th>
                <th scope="col">Price(฿)</th>
                <th scope="col">Quantity</th>
                <th scope="col">Action</th>
                <th scope="col">View</th>
            </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>
                            <img src="{{ url('image/thumbnail/'.$product->image->slug) }}" style="height: 30px; width: 30px" class="img-fluid" alt="{{ $product->name }}">
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>
                            {!! Form::model($product, [
                                'method' => 'delete',
                                'url' => 'admin/products/'.$product->slug,
                                'class' => 'form-inline']) !!}
                            <a class="btn btn-warning btn-sm" href="{{ url('admin/products/'.$product->slug.'/edit') }}">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn btn-danger btn-sm" type="submit" style="margin-left: 5px">
                                <i class="fas fa-trash"></i>
                            </button>
                            {!! Form::close() !!}
                        </td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="{{ url('admin/products/'.$product->slug) }}">
                                <i class="fas fa-external-link-square-alt"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $products->render("pagination::bootstrap-4") }}
@endsection
