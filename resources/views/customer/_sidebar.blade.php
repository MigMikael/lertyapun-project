<nav id="sidebar">
    <div class="p-4 pt-5">
        @if($customer->avatarImage != null)
        <img src="{{ url('image/thumbnail/'.$customer->avatarImage->slug) }}" class="img logo rounded-circle mb-5">
        @else
        <img src="{{ URL::asset('img/avatar.png') }}" class="img logo rounded-circle mb-5">
        @endif
        <ul class="list-unstyled components mb-5">
            <li class="active">
                <a href="#userAccount" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle">
                    บัญชีของฉัน
                </a>
                <ul class="list-unstyled collapse show" id="userAccount">
                    <a href="{{ url('customer/profile') }}">
                        ข้อมูลส่วนตัว
                    </a>
                    <a href="{{ url('customer/address') }}">
                        ที่อยู่
                    </a>
                    <a href="{{ url('customer/password') }}">
                        รหัสผ่าน
                    </a>
                </ul>
            </li>
            <li>
                <a href="purchase.html">
                    การซื้อของฉัน
                </a>
            </li>
        </ul>
    </div>
</nav>
