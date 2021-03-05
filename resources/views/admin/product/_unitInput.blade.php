{!! Form::label('unit', 'Unit (จากเล็กไปใหญ่)') !!}
<div class="p-3 border mb-2 rounded @error('pricePerUnit') border-danger @enderror">
    <div class="mb-2" id="inputGroup">
    </div>
    <div class="clearfix mb-2">
        <button class="btn btn-outline-primary float-right" type="button" id="addUnitButton">
            <i class="fas fa-plus"></i> เพิ่ม
        </button>
    </div>
</div>

<script>
    function onDeleteClick(e) {
        $(e).parent().parent().remove();
    }

    $(document).ready(function(){
        var field = `
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <span class="input-group-text">หน่วย</span>
            </div>
            {!! Form::select('unitName[]', config('constants.productUnit'), null, ['class' => 'form-control']) !!}
            <div class="input-group-prepend">
                <span class="input-group-text">ราคา(฿)</span>
            </div>
            <input type="text" class="form-control" placeholder="ต่อหน่วย" name="pricePerUnit[]" required>
            <div class="input-group-prepend">
                <span class="input-group-text">จำนวน</span>
            </div>
            <input type="number" class="form-control" placeholder="ต่อหน่วย" name="quantityPerUnit[]" required>
            <div class="input-group-prepend">
                <span class="input-group-text">น้ำหนัก(Kg)</span>
            </div>
            <input type="text" class="form-control" placeholder="ต่อหน่วย" name="weightPerUnit[]" required>
            <div class="input-group-append">
                <button class="btn btn-outline-danger" type="button" onclick="onDeleteClick(this)">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>
        `
        $("#inputGroup").append(field);

        $("#addUnitButton").click(function(e) {
            $("#inputGroup").append(field);
        });
    });
</script>
