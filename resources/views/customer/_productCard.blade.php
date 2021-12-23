<div class="col-lg-3">
    <div class="card card-product-grid">
        <a href="{{ url('customer/products/'.$product->slug) }}" class="img-wrap">
            <img src="{{ url('image/show/'.$product->image->slug) }}">
        </a>
        <figcaption class="info-wrap">
            <div class="fix-height">
                <a href="{{ url('customer/products/'.$product->slug) }}" class="title">
                    <div class="text-ellipsis">
                        {{ $product->name }}
                    </div>
                </a>
                @if(count($product->promotions) != 0)
                    @foreach ($product->promotions->reverse() as $promotion)
                    <div class="price mt-1">ราคา {{ number_format(doubleval($product->units['0']['pricePerUnit']) - doubleval($promotion->name), 2) }} บาท</div>
                    @if ($promotion->name != "0")
                        <div style="text-decoration: line-through;">ราคา {{ number_format($product->units['0']['pricePerUnit'], 2) }} บาท</div>
                    @endif
                    <span class="badge badge-danger" style="font-weight: normal; position: absolute;top: 0;right: 0;margin-top: 7px;margin-right: 7px;">
                        @if ($promotion->name != "0")
                        ลด {{ $promotion->name }}
                        @if($promotion->type == 'percent')
                        %
                        @elseif($promotion->type == 'discount')
                        บาท
                        @endif
                        @else
                        ราคาพิเศษ
                        @endif
                    </span>
                    @if($loop->iteration == 1)
                        @break
                    @endif
                    @endforeach
                @else
                    <div class="price mt-1">ราคา {{ number_format($product->units['0']['pricePerUnit'], 2) }} บาท</div>
                @endif
                <!--<p>เหลือสินค้า {{ $product->quantity }} ชิ้น</p>-->
            </div>
            <a id="{{ $product->slug }}"
                @if($product->quantity <= 0)
                    href="#" class="btn btn-block btn-secondary mt-3" disabled
                @else
                    href="{{ url('customer/products/'.$product->slug) }}" class="btn btn-block btn-primary mt-3"
                @endif

                @if(auth()->guard('admin')->check())
                    disabled
                @endif
                >
                    @if($product->quantity <= 0)
                    สินค้าหมด
                    @else
                    ดูรายละเอียด
                    @endif
            </a>
        </figcaption>
    </div>
</div>
