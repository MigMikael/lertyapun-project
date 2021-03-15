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
            <h4 class="title">ข้อมูลสินค้า</h4>
            <span>เจ้าหน้าที่สามารถดูข้อมูลสินค้า</span>
            <hr>
        </div>
    </div>
    <div class="row form-group">
        <div class="col-md-4 col-xs-6" style="border: 0px solid black;">
            <img src="{{ url('image/show/'.$product->image->slug) }}" style="width: 100%" class="img-fluid" alt="{{ $product->name }}">
        </div>
        <div class="col-md-8 col-xs-6" style="border: 0px solid black;">
            <h1 class="mb-4">{{ $product->name }}</h1>
            <p><h5>คำอธิบาย</h5> {{ $product->description }}</p>
            <p><h5>จำนวน</h5> {{ $product->quantity }} {{ $product->units['0']['unitName'] }}</p>

            <h5>หน่วยสินค้า</h5>
            @foreach($product->units as $productUnit)
            <p>
                {{ $productUnit->unitName }} : {{ $productUnit->pricePerUnit }} บาท /
                1 {{ $productUnit->unitName }} : {{ $productUnit->quantityPerUnit }}
                @if ($loop->first)
                {{ $productUnit->unitName }}
                @else
                {{ $product->units['0']['unitName'] }}
                @endif
            </p>
            @endforeach
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <h4 class="title">โปรโมชัน</h4>
            {!! Form::open(['url' => 'admin/product/promotion', 'method' => 'post']) !!}
                <input
                    name="promotionTag"
                    placeholder="เลือกโปรโมชัน..."
                    value="@foreach($productPromotions as $productPro){!! $productPro !!},@endforeach"
                />
                <input name="product_id" type="hidden" value="{{ $product->slug }}" />
                <button type="submit" class="btn btn-primary" style="margin-top: 15px;">เพิ่มโปรโมชัน</button>
            {!! Form::close() !!}
        </div>
        <div class="col-md-6">
            <h4 class="title">ประเภทสินค้า</h4>
            {!! Form::open(['url' => 'admin/product/category', 'method' => 'post']) !!}
                <input
                    name="categoryTag"
                    placeholder="เลือกประเภทสินค้า..."
                    value="@foreach($productCategories as $productCat){!! $productCat !!},@endforeach"
                />
                <input name="product_id" type="hidden" value="{{ $product->slug }}" />
                <button type="submit" class="btn btn-primary" style="margin-top: 15px;">เพิ่มประเภทสินค้า</button>
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
</div>
@endsection

@section('script')
    <script>
        var inputElm = document.querySelector('input[name=categoryTag]');

        var categoriesList = [
            @foreach($categories as $key => $category)
            {
                "value": "{!! $key !!}",
                "name": "{!! $category !!}",
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
            whitelist: categoriesList
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

    <script>
        var inputElm = document.querySelector('input[name=promotionTag]');

        var promotionsList = [
            @foreach($promotions as $key => $promotion)
            {
                "value": "{!! $key !!}",
                "name": "{!! $promotion !!}",
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
            whitelist: promotionsList
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
