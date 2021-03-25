<label class="mb-0 pb-2">{{ $label }}</label>
<div class="border mb-4 p-1 rounded @error($name) border-danger @enderror">
    <div class="input-group">
        <div class="custom-file">
            <input accept="image/x-png,image/gif,image/jpeg" name="{{ $name }}" type="file"
                onchange="document.getElementById('{{ $name }}').src = window.URL.createObjectURL(this.files[0]); document.getElementById('{{ $name.'_pre' }}').href = window.URL.createObjectURL(this.files[0])">
        </div>
    </div>
    <div class="rounded-lg text-center image-preview">
        @if(Request::is('customer/pending/*/edit') && $customer->$key != null)
        <a id="{{ $name."_pre" }}" href="{{ url('image/show/'.$customer->$key->slug) }}">
            <img id="{{ $name }}" src="{{ url('image/thumbnail/'.$customer->$key->slug) }}" style="height: 150px" />
        </a>
        @elseif(Request::is('admin/products/*/edit'))
        <a id="{{ $name."_pre" }}" href="{{ url('image/show/'.$product->image->slug) }}">
            <img id="{{ $name }}" src="{{ url('image/thumbnail/'.$product->image->slug) }}" style="height: 150px" />
        </a>
        @else
        <a id="{{ $name."_pre" }}" href="{{ $placeholderImage }}">
            <img id="{{ $name }}" src="{{ $placeholderImage }}" class="img-fluid" style="height: 150px" />
        </a>
        @endif
    </div>
</div>
