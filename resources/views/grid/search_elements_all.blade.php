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



<style type="text/css">
    .multiselect-container {
        width: 100% !important;
    }
</style>

<script>

$(function () {

    var privilegeObj,compare;

    function onChangeZones(selectedOptions){
//       console.log(selectedOptions);
        var region = setRegion(selectedOptions,'zones_id');
//        console.log(region);
        var territory = setTerritory(region,'regions_id');
        var house = setHouse(territory,'territories_id');
        var aso = setAso(house,'distribution_houses_id');
    }
    function onChangeRegion(selectedOptions){
        var territory = setTerritory(selectedOptions,'regions_id');
        var house = setHouse(territory,'territories_id');
        var aso = setAso(house,'distribution_houses_id');
    }
    function onChangeTerritory(selectedOptions){
        var house = setHouse(selectedOptions,'territories_id');
        var aso = setAso(house,'distribution_houses_id');
    }
    function onChangeHouse(selectedOptions){
        var aso = setAso(selectedOptions,'distribution_houses_id');
    }



    $.ajax({
        data:{'_token':'{{csrf_token()}}'},
        type:"POST",
        url: '{{URL::to('get-allPlaces')}}',
        success: function (data) {
            privilegeObj = $.parseJSON(data);
//            console.log(privilegeObj);

            $('#zones_id').multiselect({
                buttonWidth: '100%',
                includeSelectAllOption: true,
                enableFiltering: true,
                enableCaseInsensitiveFiltering: true,
                onChange: function() {
                    var selectedOptions = [];
                    $('#zones_id option:selected').map(function(a, item){return selectedOptions.push(item.value);});
                    onChangeZones(selectedOptions);
                    //setCompany(pt,'id');
                },
                onSelectAll: function() {
                    var selectedOptions =[];
                    $('#zones_id option:selected').map(function(a, item){return selectedOptions.push(item.value);});
                    //console.log(selectedOptions);
                    onChangeZones(selectedOptions);
                },
                onDeselectAll:function(){
                    var selectedOptions =[];
                    $('#zones_id option:selected').map(function(a, item){return selectedOptions.push(item.value);});
                    //console.log(selectedOptions);
                    onChangeZones(selectedOptions);
                }

            });

            $('#regions_id').multiselect({
                buttonWidth: '100%',
                includeSelectAllOption: true,
                enableFiltering: true,
                enableCaseInsensitiveFiltering: true,
                onChange: function() {
                    var selectedOptions = [];
                    $('#regions_id option:selected').map(function(a, item){return selectedOptions.push(item.value);});
                    //alert(JSON.stringify(selectedOptions));
                    onChangeRegion(selectedOptions);
                    //setCompany(pt,'id');
                },
                onSelectAll: function() {
                    var selectedOptions =[];
                    $('#regions_id option:selected').map(function(a, item){return selectedOptions.push(item.value);});
                    //console.log(selectedOptions);
                    onChangeRegion(selectedOptions);
                },
                onDeselectAll:function(){
                    var selectedOptions =[];
                    $('#regions_id option:selected').map(function(a, item){return selectedOptions.push(item.value);});
                    //console.log(selectedOptions);
                    onChangeRegion(selectedOptions);
                }
            });

            $('#territories_id').multiselect({
                buttonWidth: '100%',
                includeSelectAllOption: true,
                enableFiltering: true,
                enableCaseInsensitiveFiltering: true,
                onChange: function() {
                    var selectedOptions = [];
                    $('#territories_id option:selected').map(function(a, item){return selectedOptions.push(item.value);});
                    //alert(JSON.stringify(selectedOptions));
                    onChangeTerritory(selectedOptions);
                    //setCompany(pt,'id');
                },
                onSelectAll: function() {
                    var selectedOptions =[];
                    $('#territories_id option:selected').map(function(a, item){return selectedOptions.push(item.value);});
                    //console.log(selectedOptions);
                    onChangeTerritory(selectedOptions);
                },
                onDeselectAll:function(){
                    var selectedOptions =[];
                    $('#territories_id option:selected').map(function(a, item){return selectedOptions.push(item.value);});
                    //console.log(selectedOptions);
                    onChangeTerritory(selectedOptions);
                }
            });

            $('#house_id').multiselect({
                buttonWidth: '100%',
                includeSelectAllOption: true,
                enableFiltering: true,
                enableCaseInsensitiveFiltering: true,
                onChange: function() {
                    var selectedOptions = [];
                    $('#house_id option:selected').map(function(a, item){return selectedOptions.push(item.value);});
                    //alert(JSON.stringify(selectedOptions));
                    onChangeHouse(selectedOptions);
                    //setCompany(pt,'id');
                },
                onSelectAll: function() {
                    var selectedOptions =[];
                    $('#house_id option:selected').map(function(a, item){return selectedOptions.push(item.value);});
                    //console.log(selectedOptions);
                    onChangeHouse(selectedOptions);
                },
                onDeselectAll:function(){
                    var selectedOptions =[];
                    $('#house_id option:selected').map(function(a, item){return selectedOptions.push(item.value);});
                    //console.log(selectedOptions);
                    onChangeHouse(selectedOptions);
                }
            });



            $('#aso_id').multiselect({
                buttonWidth: '100%',
                includeSelectAllOption: true,
                enableFiltering: true,
                enableCaseInsensitiveFiltering: true
            });
            //$('#area').multiselect('selectAll', true);
        }
    });


    function setRegion(sel_val, comp){
//        console.log(sel_val);
//        console.log(privilegeObj.regions);
//       var jak = sel_val.split(',');
        var arr = [];
        var sel = ['multiselect-all'];
        privilegeObj.regions.forEach(function(e){
            if($.inArray(e[comp], sel_val)){
                sel_val.forEach(function (en) {
                    if(e[comp] == en){
                        var group = {label: e.name, value: e.id};
                        arr.push(group);
                        sel.push(e.id);
                    }
                });
            }
        });
        $('#regions_id').multiselect('dataprovider', arr);
        $('#regions_id').multiselect('select', sel);
        $('#regions_id').multiselect('rebuild');
        return sel;
    }

    function setTerritory(sel_val,comp){
        var arr = [];
        var sel = ['multiselect-all'];
        privilegeObj.territories.forEach(function(e){
            if($.inArray(e[comp], sel_val)){
                sel_val.forEach(function (en) {
                    if(e[comp] == en){
                        var group = {label: e.name, value: e.id};
                        arr.push(group);
                        sel.push(e.id);
                    }
                });
            }
        });
        $('#territories_id').multiselect('dataprovider', arr);
        $('#territories_id').multiselect('select', sel);
        return sel;
    }


    function setHouse(sel_val,comp){
        var arr = [];
        var sel = ['multiselect-all'];
        privilegeObj.houses.forEach(function(e){
            if($.inArray(e[comp], sel_val)){
                sel_val.forEach(function (en) {
                    if(e[comp] == en){
                        var group = {label: e.name, value: e.id};
                        arr.push(group);
                        sel.push(e.id);
                    }
                });
            }
        });
        $('#house_id').multiselect('dataprovider', arr);
        $('#house_id').multiselect('select', sel);
        return sel;
    }


    function setAso(sel_val,comp){
        var arr = [];
        var sel = ['multiselect-all'];
        privilegeObj.aso.forEach(function(e){
            if($.inArray(e[comp], sel_val)){
                sel_val.forEach(function (en) {
                    if(e[comp] == en){
                        var group = {label: e.name, value: e.id};
                        arr.push(group);
                        sel.push(e.id);
                    }
                });
            }
        });
        $('#aso_id').multiselect('dataprovider', arr);
        $('#aso_id').multiselect('select', sel);
        return sel;
    }

});
</script>