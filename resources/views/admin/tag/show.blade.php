@extends('template.admin')

@section('head')
    <script src="{{ URL::asset('tagify/jQuery.tagify.min.js') }}"></script>
    <link href="{{ URL::asset('tagify/tagify.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/tag.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center" tyle="margin-top: 15px">
        <h1 class="mt-4">Tag > {{ $tag->name }}</h1>
        <div>
            <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#editPanel">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>
    <div id="editPanel" class="collapse" style="padding-left: 15px">
        <br>
        <div class="row">
            {!! Form::open(['url' => 'admin/tags/'. $tag->slug .'/products', 'method' => 'post', 'class' => 'form-inline']) !!}
                <input
                    name="productTags"
                    placeholder="click..."
                    class="form-control"
                    style="!important width: 100%"
                />
                <button type="submit" class="btn btn-primary">Add To Promotion</button>
            {!! Form::close() !!}
        </div>
        <br>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Actions</th>
                <th>View</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->quantity }} {{ $product->unit }}</td>
                    <td>
                        {!! Form::model($product, [
                            'method' => 'delete',
                            'url' => 'admin/tags/' . $tag->slug . '/' . 'products/' . $product->slug,
                            'class' => 'form-inline']) !!}
                            <button class="btn btn-danger btn-sm" type="submit">
                                <i class="fas fa-trash"></i>
                                นำสินค้าออก
                            </button>
                        {!! Form::close() !!}
                    </td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="{{ url('admin/products/'.$product->slug) }}">
                            <i class="fas fa-external-link-square-alt"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <br>
    <br>
@endsection

@section('script')
<script>
    var inputElm = document.querySelector('input[name=productTags]');

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
