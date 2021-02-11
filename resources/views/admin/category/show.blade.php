@extends('template.admin')

@section('head')
    <script src="{{ URL::asset('tagify/jQuery.tagify.min.js') }}"></script>
    <link href="{{ URL::asset('tagify/tagify.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/tag.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="row" style="margin-top: 15px">
        <div class="col-md-8 col-xs-6" style="border: 0px solid black;">
            <h1 class="mt-4">Category > {{ $category->name }}</h1>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Actions</th>
                <th>View</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->quantity }} {{ $product->unit }}</td>
                    <td>
                        {!! Form::model($product, [
                            'method' => 'delete',
                            'url' => 'admin/categories/' . $category->slug . '/' . 'products/' . $product->slug,
                            'class' => 'form-inline']) !!}
                            <button class="btn btn-danger btn-sm" type="submit">
                                <i class="fas fa-trash"></i>
                                นำสินค้าออก
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
    <br>
    <br>
@endsection
