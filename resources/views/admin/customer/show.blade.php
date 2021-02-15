@extends('template.admin')

@section('head')
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.10.0/css/lightgallery.min.css" integrity="sha512-gk6oCFFexhboh5r/6fov3zqTCA2plJ+uIoUx941tQSFg6TNYahuvh1esZVV0kkK+i5Kl74jPmNJTTaHAovWIhw==" crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.10.0/js/lightgallery-all.min.js" integrity="sha512-Qpvw3WG46QyOqV/YS9BosbxEbMKPREA+QS+iWAKXfvb/87tdfsGGQdT7vqYbQzBOgLvF2I/MHMacA86oURHsCw==" crossorigin="anonymous"></script> --}}
<link href="{{ URL::asset('css/lightgallery.min.css') }}" rel="stylesheet">
<script src="{{ URL::asset('js/lightgallery-all.min.js') }}"></script>
@endsection

@section('content')
    <div class="row" style="margin-top: 15px">
        <div class="col-md-8 col-xs-6" style="border: 0px solid black;">
            <h1 class="mt-4">
                {{ $customer->first_name }}{{ $customer->last_name }}
                @if($customer->status == 'active')
                <span class="badge badge-success">Active</span>
                @elseif($customer->status == 'pending')
                <span class="badge badge-warning">Pending</span>
                @elseif($customer->status == 'suspend')
                <span class="badge badge-secondary">Suspend</span>
                @elseif($customer->status == 'inactive')
                <span class="badge badge-danger">Inactive</span>
                @endif
            </h1>
            <p>Email: {{ $customer->email }}</p>
            <p>Phone: {{ $customer->phone }}</p>
        </div>
    </div>
    <br>
    <hr>
    <br>
    <div id="aniimated-thumbnials" class="row">
        <a class="col-md-2" href="{{ url('image/show/'.$customer->proofImage->slug) }}">
            <img src="{{ url('image/show/'.$customer->proofImage->slug) }}" style="width: 100%" class="img-fluid" alt="{{ $customer->first_name }}">
        </a>

        <a class="col-md-2" href="{{ url('image/show/'.$customer->proofImage->slug) }}">
            <img src="{{ url('image/show/'.$customer->proofImage->slug) }}" style="width: 100%" class="img-fluid" alt="{{ $customer->first_name }}">
        </a>

        <a class="col-md-2" href="{{ url('image/show/'.$customer->proofImage->slug) }}">
            <img src="{{ url('image/show/'.$customer->proofImage->slug) }}" style="width: 100%" class="img-fluid" alt="{{ $customer->first_name }}">
        </a>

        <a class="col-md-2" href="{{ url('image/show/'.$customer->proofImage->slug) }}">
            <img src="{{ url('image/show/'.$customer->proofImage->slug) }}" style="width: 100%" class="img-fluid" alt="{{ $customer->first_name }}">
        </a>

        <a class="col-md-2" href="{{ url('image/show/'.$customer->proofImage->slug) }}">
            <img src="{{ url('image/show/'.$customer->proofImage->slug) }}" style="width: 100%" class="img-fluid" alt="{{ $customer->first_name }}">
        </a>

        <a class="col-md-2" href="{{ url('image/show/'.$customer->proofImage->slug) }}">
            <img src="{{ url('image/show/'.$customer->proofImage->slug) }}" style="width: 100%" class="img-fluid" alt="{{ $customer->first_name }}">
        </a>
    </div>
@endsection

@section('script')
    <script>
        $('#aniimated-thumbnials').lightGallery({
            thumbnail:true
        });
    </script>
@endsection
