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
        <a class="dropdown-item" href="{{ url()->current() }}">ล่าสุด</a>
        <a class="dropdown-item" href="{{ url()->current() . "?sort=name_asc" }}">ชื่อ ก-ฮ</a>
        <a class="dropdown-item" href="{{ url()->current() . "?sort=name_desc" }}">ชื่อ ฮ-ก</a>
    </div>
</div>
