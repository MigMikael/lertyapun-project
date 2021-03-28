<div class="col-sm-6 col-md-6 col-lg-4">
    <div class="card card-product-grid">
        <a href="{{ url('customer/products/'.$product->slug) }}" class="img-wrap">
            <img src="{{ url('image/show/'.$product->image->slug) }}">
        </a>
        <figcaption class="info-wrap">
            <div class="fix-height">
                <a href="{{ url('customer/products/'.$product->slug) }}" class="title">
                    {{ $product->name }}
                </a>
                <div class="price mt-1">{{ number_format($product->units['0']['pricePerUnit']) }} บาท
                @if(count($product->promotions) != 0)
                    @foreach ($product->promotions->reverse() as $promotion)
                        <span class="badge badge-danger" style="font-weight: normal">{{ $promotion->name }}</span>
                        @if($loop->iteration == 1)
                            @break
                        @endif
                    @endforeach
                @endif
                </div>
                <p>เหลือสินค้า {{ $product->quantity }} ชิ้น</p>
            </div>
            <button id="{{ $product->slug }}" @if($product->quantity <= 0) class="btn btn-block btn-secondary mt-3" disabled @else class="btn btn-block btn-primary mt-3" @endif>
                @if($product->quantity <= 0)
                สินค้าหมด
                @else
                เพิ่มใส่ตระกร้า
                @endif
            </button>
        </figcaption>
    </div>
</div>
