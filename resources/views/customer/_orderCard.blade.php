<div class="card form-group">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h5 class="title">หมายเลขคำสั่งซื้อ {{ Str::limit($order->slug, 10, "") }}</h5>
                <label>ยอดชำระเงินทั้งหมด</label>
                <h5>฿{{ number_format($order->total_amount, 2) }}</h5>
                <label> {{ \Carbon\Carbon::parse($order->order_date)->format('d/m/Y') }}</label>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <strong>
                        สถานะคำสั่งซื้อ:
                        @if($order->status == 'pending' && $order->payment_status == 'pending')
                        <span class="order-waiting-payment">รอการชำระเงิน</span>
                        @elseif($order->status == 'pending' && $order->payment_status == 'success')
                        <span class="order-waiting-confirm">รอการอนุมัติ</span>
                        @elseif($order->status == 'success' && $order->payment_status == 'success')
                        <span class="order-success">สำเร็จ</span>
                        @elseif($order->status == 'cancle')
                        <span class="order-cancel">ยกเลิก</span>
                        @endif
                    </strong>
                </div>
                @if ($order->payment_date != null)
                <label>
                    <strong>ชำระเงินเมื่อ</strong>
                    {{ \Carbon\Carbon::parse($order->payment_date)->format('d/m/Y h:m:s') }}
                </label>
                @endif
                <a class="btn btn-secondary btn-block" href="{{ url('customer/order/'.$order->slug) }}">ดูรายละเอียด</a>
            </div>
        </div>
    </div>
</div>