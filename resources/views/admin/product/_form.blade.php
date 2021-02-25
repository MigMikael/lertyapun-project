<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('name', 'Name') !!}
    {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control is-invalid']) !!}
    <div class="invalid-feedback">
        Please choose a username.
    </div>
</div>
<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('description', 'Description') !!}
    <textarea name="description" class="form-control" placeholder="Product description">{{ $product->description ?? '' }}</textarea>
</div>
<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('price', 'Price') !!}
    {!! Form::text('price', null, ['placeholder' => 'Price', 'class' => 'form-control']) !!}
</div>
{{-- <div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('point', 'Point') !!}
    {!! Form::text('point', null, ['placeholder' => 'Point', 'class' => 'form-control']) !!}
</div> --}}
<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('quantity', 'Quantity') !!}
    {!! Form::text('quantity', null, ['placeholder' => 'Quantity', 'class' => 'form-control']) !!}
</div>
<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('unit', 'Unit') !!}
    {!! Form::text('unit', null, ['placeholder' => 'Unit', 'class' => 'form-control']) !!}
</div>
<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('Status') !!}
    {!! Form::select('status', $status, null, ['class' => 'form-control is-invalid']) !!}
</div>
<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('product_image', 'Product Image') !!} (ขั้นต่ำ 500 x 500px)
    {!! Form::file('product_image', ['accept'=>'image/*', 'class' => 'form-control', 'value' => 'Choose a product image']) !!}
</div>

{{-- https://getbootstrap.com/docs/4.0/components/forms/? --}}
