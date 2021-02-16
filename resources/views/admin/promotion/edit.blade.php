@extends('template.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mt-4">Edit Promotion</h1>
    </div>
    <hr>
    {!! Form::model($promotion, ['url' => 'admin/promotions/'.$promotion->slug, 'method' => 'put', 'files' => 'true']) !!}
        @include('admin.promotion._form')
        <button type="submit" class="btn btn-primary">Submit</button>
    {!! Form::close() !!}
@endsection
