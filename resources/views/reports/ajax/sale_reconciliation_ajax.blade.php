<table class="table-bordered  table" BORDERCOLOR=RED>
    <thead>
        <th>Category</th>
        <th>Brand</th>
        <th>SKU</th>
        <th>Openning Stock</th>
        <th>Lifting</th>
        <th>Sales</th>
        <th>Closing</th>
    </thead>
    <tbody>
    @if(isset($memo_structure))
        @foreach($memo_structure as $category_key=>$category_value)
            <tr style="border-color:#767b84;">
                <td rowspan="{{ array_sum(array_map("count", $category_value))}}" style="border-color:#767b84;">{{$category_key}}</td>
                @foreach($category_value as $brand_key=>$brand_value)
                        <td rowspan="{{ array_sum(array_map("count", $brand_value))}}" style="border-color:#767b84;">{{$brand_key}}</td>
                    @foreach($brand_value as $key=>$value)
                            <td style="border-color:#767b84;">{{$key}}</td>
                            @if(isset($monthly_sale_reconciliation[$value]))
                                <td style="border-color:#767b84;">{{$monthly_sale_reconciliation[$value]['opening_stock']}}</td>
                                <td style="border-color:#767b84;">{{$monthly_sale_reconciliation[$value]['lifting']}}</td>
                                <td style="border-color:#767b84;">{{$monthly_sale_reconciliation[$value]['sales']}}</td>
                                <td style="border-color:#767b84;">{{$monthly_sale_reconciliation[$value]['closing']}}</td>
                            @endif
                   </tr>
                    @endforeach
                @endforeach
        @endforeach
    @endif
    </tbody>
</table>