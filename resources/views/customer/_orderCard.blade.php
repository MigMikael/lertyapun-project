<div class="card form-group">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <label class="title">เลขที่คำสั่งซื้อ {{ $order->slug }}</label><br>
                <label>คำสั่งซื้อวันที่ {{ \Carbon\Carbon::parse($order->order_date)->format('d/m/Y เวลา h:m') }} น.</label>
                @if($order->status != 'pending')
                <br>
                <label class="title">ยอดเงินที่ต้องชำระ</label><br>
                <label>รวมสุทธิ {{ number_format($order->total_amount, 2) }} บาท</label>
                @endif
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <strong>
                        สถานะคำสั่งซื้อ:
                    </strong>
                    @if($order->status == 'pending')
                        <span class="order-waiting-confirm">รอการอนุมัติ</span>
                        @elseif($order->status == 'payment')
                        <span class="order-waiting-payment">รอการชำระเงิน</span>
                        @elseif($order->status == 'credit')
                        <span class="order-success">เครดิต</span>
                        @elseif($order->status == 'success')
                        <span class="order-success">สำเร็จ</span>
                        @elseif($order->status == 'cancle')
                        <span class="order-cancel">ยกเลิก</span>
                    @endif
                </div>

                <div class="hidden">
                    <label>
                        <strong>ชำระเงินเมื่อ </strong>
                        @if ($order->payment_date != null)
                        {{ \Carbon\Carbon::parse($order->payment_date)->format('d/m/Y - h:m') }} น.
                        @else
                         -
                        @endif
                    </label>
                </div>

                <a class="btn btn-secondary btn-block" href="{{ url('customer/order/'.$order->slug) }}">ดูรายละเอียด</a>
            </div>
        </div>
    </div>
</div>
