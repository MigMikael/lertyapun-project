<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('name', 'ชื่อสินค้า') !!}
    {!! Form::text('name', null, ['placeholder' => 'ชื่อสินค้า', 'class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : null)]) !!}
    @error('name')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('description', 'คำอธิบายสินค้า') !!}
    <textarea name="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : null }}" placeholder="คำอธิบายสินค้า" rows="6">{{ $product->description ?? '' }}</textarea>
    @error('description')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
{{-- <div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('point', 'Point') !!}
    {!! Form::text('point', null, ['placeholder' => 'Point', 'class' => 'form-control']) !!}
</div> --}}
{!! Form::label('unit', 'หน่วยพิ้นฐาน') !!}
<div class="input-group" style="margin-bottom: 3%">
    {!! Form::select('unitName[]', config('constants.productUnit'), null, ['class' => 'form-control base-unit-name' . ($errors->has('unitName') ? ' is-invalid' : null)]) !!}

    <div class="input-group-prepend">
        <span class="input-group-text base-unit-price-label">ราคาชิ้นละ</span>
    </div>
    <input type="text" class="form-control{{ $errors->has('pricePerUnit') ? ' is-invalid' : null }}" placeholder="" name="pricePerUnit[]" required>
    <div class="input-group-prepend">
        <span class="input-group-text">บาท</span>
    </div>

    <input type="hidden" class="form-control" placeholder="" name="quantityPerUnit[]" value="1">

    {{-- <div class="input-group-prepend">
        <span class="input-group-text">มีสินค้า</span>
    </div>
    <input type="number" class="form-control" placeholder="" name="quantity[]" required>
    <div class="input-group-prepend">
        <span class="input-group-text base-unit-quantity-label">ชิ้น</span>
    </div> --}}

    <div class="input-group-prepend">
        <span class="input-group-text base-unit-weight-label">แต่ละชิ้นหนัก</span>
    </div>
    <input type="text" class="form-control{{ $errors->has('weight') ? ' is-invalid' : null }}" placeholder="" name="weight" required>
    <div class="input-group-prepend">
        <span class="input-group-text">กรัม</span>
    </div>
</div>

@include('admin.product._unit_create')

<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('quantity', 'จำนวนสินค้า (ตามหน่วยพิ้นฐาน)') !!}
    {!! Form::text('quantity', null, ['placeholder' => 'จำนวนสินค้า (ตามหน่วยพิ้นฐาน)', 'class' => 'form-control' . ($errors->has('quantity') ? ' is-invalid' : null)]) !!}
    @error('quantity')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('Status', 'สถานะ') !!}
    {!! Form::select('status', $status, null, ['class' => 'form-control' . ($errors->has('status') ? ' is-invalid' : null)]) !!}
    @error('status')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('expired_startdate', 'วันที่เริ่มต้นหมดอายุ') !!}
    {!! Form::date('expired_startdate', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
    @error('expired_startdate')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('expired_startdate', 'วันที่สิ้นสุดหมดอายุ') !!}
    {!! Form::date('expired_enddate', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
    @error('expired_enddate')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

@include('template._inputPreview', [
    'label' => 'ภาพสินค้า',
    'name' => 'product_image',
    'key' => 'productImage',
])

@include('template._inputPreviewMulti', [
    'label' => 'ภาพสินค้าเพิ่มเติม (สูงสุด 5 ภาพ)',
    'name' => 'additional_image',
    'key' => 'additionalImage',
])

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
