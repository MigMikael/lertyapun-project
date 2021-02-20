<div class="col-md-4">
    <div class="card card-product-grid">
        <a href="{{ url('customer/products/'.$product->slug) }}" class="img-wrap">
            <img src="{{ url('image/thumbnail/'.$product->image->slug) }}">
        </a>
        <figcaption class="info-wrap">
            <div class="fix-height">
                <a href="{{ url('customer/products/'.$product->slug) }}" class="title">
                    {{ $product->name }}
                </a>
                <div class="price mt-1">฿{{ $product->price }}</div>
                @if(count($product->promotions) != 0)
                    @foreach ($product->promotions->reverse() as $promotion)
                        <span class="badge badge-danger" style="font-weight: normal">{{ $promotion->name }}</span>
                        @if($loop->iteration == 1)
                            @break
                        @endif
                    @endforeach
                @endif
            </div>
            <button id="{{ $product->slug }}" class="btn btn-block btn-primary mt-3">
                เพิ่มใส่ตระกร้า
            </button>
        </figcaption>
    </div>
</div>
