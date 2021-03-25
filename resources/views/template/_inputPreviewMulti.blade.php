<script>
function preview_image()
{
    $('.multiple-image-preview').empty()

    var total_file = document.getElementById("multiple_upload_file").files.length
    var limit_file = 5;
    if (total_file > limit_file) {
        total_file = limit_file
    }

    for(var i = 0; i < total_file; i++)
    {
        $('.multiple-image-preview').append(`
            <a id="{{ $name."_pre" }}" href="${URL.createObjectURL(event.target.files[i])}">
                <img id="{{ $name }}" src="${URL.createObjectURL(event.target.files[i])}" style="height: 150px" />
            </a>`
        )
    }
}
</script>

<label class="mb-0 pb-2">{{ $label }}</label>
<div class="border mb-4 p-1 rounded @error($name) border-danger @enderror">
    <div class="input-group">
        <div class="custom-file">
            <input accept="image/x-png,image/gif,image/jpeg" name="{{ $name }}[]" id="multiple_upload_file" type="file" onchange="preview_image()" multiple>
        </div>
    </div>
    <div class="rounded-lg text-center multiple-image-preview">
        @if(Request::is('admin/products/*/edit'))
            @foreach ($productImages as $productImage)
            <a id="{{ $name."_pre" }}" href="{{ url('image/show/'.$productImage->slug) }}">
                <img id="{{ $name }}" src="{{ url('image/thumbnail/'.$productImage->slug) }}" style="height: 150px" />
            </a>
            @endforeach
        @else
        <a id="{{ $name."_pre" }}" href="{{ $placeholderImage }}">
            <img id="{{ $name }}" src="{{ $placeholderImage }}" class="img-fluid" style="height: 150px" />
        </a>
        @endif
    </div>
</div>
