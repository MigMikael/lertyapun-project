@extends('template.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mt-4">Promotion (Tag)</h1>
        <div>
            <a class="btn btn-primary" href="{{ url("admin/tags/create") }}">
                <i class="fas fa-plus"></i>
            </a>
        </div>
    </div>

    <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach($tags as $tag)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $tag->name }}</td>
                    <td>
                        {!! Form::model($tag, [
                            'method' => 'delete',
                            'url' => 'admin/tags/'.$tag->slug,
                            'class' => 'form-inline']) !!}
                        <a class="btn btn-warning btn-sm" href="{{ url('admin/tags/'.$tag->slug.'/edit') }}">
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
    {{ $tags->render("pagination::bootstrap-4") }}
@endsection
