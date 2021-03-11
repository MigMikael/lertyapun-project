@extends('template.admin')

@section('content')
<div style="margin: 30px">
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mt-4 mb-1">Customer</h1>
        <div class="d-flex mt-4 mb-1">
            @include('admin.customer._sort')
            <div>
                <a class="btn btn-primary" href="{{ url("admin/customers/create") }}">
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
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Phone</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
                <th scope="col">View</th>
            </tr>
            </thead>
            <tbody>
                @foreach($customers as $customer)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $customer->first_name }} {{ $customer->last_name }}</td>
                        <td>{{ $customer->phone }}</td>
                        <td>
                            @if($customer->status == 'active')
                            <span class="badge badge-success" style="width: 60px">Active</span>
                            @elseif($customer->status == 'pending')
                            <span class="badge badge-warning" style="width: 60px">Pending</span>
                            @elseif($customer->status == 'suspend')
                            <span class="badge badge-secondary" style="width: 60px">Suspend</span>
                            @elseif($customer->status == 'inactive')
                            <span class="badge badge-danger" style="width: 60px">Inactive</span>
                            @endif
                        </td>
                        <td>
                            {!! Form::model($customer, [
                                'method' => 'delete',
                                'url' => 'admin/customers/'.$customer->slug,
                                'class' => 'form-inline']) !!}
                            <a class="btn btn-warning btn-sm" href="{{ url('admin/customers/'.$customer->slug.'/edit') }}">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn btn-danger btn-sm" type="submit" style="margin-left: 5px">
                                <i class="fas fa-trash"></i>
                            </button>
                            {!! Form::close() !!}
                        </td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="{{ url('admin/customers/'.$customer->slug) }}">
                                <i class="fas fa-external-link-square-alt"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $customers->render("pagination::bootstrap-4") }}
</div>
@endsection
