<div class="dropdown" style="display: inline;">
    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
        <i class="fas fa-sort-amount-down"></i>
        @if(request()->get('sort') == '')
        ล่าสุด
        @elseif(request()->get('sort') == 'order_date_asc')
        วันเวลา น้อย->มาก
        @elseif(request()->get('sort') == 'order_date_desc')
        วันเวลา มาก->น้อย
        @endif
    </button>
    <div class="dropdown-menu">
        @if(Request::url() == Request::fullUrl())
            <a class="dropdown-item" href="{{ Request::url() }}">ล่าสุด</a>
        @elseif(request()->get('sort') != '')
            <a class="dropdown-item" href="{{ str_replace('sort='.request()->get('sort'), 'sort=', Request::fullUrl()) }}">ล่าสุด</a>
        @else
            <a class="dropdown-item" href="{{ Request::fullUrl() . "&sort=" }}">ล่าสุด</a>
        @endif


        @if(Request::url() == Request::fullUrl())
            <a class="dropdown-item" href="{{ Request::url() . "?sort=order_date_asc" }}">วันเวลา น้อย->มาก</a>
        @elseif(request()->get('sort') != '')
            <a class="dropdown-item" href="{{ str_replace('sort='.request()->get('sort'), 'sort=order_date_asc', Request::fullUrl()) }}">วันเวลา น้อย->มาก</a>
        @else
            <a class="dropdown-item" href="{{ Request::fullUrl() . "&sort=order_date_asc" }}">วันเวลา น้อย->มาก</a>
        @endif


        @if(Request::url() == Request::fullUrl())
            <a class="dropdown-item" href="{{ Request::url() . "?sort=order_date_desc" }}">วันเวลา มาก->น้อย</a>
        @elseif(request()->get('sort') != '')
            <a class="dropdown-item" href="{{ str_replace('sort='.request()->get('sort'), 'sort=order_date_desc', Request::fullUrl()) }}">วันเวลา มาก->น้อย</a>
        @else
            <a class="dropdown-item" href="{{ Request::fullUrl() . "&sort=order_date_desc" }}">วันเวลา มาก->น้อย</a>
        @endif
    </div>
</div>
