<div class="dropdown" style="margin-right: 5px">
    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
        <i class="fas fa-sort-amount-down"></i>
        @if(request()->get('sort') == '')
        ล่าสุด
        @elseif(request()->get('sort') == 'name_asc')
        ชื่อ A-Z
        @elseif(request()->get('sort') == 'name_desc')
        ชื่อ Z-A
        @endif
    </button>
    <div class="dropdown-menu">
        <a class="dropdown-item" href="{{ url()->current() }}">ล่าสุด</a>
        <a class="dropdown-item" href="{{ url()->current() . "?sort=name_asc" }}">ชื่อ A-Z</a>
        <a class="dropdown-item" href="{{ url()->current() . "?sort=name_desc" }}">ชื่อ Z-A</a>
    </div>
</div>
