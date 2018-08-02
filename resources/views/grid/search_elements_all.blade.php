<div class="col-lg-12">
    @if(isset($searchAreaOption['zone']) && $searchAreaOption['zone'] == 1)
        <div class="col-lg-4 form-group">
            <label>Zone</label>
            {!! dropdownList(1) !!}
        </div>
    @endif
    @if(isset($searchAreaOption['region']) && $searchAreaOption['region'] == 1)
        <div class="col-lg-4 form-group">
            <label>Region</label>
            {!! dropdownList(2) !!}
        </div>
    @endif
    @if(isset($searchAreaOption['territory']) && $searchAreaOption['territory'] == 1)
        <div class="col-lg-4 form-group">
            <label>Teritory</label>
            {!! dropdownList(3) !!}
        </div>
    @endif
    @if(isset($searchAreaOption['house']) && $searchAreaOption['house'] == 1)
        <div class="col-lg-4 form-group">
            <label>House</label>
            {!! dropdownList(4) !!}
        </div>
    @endif
    @if(isset($searchAreaOption['route']) && $searchAreaOption['route'] == 1)
        <div class="col-lg-4 form-group">
            <label>ASO/SO</label>
            {!! dropdownList(8) !!}
        </div>
    @endif
    @if(isset($searchAreaOption['category']) && $searchAreaOption['category'] == 1)
        <div class="col-lg-4 form-group">
            <label>Category</label>
            {!! dropdownList(5) !!}
        </div>
    @endif
    @if(isset($searchAreaOption['brand']) && $searchAreaOption['brand'] == 1)
        <div class="col-lg-4 form-group">
            <label>Brand</label>
            {!! dropdownList(6) !!}
        </div>
    @endif
    @if(isset($searchAreaOption['sku']) && $searchAreaOption['sku'] == 1)
        <div class="col-lg-4 form-group">
            <label>SKU</label>
            {!! dropdownList(7) !!}
        </div>
    @endif
    @if(isset($searchAreaOption['month']) && $searchAreaOption['month'] == 1)
        <div class="col-lg-4 form-group">
            <label>Month</label>
            <input type="text" name="month[]" placeholder="Month" value="" class="form-control user-error monthpicker" aria-invalid="true">
        </div>
    @endif
    @if(isset($searchAreaOption['daterange']) && $searchAreaOption['daterange'] == 1)
        <div class="col-lg-4 form-group">
            <label>Date Range</label>
            <input type="text" name="created_at[]" placeholder="ASO Name" value="" class="form-control user-error date_range_converted" aria-invalid="true">
        </div>
    @endif

</div>


<script>
$(document).on('change','select',function(){
    var val = $(this).val();
    alert(val);
});
</script>