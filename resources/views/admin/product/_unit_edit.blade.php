{!! Form::label('unit', 'Additional Unit (จากเล็กไปใหญ่)') !!}
<div class="p-2 border rounded @error('pricePerUnit') border-danger @enderror" style="margin-bottom: 3%">
    <div class="mb-2" id="inputGroup">
        @foreach($product->units as $productUnit)
            @continue($loop->index == 0)
            <div class="input-group mb-2">
                {!! Form::select('unitName[]', config('constants.productUnit'), $productUnit->unitName, ['class' => 'form-control unit-name', 'onchange' => 'onUnitNameSelect(this)']) !!}

                <div class="input-group-prepend unit-price-label-wrap">
                    <span class="input-group-text unit-price-label">ราคา{{ $productUnit->unitName }}ละ</span>
                </div>
                <input type="text" class="form-control" placeholder="" name="pricePerUnit[]" value="{{ $productUnit->pricePerUnit }}" required>
                <div class="input-group-prepend">
                    <span class="input-group-text">บาท</span>
                </div>

                {{-- <div class="input-group-prepend">
                    <span class="input-group-text">มีสินค้า</span>
                </div>
                <input type="hidden" class="form-control" placeholder="" name="quantity[]" value="0">
                <div class="input-group-prepend">
                    <span class="input-group-text unit-quantity-label">ชิ้น</span>
                </div> --}}

                <div class="input-group-prepend">
                    <span class="input-group-text quantity-per-unit-label">หนึ่ง{{ $productUnit->unitName }}มี</span>
                </div>
                <input type="number" class="form-control" placeholder="" name="quantityPerUnit[]" value="{{ $productUnit->quantityPerUnit }}" required>
                <div class="input-group-prepend">
                    <span class="input-group-text quantity-per-unit-base">{{ $product->units['0']->unitName }}</span>
                </div>

                <div class="input-group-append">
                    <button class="btn btn-outline-danger" type="button" onclick="onDeleteClick(this)">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        @endforeach
    </div>
    <div class="clearfix mb-2">
        <button class="btn btn-outline-primary float-left" type="button" id="addUnitButton">
            <i class="fas fa-plus"></i>
        </button>
    </div>
</div>

<script>
    function onDeleteClick(e) {
        $(e).parent().parent().remove();
    }

    function onUnitNameSelect(e) {
        var valueSelected = e.value
        $(e).parent().find(".unit-price-label").text("ราคา" + valueSelected + "ละ")
        $(e).parent().find(".unit-quantity-label").text(valueSelected)
        $(e).parent().find(".quantity-per-unit-label").text("หนึ่ง" + valueSelected + "มี")
    }

    $(document).ready(function(){
        // $("#inputGroup").append(field);

        $("#addUnitButton").click(function(e) {
            var baseUnit = $(".base-unit-name").val()
            var field = `
            <div class="input-group mb-2">
                {!! Form::select('unitName[]', config('constants.productUnit'), null, ['class' => 'form-control unit-name', 'onchange' => 'onUnitNameSelect(this)']) !!}

                <div class="input-group-prepend unit-price-label-wrap">
                    <span class="input-group-text unit-price-label">ราคาชิ้นละ</span>
                </div>
                <input type="text" class="form-control" placeholder="" name="pricePerUnit[]" required>
                <div class="input-group-prepend">
                    <span class="input-group-text">บาท</span>
                </div>

                <div class="input-group-prepend">
                    <span class="input-group-text quantity-per-unit-label">หนึ่งชึ้นมี</span>
                </div>
                <input type="number" class="form-control" placeholder="" name="quantityPerUnit[]" required>
                <div class="input-group-prepend">
                    <span class="input-group-text quantity-per-unit-base">${baseUnit}</span>
                </div>

                <div class="input-group-append">
                    <button class="btn btn-outline-danger" type="button" onclick="onDeleteClick(this)">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
            `
            $("#inputGroup").append(field);
        });
    });
</script>
