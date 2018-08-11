<table border="1">
    <thead>
    <tr>
        <th rowspan="4" style="vertical-align: middle">Date</th>
        <th rowspan="4" style="vertical-align: middle">ASO NAME</th>

        <th rowspan="4"  style="vertical-align: middle">Par.</th>
        @if(isset($memo_structure))
            @foreach($memo_structure as $category_key=>$category_value)
                <th colspan="{{ array_sum(array_map("count", $category_value)) * $level }}"
                    style="text-align: center">{{$category_key}}</th>
            @endforeach
        @endif
        <th rowspan="4" style="vertical-align: middle">Sale Amount</th>
        <th rowspan="4" style="vertical-align: middle">Deposit Amount</th>
        <th rowspan="4" style="vertical-align: middle">Balance</th>
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
                        <th  style="text-align: center">{{$sku_key}}</th>
                    @endforeach
                @endforeach
            @endforeach
        @endif
    </tr>

    </thead>
    <tbody>
    @if(isset($daily_sale_summary) && count($daily_sale_summary) > 0)
        @foreach($daily_sale_summary as $sale_key=> $sale_details)
            @foreach($sale_details['data'] as $key => $value)
                <tr>
                    <th>{{$sale_key}}</th>
                    {{--<th>{{$sale_details[$sale_key]['additional']['aso_name']}}</th>--}}
                    <th>{{$key}}</th>
                    @foreach($value as $k=>$v)
                        <td>{{$v}}</td>
                    @endforeach
                    {{--<td>{{number_format($house_info['additional']['sale_amount'],2)}}</td>--}}
                    {{--<td>{{number_format($house_info['additional']['deposit_amount'],2)}}</td>--}}
                    {{--<td>{{number_format($house_info['additional']['current_balance'],2)}}</td>--}}
                </tr>
            @endforeach
        @endforeach
    @endif
    </tbody>
</table>