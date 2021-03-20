<div class="dropdown" style="display: inline;">
    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
        <i class="fas fa-sort-amount-down"></i>
        @if(request()->get('sort') == '')
        ล่าสุด
        @elseif(request()->get('sort') == 'name_asc')
        ชื่อ ก-ฮ
        @elseif(request()->get('sort') == 'name_desc')
        ชื่อ ฮ-ก
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
            <a class="dropdown-item" href="{{ Request::url() . "?sort=name_asc" }}">ชื่อ ก-ฮ</a>
        @elseif(request()->get('sort') != '')
            <a class="dropdown-item" href="{{ str_replace('sort='.request()->get('sort'), 'sort=name_asc', Request::fullUrl()) }}">ชื่อ ก-ฮ</a>
        @else
            <a class="dropdown-item" href="{{ Request::fullUrl() . "&sort=name_asc" }}">ชื่อ ก-ฮ</a>
        @endif


        @if(Request::url() == Request::fullUrl())
            <a class="dropdown-item" href="{{ Request::url() . "?sort=name_desc" }}">ชื่อ ฮ-ก</a>
        @elseif(request()->get('sort') != '')
            <a class="dropdown-item" href="{{ str_replace('sort='.request()->get('sort'), 'sort=name_desc', Request::fullUrl()) }}">ชื่อ ฮ-ก</a>
        @else
            <a class="dropdown-item" href="{{ Request::fullUrl() . "&sort=name_desc" }}">ชื่อ ฮ-ก</a>
        @endif
    </div>
</div>
