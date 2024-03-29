@extends('template.admin')

@section('head')
    <script src="{{ URL::asset('tagify/jQuery.tagify.min.js') }}"></script>
    <link href="{{ URL::asset('tagify/tagify.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/tag.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="admin-container">
    <div class="row">
        <div class="col-md-12">
            <h4 class="title">รายการสินค้าในโปรโมชัน</h4>
            <span>เจ้าหน้าที่สามารถดูข้อมูลสินค้าที่อยู่ในโปรโมชัน</span>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="pull-left form-group">
                <h5 class="title">โปรโมชัน > ลด {{ $promotion->name }}
                    @if($promotion->type == 'percent')
                    %
                    @elseif($promotion->type == 'discount')
                    บาท
                    @endif
                </h5>
            </div>
        </div>
        <!--
        <div class="col-md-6">
            <div class="pull-right form-group">
                <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#editPanel">
                    <i class="fas fa-plus"></i> เพิ่มสินค้าในโปรโมชัน
                </button>
            </div>
        </div>
    -->

    <div class="col-md-12">
        {!! Form::open(['url' => 'admin/promotions/'. $promotion->slug .'/products', 'method' => 'post']) !!}
        <div class="row form-group">
            <div class="col-md-8 form-group">
                <select class="select-product-multiple" name="productPromotions[]" multiple="multiple" style="width: 100%;">
                    @foreach($allProducts as $key => $product)
                        <option value="{{ $key }}">{{ $product }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 form-group">
                <button id="add-product-promotion-btn" type="submit" class="btn btn-primary"> <i class="fas fa-plus"></i> เพิ่มสินค้า</button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>

    <!--
        <div class="col-md-12">
            <div id="editPanel" class="promotion-tag collapse form-group" style="margin-top: 15px;">
                <div class="row">
                    <div class="col-md-12">
                        {!! Form::open(['url' => 'admin/promotions/'. $promotion->slug .'/products', 'method' => 'post', 'class' => 'form-inline']) !!}
                        <input
                            name="productPromotions"
                            placeholder="คลิกเพื่อเลือกสินค้า..."
                            class="form-control"
                        />
                        <button id="add-product-promotion-btn" type="submit" class="btn btn-primary">เพิ่มสินค้า</button>
                    {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    -->
    </div>
    @if (count($products) === 0)
    <div class="text-center">
        <img class="search-no-result-img" src="{{ url('img/no-result.png') }}">
        <h5>ไม่พบข้อมูล</h5>
    </div>
    @else
    <div class="table-responsive">
        <table class="table">
            <thead>
              <tr>
                <th>#</th>
                <th>ชื่อสินค้า</th>
                <th class="text-right">ราคา (บาท)</th>
                <th class="text-right">จำนวน</th>
                <th class="text-center">จัดการ</th>
                <th class="text-center">ดูข้อมูล</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $product->name }}</td>
                    <td class="text-right">{{ number_format($product->units['0']->pricePerUnit, 2) }}</td>
                    <td class="text-right">{{ number_format($product->quantity) }} {{ $product->units['0']->unitName }}</td>
                    <td class="text-center">
                        {!! Form::model($product, [
                            'method' => 'delete',
                            'url' => 'admin/promotions/' . $promotion->slug . '/' . 'products/' . $product->slug,
                            'class' => '']) !!}
                            <button class="btn btn-danger btn-sm" type="submit">
                                <i class="fas fa-trash"></i>
                                นำออก
                            </button>
                        {!! Form::close() !!}
                    </td>
                    <td class="text-center">
                        <a class="btn btn-primary btn-sm" href="{{ url('admin/products/'.$product->slug) }}">
                            <i class="fas fa-external-link-square-alt"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection

@section('script')
<script>
     $(document).ready(function() {
        $('.select-product-multiple').select2();
    });
    
    var inputElm = document.querySelector('input[name=productPromotions]');

    var productList = [
        @foreach($allProducts as $key => $product)
        {
            "value": "{!! $key !!}",
            "name": "{!! $product !!}",
        },
        @endforeach
    ]

    function tagTemplate(tagData){
        return `
            <tag title="${(tagData.title || tagData.email)}"
                    contenteditable='false'
                    spellcheck='false'
                    tabIndex="-1"
                    class="${this.settings.classNames.tag} ${tagData.class ? tagData.class : ""}"
                    ${this.getAttributes(tagData)}>
                <x title='' class='tagify__tag__removeBtn' role='button' aria-label='remove tag'></x>
                <div>
                    <span class='tagify__tag-text'>${tagData.name}</span>
                </div>
            </tag>
        `
    }

    function suggestionItemTemplate(tagData){
        return `
            <div ${this.getAttributes(tagData)}
                class='tagify__dropdown__item ${tagData.class ? tagData.class : ""}'
                tabindex="0"
                role="option">
                <strong>${tagData.name}</strong>
            </div>
        `
    }

    // initialize Tagify on the above input node reference
    var tagify = new Tagify(inputElm, {
        tagTextProp: 'name', // very important since a custom template is used with this property as text. allows typing a "value" or a "name" to match input with whitelist
        enforceWhitelist: true,
        skipInvalid: true, // do not remporarily add invalid tags
        dropdown: {
            closeOnSelect: false,
            enabled: 0,
            classname: 'users-list',
            searchKeys: ['name']  // very important to set by which keys to search for suggesttions when typing
        },
        templates: {
            tag: tagTemplate,
            dropdownItem: suggestionItemTemplate
        },
        whitelist: productList
    })

    tagify.on('dropdown:show dropdown:updated', onDropdownShow)
    tagify.on('dropdown:select', onSelectSuggestion)

    var addAllSuggestionsElm;

    function onDropdownShow(e){
        var dropdownContentElm = e.detail.tagify.DOM.dropdown.content;

        if( tagify.suggestedListItems.length > 1 ){
            addAllSuggestionsElm = getAddAllSuggestionsElm();

            // insert "addAllSuggestionsElm" as the first element in the suggestions list
            dropdownContentElm.insertBefore(addAllSuggestionsElm, dropdownContentElm.firstChild)
        }
    }

    function onSelectSuggestion(e){
        if( e.detail.elm == addAllSuggestionsElm )
            tagify.dropdown.selectAll.call(tagify);
    }

    // create a "add all" custom suggestion element every time the dropdown changes
    function getAddAllSuggestionsElm(){
        // suggestions items should be based on "dropdownItem" template
        return tagify.parseTemplate('dropdownItem', [{
                class: "addAll",
                name: "Add all",
                email: tagify.settings.whitelist.reduce(function(remainingSuggestions, item){
                    return tagify.isTagDuplicate(item.value) ? remainingSuggestions : remainingSuggestions + 1
                }, 0) + " Members"
            }]
        )
    }
</script>
@endsection
