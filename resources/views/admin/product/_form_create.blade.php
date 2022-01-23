<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('name', 'ชื่อสินค้า') !!} <span class="required">*</span>
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

<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('keyword_search', 'คำค้นหาสินค้า') !!}
    <textarea name="keyword_search" class="form-control{{ $errors->has('keyword_search') ? ' is-invalid' : null }}" placeholder="คำค้นหาสินค้า" rows="6">{{ $product->keyword_search ?? '' }}</textarea>
    @error('keyword_search')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('company_name', 'บริษัท (แบรนด์)') !!}
    {!! Form::text('company_name', null, ['placeholder' => 'บริษัท (แบรนด์)', 'class' => 'form-control' . ($errors->has('company_name') ? ' is-invalid' : null)]) !!}
    @error('name')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

{{-- <div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('point', 'Point') !!}
    {!! Form::text('point', null, ['placeholder' => 'Point', 'class' => 'form-control']) !!}
</div> --}}
{!! Form::label('unit', 'หน่วยพิ้นฐาน') !!} <span class="required">*</span>
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

    <div class="input-group-prepend hidden">
        <span class="input-group-text base-unit-weight-label">น้ำหนัก</span>
    </div>
    <input type="hidden" class="form-control{{ $errors->has('weight') ? ' is-invalid' : null }}" placeholder="" name="weight" value="0" required>
    <div class="input-group-prepend hidden">
        <span class="input-group-text">กรัม</span>
    </div>
</div>

@include('admin.product._unit_create')

<div class="form-group hidden" style="margin-bottom: 3%">
    {!! Form::label('quantity', 'จำนวนสินค้า (ตามหน่วยพิ้นฐาน)') !!} <span class="required">*</span>
    {!! Form::text('quantity', 999999, ['placeholder' => 'จำนวนสินค้า (ตามหน่วยพิ้นฐาน)', 'class' => 'form-control' . ($errors->has('quantity') ? ' is-invalid' : null)]) !!}
    @error('quantity')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('Status', 'สถานะ') !!} <span class="required">*</span>
    {!! Form::select('status', $status, null, ['class' => 'form-control' . ($errors->has('status') ? ' is-invalid' : null)]) !!}
    @error('status')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<!--
<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('expired_date', 'วันหมดอายุ (วัน/เดือน/ปี)') !!} <span class="required">*</span>
    {!! Form::date('expired_date', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
    @error('expired_date')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
-->

<!--
<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('expired_startdate', 'วันหมดอายุเร็วที่สุด') !!}
    {!! Form::date('expired_startdate', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
    @error('expired_startdate')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('expired_startdate', 'วันหมดอายุช้าที่สุด') !!}
    {!! Form::date('expired_enddate', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
    @error('expired_enddate')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
-->

@include('template._inputPreview', [
    'label' => 'ภาพสินค้า',
    'name' => 'product_image',
    'key' => 'productImage',
    'required' => true
])

<!--
@include('template._inputPreviewMulti', [
    'label' => 'ภาพสินค้าเพิ่มเติม (สูงสุด 5 ภาพ)',
    'name' => 'additional_image',
    'key' => 'additionalImage',
])
-->

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
