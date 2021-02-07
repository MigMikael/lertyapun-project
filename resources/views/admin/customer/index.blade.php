@extends('template.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mt-4">Customer</h1>
        <div>
            <a class="btn btn-primary" href="{{ url("admin/customers/create") }}">
                <i class="fas fa-plus"></i>
            </a>
        </div>
    </div>

    <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Phone</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $customer->first_name }} {{ $customer->last_name }}</td>
                    <td>{{ $customer->phone }}</td>
                    <td>{{ $customer->status }}</td>
                    <td>
                        {!! Form::model($customer, [
                            'method' => 'delete',
                            'url' => 'admin/customers/'.$customer->slug,
                            'class' => 'form-inline']) !!}
                        <a class="btn btn-warning btn-sm" href="{{ url('admin/customers/'.$customer->slug.'/edit') }}">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button class="btn btn-danger btn-sm" type="submit">
                            <i class="fas fa-trash"></i>
                        </button>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $customers->render("pagination::bootstrap-4") }}
@endsection
