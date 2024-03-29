<label class="mb-0 pb-2">{{ $label }} @isset($required)
    <span class="required">*</span>
@endisset</label>
<div class="border mb-4 p-1 rounded @error($name) border-danger @enderror">
    <div class="input-group"><!--class custom-file-->
        <label class="btn btn-primary">
            <i class="fa fa-image"></i> อัพโหลดรูป
            <input accept="image/x-png,image/gif,image/jpeg" name="{{ $name }}" type="file" class="hidden"
                onchange="document.getElementById('{{ $name }}').src = window.URL.createObjectURL(this.files[0]); document.getElementById('{{ $name.'_pre' }}').href = window.URL.createObjectURL(this.files[0])">
        </label>
    </div><!--class custom-file-->
    <div class="rounded-lg image-preview">
        <div class="row">
            @if(Request::is('customer/pending/*/edit') && $customer->$key != null)
            <div class="col-md-4 form-group">
                <a id="{{ $name."_pre" }}" href="{{ url('image/show/'.$customer->$key->slug) }}">
                    <img id="{{ $name }}" src="{{ url('image/show/'.$customer->$key->slug) }}" style="width: 100%;" />
                </a>
            </div>
        @elseif(Request::is('admin/products/*/edit'))
        <div class="col-md-4 form-group">
            <a id="{{ $name."_pre" }}" href="{{ url('image/show/'.$product->image->slug) }}">
                <img id="{{ $name }}" src="{{ url('image/show/'.$product->image->slug) }}" style="width: 100%;" />
            </a>
        </div>
        @elseif(Request::is('admin/deliveries/*/edit'))
        <div class="col-md-4 form-group">
            <a id="{{ $name."_pre" }}" href="@if($delivery->image_id != null) {{ url('image/show/'.$delivery->image->slug) }} @endif">
                <img id="{{ $name }}" src="@if($delivery->image_id != null) {{ url('image/show/'.$delivery->image->slug) }} @else{{ URL::asset('img/placeholder-image.jpg') }}@endif" style="width: 100%;" />
            </a>
        </div>
        @elseif(Request::is('admin/banks/*/edit'))
        <div class="col-md-4 form-group">
            <a id="{{ $name."_pre" }}" href="@if($bank->image_id) {{ url('image/show/'.$bank->image->slug) }} @endif">
                <img id="{{ $name }}" src="@if($bank->image_id) {{ url('image/show/'.$bank->image->slug) }} @else{{ URL::asset('img/placeholder-image.jpg') }}@endif" style="width: 100%;" />
            </a>
        </div>
        @else
        <div class="col-md-4 form-group">
            <a id="{{ $name."_pre" }}">
                <img id="{{ $name }}" src="{{ $placeholderImage }}" class="img-fluid" style="width: 100%;" />
            </a>
        </div>
        @endif
        </div>
    </div>
</div>
