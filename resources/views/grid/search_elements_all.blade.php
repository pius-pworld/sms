<div class="col-lg-12">
    <div class="col-lg-4 form-group">
        <label>Zone</label>
        {!! dropdownList(1) !!}
    </div>
    <div class="col-lg-4 form-group">
        <label>Region</label>
        {!! dropdownList(2) !!}
    </div>
    <div class="col-lg-4 form-group">
        <label>Teritory</label>
        {!! dropdownList(3) !!}
    </div>
    <div class="col-lg-4 form-group">
        <label>House</label>
        {!! dropdownList(4) !!}
    </div>
    <div class="col-lg-4 form-group">
        <label>ASO/SO</label>
        {!! dropdownList(8) !!}
    </div>
    <div class="col-lg-4 form-group">
        <label>Category</label>
        {!! dropdownList(5) !!}
    </div>
    <div class="col-lg-4 form-group">
        <label>Brand</label>
        {!! dropdownList(6) !!}
    </div>
    <div class="col-lg-4 form-group">
        <label>SKU</label>
        {!! dropdownList(7) !!}
    </div>

    @if(isset($searchAreaOption['daterange']) && $searchAreaOption['daterange'] == 1)
        <div class="col-lg-4 form-group">
            <label>Date Range</label>
            <input type="text" name="created_at" placeholder="ASO Name" value="" class="form-control user-error date_range" aria-invalid="true">
        </div>
    @endif

</div>