<div class="dropdown" style="display: inline">
    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
        <i class="fas fa-sort-amount-down"></i>
        @if(request()->get('sort') == '')
        ล่าสุด
        @elseif(request()->get('sort') == 'name_asc')
        ชื่อ A-Z
        @elseif(request()->get('sort') == 'name_desc')
        ชื่อ Z-A
        @elseif(request()->get('sort') == 'price_asc')
        ราคาต่ำสุด
        @elseif(request()->get('sort') == 'price_desc')
        ราคาสูงสุด
        @elseif(request()->get('sort') == 'quantity_asc')
        จำนวนต่ำสุด
        @elseif(request()->get('sort') == 'quantity_desc')
        จำนวนสูงสุด
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
            <a class="dropdown-item" href="{{ Request::url() . "?sort=name_asc" }}">ชื่อ A-Z</a>
        @elseif(request()->get('sort') != '')
            <a class="dropdown-item" href="{{ str_replace('sort='.request()->get('sort'), 'sort=name_asc', Request::fullUrl()) }}">ชื่อ A-Z</a>
        @else
            <a class="dropdown-item" href="{{ Request::fullUrl() . "&sort=name_asc" }}">ชื่อ A-Z</a>
        @endif


        @if(Request::url() == Request::fullUrl())
            <a class="dropdown-item" href="{{ Request::url() . "?sort=name_desc" }}">ชื่อ Z-A</a>
        @elseif(request()->get('sort') != '')
            <a class="dropdown-item" href="{{ str_replace('sort='.request()->get('sort'), 'sort=name_desc', Request::fullUrl()) }}">ชื่อ Z-A</a>
        @else
            <a class="dropdown-item" href="{{ Request::fullUrl() . "&sort=name_desc" }}">ชื่อ Z-A</a>
        @endif


        @if(Request::url() == Request::fullUrl())
            <a class="dropdown-item" href="{{ Request::url() . "?sort=price_asc" }}">ราคาต่ำสุด</a>
        @elseif(request()->get('sort') != '')
            <a class="dropdown-item" href="{{ str_replace('sort='.request()->get('sort'), 'sort=price_asc', Request::fullUrl()) }}">ราคาต่ำสุด</a>
        @else
            <a class="dropdown-item" href="{{ Request::fullUrl() . "&sort=price_asc" }}">ราคาต่ำสุด</a>
        @endif


        @if(Request::url() == Request::fullUrl())
            <a class="dropdown-item" href="{{ Request::url() . "?sort=price_desc" }}">ราคาสูงสุด</a>
        @elseif(request()->get('sort') != '')
            <a class="dropdown-item" href="{{ str_replace('sort='.request()->get('sort'), 'sort=price_desc', Request::fullUrl()) }}">ราคาสูงสุด</a>
        @else
            <a class="dropdown-item" href="{{ Request::fullUrl() . "&sort=price_desc" }}">ราคาสูงสุด</a>
        @endif


        @if(Request::url() == Request::fullUrl())
            <a class="dropdown-item" href="{{ Request::url() . "?sort=quantity_asc" }}">จำนวนต่ำสุด</a>
        @elseif(request()->get('sort') != '')
            <a class="dropdown-item" href="{{ str_replace('sort='.request()->get('sort'), 'sort=quantity_asc', Request::fullUrl()) }}">จำนวนต่ำสุด</a>
        @else
            <a class="dropdown-item" href="{{ Request::fullUrl() . "&sort=quantity_asc" }}">จำนวนต่ำสุด</a>
        @endif


        @if(Request::url() == Request::fullUrl())
            <a class="dropdown-item" href="{{ Request::url() . "?sort=quantity_desc" }}">จำนวนสูงสุด</a>
        @elseif(request()->get('sort') != '')
            <a class="dropdown-item" href="{{ str_replace('sort='.request()->get('sort'), 'sort=quantity_desc', Request::fullUrl()) }}">จำนวนสูงสุด</a>
        @else
            <a class="dropdown-item" href="{{ Request::fullUrl() . "&sort=quantity_desc" }}">จำนวนสูงสุด</a>
        @endif
    </div>
</div>
