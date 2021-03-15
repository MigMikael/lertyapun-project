<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('total_amount', 'ยอดรวมทั้งหมด') !!}
    {!! Form::text('total_amount', null, ['placeholder' => 'ยอดรวมทั้งหมด', 'class' => 'form-control']) !!}
</div>
<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('สถานะคำสั่งซื้อ') !!}
    {!! Form::select('status', $orderStatus, null, ['class' => 'form-control']) !!}
</div>
<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('วันที่คำสั่งซื้อ') !!}
    {!! Form::date('order_date', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('สถานะการชำระเงิน') !!}
    {!! Form::select('payment_status', $paymentStatus, null, ['class' => 'form-control']) !!}
</div>
<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('วันที่ชำระเงิน') !!}
    {!! Form::date('payment_date', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('slip_image', 'รูปภาพสลิปการชำระเงิน') !!} (ขั้นต่ำ 500 x 500px)
    {!! Form::file('slip_image', ['accept'=>'image/*', 'class' => 'form-control', 'value' => 'Choose a product image']) !!}
</div>
<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('customer_id', 'รหัสลูกค้า') !!}
    {!! Form::text('customer_id', null, ['placeholder' => 'รหัสลูกค้า', 'class' => 'form-control']) !!}
</div>
