@extends('template.admin')

@section('head')
<script src="{{ URL::asset('tagify/jQuery.tagify.min.js') }}"></script>
<link href="{{ URL::asset('tagify/tagify.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/tag.css') }}" rel="stylesheet">

<link href="{{ URL::asset('css/lightgallery.min.css') }}" rel="stylesheet">
<script src="{{ URL::asset('js/lightgallery-all.min.js') }}"></script>
@endsection

@section('content')
<div class="admin-container">
    <div class="row">
        <div class="col-md-6">
            <h4 class="title">ข้อมูลสินค้า</h4>
            <span>เจ้าหน้าที่สามารถดูข้อมูลสินค้า</span>
        </div>
        <div class="col-md-6">
            <div class="pull-right">
                {!! Form::model($product, [
                'method' => 'delete',
                'url' => 'admin/products/'.$product->slug,
                'class' => 'form-inline']) !!}
                <a class="btn btn-warning" href="{{ url('admin/products/'.$product->slug.'/edit') }}">
                    <i class="fas fa-edit"></i> แก้ไข
                </a>
                <button class="btn btn-danger delete-action" style="margin-left: 15px;">
                    <i class="fas fa-trash"></i> ลบ
                </button>
                {!! Form::close() !!}
            </div>
        </div>
        <div class="col-md-12">
            <hr>
        </div>
    </div>
    <div class="row form-group">
        <div class="col-md-4 col-xs-6" style="border: 0px solid black;">
            <img class="form-group" src="{{ url('image/show/'.$product->image->slug) }}" style="width: 100%" class="img-fluid" alt="{{ $product->name }}">
        </div>
        <div class="col-md-8 col-xs-6" style="border: 0px solid black;">
            <h4>
                {{ $product->name }} @if($product->status == 'active')
                <span class="badge badge-success" style="font-size: 16px;">กำลังใช้งาน</span>
                @elseif($product->status == 'suspend')
                <span class="badge badge-danger-secondary" style="font-size: 16px;">ระงับการใช้งาน</span>
                @elseif($product->status == 'inactive')
                <span class="badge badge-danger" style="font-size: 16px;">ไม่ได้ใช้งาน</span>
                @endif
            </h4>

            <strong>คำอธิบาย</strong>
            <p>{{ $product->description }}</p>

            <strong>บริษัท (แบรนด์)</strong>
            <p>{{ $product->company_name }}</p>

            <strong>คำค้นหา</strong>
            <p>{{ $product->keyword_search }}</p>

            <strong>เลขบาร์โค้ด</strong>
            <p>{{ $product->barcode }}</p>

            <strong>จำนวน</strong>
            <p>{{ $product->quantity }} {{ $product->units['0']['unitName'] }}</p>

            <!--
            <strong>วันหมดอายุ (วัน/เดือน/ปี):</strong>
            <p>{{ \Carbon\Carbon::parse($product->expired_date)->format('d/m/Y') }}</p>
            -->

            <!--
            <strong>วันหมดอายุเร็วที่สุด:</strong>
            <p>{{ \Carbon\Carbon::parse($product->expired_startdate)->format('d/m/Y') }}</p>

            <strong>วันหมดอายุช้าที่สุด:</strong>
            <p>{{ \Carbon\Carbon::parse($product->expired_enddate)->format('d/m/Y') }}</p>
            -->

            <strong>หน่วยสินค้า</strong><br>
            @foreach($product->units as $productUnit)
            <span>{{ $productUnit->unitName }}: {{ number_format($productUnit->pricePerUnit, 2) }} บาท</span>
            <!--/-->
            @if ($loop->first)
            <!--<span>น้ำหนัก {{ $product->weight }} กรัม</span>-->
            @else
            <span> / 1 {{ $productUnit->unitName }}: {{ number_format($productUnit->quantityPerUnit, 2) }} {{ $product->units['0']['unitName'] }}</span>
            @endif
            <br>
            @endforeach
        </div>
    </div>
    <div id="aniimated-thumbnials" class="row">
        @foreach($productImages as $productImage)
        <a class="col-md-2 form-group" href="{{ url('image/show/'.$productImage->slug) }}">
            <img src="{{ url('image/show/'.$productImage->slug) }}" style="width: 100%;" alt="{{ $product->name }}">
        </a>
        @endforeach
    </div>
    <div class="row">
        <div class="col-md-12">
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <h4 class="title">โปรโมชัน</h4>
            <!--
            <select class="select-product-multiple" name="productPromotions[]" multiple="multiple" style="width: 100%;">
                @foreach($promotions as $promotion)
                        <option {{in_array($promotion, array_keys($productPromotions->toArray())) ? 'selected':''}}>{{ $promotion }}</option>
                @endforeach
            </select>
            -->
            {!! Form::open(['url' => 'admin/product/promotion', 'method' => 'post']) !!}
            <div class="row">
                <div class="col-md-8 form-group">
                    <select class="form-control" name="promotionTag">
                        <option value="">เลือกโปรโมชัน</option>
                        @foreach($promotions as $key => $promotion)
                        <option {{ in_array($key, $productPromotions->toArray()) ? 'selected' : '' }} value="{{ $key }}">{{ $promotion }} บาท</option>
                        @endforeach
                    </select>
                    <!--
                    <input
                    name="promotionTag"
                    placeholder="เลือกโปรโมชัน..."
                    value="@foreach($productPromotions as $productPro){!! $productPro !!} บาท,@endforeach"
                />-->
                    <input name="product_id" type="hidden" value="{{ $product->slug }}" />
                </div>
                <div class="col-md-4 form-group">
                    <button type="submit" class="btn btn-primary btn-block">เพิ่มโปรโมชัน</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        <div class="col-md-6">
            <h4 class="title">ประเภทสินค้า</h4>
            {!! Form::open(['url' => 'admin/product/category', 'method' => 'post']) !!}
            <div class="row">
                <div class="col-md-8 form-group">
                    <input name="categoryTag" placeholder="เลือกประเภทสินค้า..." value="@foreach($productCategories as $productCat){!! $productCat !!},@endforeach" />
                    <input name="product_id" type="hidden" value="{{ $product->slug }}" />
                </div>
                <div class="col-md-4 form-group">
                    <button type="submit" class="btn btn-primary btn-block">เพิ่มประเภทสินค้า</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        {{-- <div class="col-md-4">
            <h1>Tag</h1>
            {!! Form::open(['url' => 'admin/product/tag', 'method' => 'post']) !!}
                <input
                    name="tagTag"
                    placeholder="click..."
                    value="@foreach($productTags as $productTag){!! $productTag !!},@endforeach"
                />
                <input name="product_id" type="hidden" value="{{ $product->slug }}" />
        <button type="submit" class="btn btn-primary">Add Tag</button>
        {!! Form::close() !!}
    </div> --}}
</div>
<div class="row">
    <div class="col-md-6">
        <h4 class="title">สถานะสินค้า</h4>
        {!! Form::model($product, ['url' => 'admin/products/'.$product->slug.'/status', 'method' => 'post']) !!}
        <div class="row">
            <div class="col-md-8 form-group">
                {!! Form::select('status', $status, $product->status, ['class' => 'form-control']) !!}
            </div>
            <div class="col-md-4 form-group">
                <button type="submit" class="btn btn-primary btn-block">แก้ไขสถานะ</button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
</div>
@endsection

@section('script')
<script>
    $('#aniimated-thumbnials').lightGallery({
        thumbnail: true
    });
</script>
<script>
    $('.delete-action').click(function(e) {
        e.preventDefault()
        if (confirm('Are you sure?')) {
            $(e.target).closest('form').submit()
        }
    })
</script>
<script>
    var inputElm = document.querySelector('input[name=categoryTag]');

    var categoriesList = [
        @foreach($categories as $key => $category) {
            "value": "{!! $key !!}",
            "name": "{!! $category !!}",
        },
        @endforeach
    ]

    function tagTemplate(tagData) {
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

    function suggestionItemTemplate(tagData) {
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
            searchKeys: ['name'], // very important to set by which keys to search for suggesttions when typing
            maxItems: 100,
        },
        templates: {
            tag: tagTemplate,
            dropdownItem: suggestionItemTemplate
        },
        whitelist: categoriesList
    })

    tagify.on('dropdown:show dropdown:updated', onDropdownShow)
    tagify.on('dropdown:select', onSelectSuggestion)

    var addAllSuggestionsElm;

    function onDropdownShow(e) {
        var dropdownContentElm = e.detail.tagify.DOM.dropdown.content;

        if (tagify.suggestedListItems.length > 1) {
            addAllSuggestionsElm = getAddAllSuggestionsElm();

            // insert "addAllSuggestionsElm" as the first element in the suggestions list
            dropdownContentElm.insertBefore(addAllSuggestionsElm, dropdownContentElm.firstChild)
        }
    }

    function onSelectSuggestion(e) {
        if (e.detail.elm == addAllSuggestionsElm)
            tagify.dropdown.selectAll.call(tagify);
    }

    // create a "add all" custom suggestion element every time the dropdown changes
    function getAddAllSuggestionsElm() {
        // suggestions items should be based on "dropdownItem" template
        return tagify.parseTemplate('dropdownItem', [{
            class: "addAll",
            name: "Add all",
            email: tagify.settings.whitelist.reduce(function(remainingSuggestions, item) {
                return tagify.isTagDuplicate(item.value) ? remainingSuggestions : remainingSuggestions + 1
            }, 0) + " Members"
        }])
    }
</script>

<script>
    var inputElm = document.querySelector('input[name=promotionTag]');

    var promotionsList = [
        @foreach($promotions as $key => $promotion) {
            "value": "{!! $key !!}",
            "name": "{!! $promotion !!} บาท",
        },
        @endforeach
    ]

    function tagTemplate(tagData) {
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

    function suggestionItemTemplate(tagData) {
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
            searchKeys: ['name'], // very important to set by which keys to search for suggesttions when typing
            maxItems: 100,
        },
        templates: {
            tag: tagTemplate,
            dropdownItem: suggestionItemTemplate
        },
        whitelist: promotionsList
    })

    tagify.on('dropdown:show dropdown:updated', onDropdownShow)
    tagify.on('dropdown:select', onSelectSuggestion)

    var addAllSuggestionsElm;

    function onDropdownShow(e) {
        var dropdownContentElm = e.detail.tagify.DOM.dropdown.content;

        if (tagify.suggestedListItems.length > 1) {
            addAllSuggestionsElm = getAddAllSuggestionsElm();

            // insert "addAllSuggestionsElm" as the first element in the suggestions list
            dropdownContentElm.insertBefore(addAllSuggestionsElm, dropdownContentElm.firstChild)
        }
    }

    function onSelectSuggestion(e) {
        if (e.detail.elm == addAllSuggestionsElm)
            tagify.dropdown.selectAll.call(tagify);
    }

    // create a "add all" custom suggestion element every time the dropdown changes
    function getAddAllSuggestionsElm() {
        // suggestions items should be based on "dropdownItem" template
        return tagify.parseTemplate('dropdownItem', [{
            class: "addAll",
            name: "Add all",
            email: tagify.settings.whitelist.reduce(function(remainingSuggestions, item) {
                return tagify.isTagDuplicate(item.value) ? remainingSuggestions : remainingSuggestions + 1
            }, 0) + " Members"
        }])
    }
</script>

{{-- <script>
        var inputElm = document.querySelector('input[name=tagTag]');

        var tagList = [
            @foreach($tags as $key => $tag)
            {
                "value": "{!! $key !!}",
                "name": "{!! $tag !!}",
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
            whitelist: tagList
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
    </script> --}}
@endsection