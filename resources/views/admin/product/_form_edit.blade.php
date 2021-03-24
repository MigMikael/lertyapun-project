<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('name', 'ชื่อสินค้า') !!}
    {!! Form::text('name', null, ['placeholder' => 'ชื่อสินค้า', 'class' => 'form-control']) !!}
</div>

<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('description', 'คำอธิบายสินค้า') !!}
    <textarea name="description" class="form-control" placeholder="คำอธิบายสินค้า" rows="6">{{ $product->description ?? '' }}</textarea>
</div>
{{-- <div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('price', 'Price') !!}
    {!! Form::text('price', null, ['placeholder' => 'Price', 'class' => 'form-control']) !!}
</div> --}}
{{-- <div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('point', 'Point') !!}
    {!! Form::text('point', null, ['placeholder' => 'Point', 'class' => 'form-control']) !!}
</div> --}}
{{-- <div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('unit', 'Unit') !!}
    {!! Form::text('unit', null, ['placeholder' => 'Unit', 'class' => 'form-control']) !!}
</div> --}}
{!! Form::label('unit', 'หน่วย (เล็กที่สุด)') !!}
<div class="input-group" style="margin-bottom: 3%">
    {!! Form::select('unitName[]', config('constants.productUnit'), $product->units['0']->unitName, ['class' => 'form-control base-unit-name']) !!}

    <div class="input-group-prepend">
        <span class="input-group-text base-unit-price-label">ราคา{{ $product->units['0']->unitName }}ละ</span>
    </div>
    <input type="text" class="form-control" placeholder="" name="pricePerUnit[]" value="{{ $product->units['0']->pricePerUnit }}" required>
    <div class="input-group-prepend">
        <span class="input-group-text">บาท</span>
    </div>

    <input type="hidden" class="form-control" placeholder="" name="quantityPerUnit[]" value="1">

    {{-- <div class="input-group-prepend">
        <span class="input-group-text">มีสินค้า</span>
    </div>
    <input type="number" class="form-control" placeholder="" name="quantity[]" value="{{ $product->quantity }}" required>
    <div class="input-group-prepend">
        <span class="input-group-text base-unit-quantity-label">{{ $product->units['0']->unitName }}</span>
    </div> --}}

    <div class="input-group-prepend">
        <span class="input-group-text base-unit-weight-label">แต่ละ{{ $product->units['0']->unitName }}หนัก</span>
    </div>
    <input type="text" class="form-control" placeholder="" name="weight" value="{{ $product->weight }}" required>
    <div class="input-group-prepend">
        <span class="input-group-text">กรัม</span>
    </div>
</div>

@include('admin.product._unit_edit')

<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('quantity', 'จำนวนสินค้า (ตามหน่วยพิ้นฐาน)') !!}
    {!! Form::text('quantity', null, ['placeholder' => 'Quantity', 'class' => 'form-control']) !!}
</div>

<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('Status', 'สถานะ') !!}
    {!! Form::select('status', $status, null, ['class' => 'form-control']) !!}
</div>

<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('product_image', 'ภาพสินค้า') !!} (ขั้นต่ำ 500 x 500px)
    {!! Form::file('product_image', ['accept'=>'image/*', 'class' => 'form-control', 'value' => 'Choose a product image']) !!}
</div>

<script>
    $('.base-unit-name').on('change', function (e) {
        var valueSelected = this.value
        // console.log(valueSelected)
        $(".base-unit-price-label").text("ราคา" + valueSelected + "ละ")
        $(".base-unit-quantity-label").text(valueSelected)
        $(".base-unit-weight-label").text("แต่ละ" + valueSelected + "หนัก")

        $(".quantity-per-unit-base").text(valueSelected)
    });
</script>
