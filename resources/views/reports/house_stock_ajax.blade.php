<table id="dataTableId" class="table-bordered table dataTable">
    <thead>

    <tr>
        <th rowspan="3" style="vertical-align: middle">House Name</th>
        @if(isset($memo_structure))
            @foreach($memo_structure as $category_key=>$category_value)
                     <th colspan="{{ array_sum(array_map("count", $category_value)) * $level }}" style="text-align: center">{{$category_key}}</th>
            @endforeach
        @endif
        <th rowspan="3" style="vertical-align: middle">Current Balance</th>

    </tr>
    <tr>
        @if(isset($memo_structure))
            @foreach($memo_structure as $category_key=>$category_value)
                @foreach($category_value as $brand_key=>$brand_value)
                        <th colspan="{{count($brand_value) * $level}}" style="text-align: center">{{$brand_key}}</th>
                @endforeach
            @endforeach
        @endif
    </tr>
    <tr>
        @if(isset($memo_structure))
            @foreach($memo_structure as $category_key=>$category_value)
                @foreach($category_value as $brand_key=>$brand_value)
                    @foreach($brand_value as $sku_key=>$sku_value)
                          <th colspan="{{$level}}" style="text-align: center">{{$sku_key}}</th>
                    @endforeach
                @endforeach
            @endforeach
        @endif
    </tr>
    </thead>
    <tbody>
            @if(isset($house_stock_list))
                @foreach($house_stock_list as $house_key=> $house_value)
                    <tr>
                        <th>{{$house_key}}</th>
                        @foreach($house_value['data'] as $key => $value)
                              <td>{{$value}}</td>
                        @endforeach
                        <td>{{$house_stock_list[$house_key]['current_balance']}}</td>
                    </tr>
                 @endforeach
            @endif
    </tbody>
</table>