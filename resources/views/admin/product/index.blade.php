@extends('template.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mt-4">Product</h1>
        <div>
            <a class="btn btn-primary" href="{{ url("admin/products/create") }}">
                <i class="fas fa-plus"></i>
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
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
