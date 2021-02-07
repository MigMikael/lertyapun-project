<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('total_amount', 'Total Amount') !!}
    {!! Form::text('total_amount', null, ['placeholder' => 'Total Amount', 'class' => 'form-control']) !!}
</div>
<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('Order Status') !!}
    {!! Form::select('status', $orderStatus, null, ['class' => 'form-control']) !!}
</div>
<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('Order Date') !!}
    {!! Form::date('order_date', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('Payment Status') !!}
    {!! Form::select('payment_status', $paymentStatus, null, ['class' => 'form-control']) !!}
</div>
<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('Payment Date') !!}
    {!! Form::date('payment_date', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('slip_image', 'Slip Image') !!} (ขั้นต่ำ 500 x 500px)
    {!! Form::file('slip_image', ['accept'=>'image/*', 'class' => 'form-control', 'value' => 'Choose a product image']) !!}
</div>
<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('customer_id', 'Customer Id') !!}
    {!! Form::text('customer_id', null, ['placeholder' => 'Customer Id', 'class' => 'form-control']) !!}
</div>
