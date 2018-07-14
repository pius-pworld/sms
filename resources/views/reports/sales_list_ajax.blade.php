<table id="dataTableId" class="table table-bordered table-striped dataTable no-footer" role="grid" aria-describedby="example2_info">
    <thead>
    <tr>
        <th>House</th>
        <th>House Mobile</th>
        @if($type == 'primary')
            <th>ASM/RSM</th>
            <th>ASM/RSM Phone</th>
        @elseif($type == 'secondary')
            <th>ASO/SO</th>
            <th>ASO/SO Phone</th>

            <th>Total Outlet</th>
            <th>Visited Outlet</th>
            <th>Successfull Memo</th>
            <th>Call Productivity</th>
            <th>Protfollio Volume</th>
            <th>Value Per Call</th>
            <th>Total SKU Order Qty</th>
            <th>Order Amount</th>
        @endif
        <th>Order Date</th>
        <th>Sale Date</th>

        <th>Total Sale Quantity</th>
        <th>Total Amount</th>
        {{--<th>Current Balance</th>--}}
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($sales as $sale)
        <tr>
            <td>{{$sale->point_name}}</td>
            <td>{{$sale->dh_phone}}</td>
            <td>{{$sale->sender_name}}</td>
            <td>{{$sale->sender_phone}}</td>
            @if($type == 'secondary')
                <td>{{$sale->total_outlet}}</td>
                <td>{{$sale->visited_outlet}}</td>
                <td>{{$sale->total_no_of_memo}}</td>
                <td>{{(($sale->total_no_of_memo/$sale->visited_outlet)*100)}}</td>
                <td>{{($sale->order_total_sku/$sale->total_no_of_memo)}}</td>
                <td>{{($sale->order_amount/$sale->total_no_of_memo)}}</td>
                <td>{{$sale->order_total_sku}}</td>
                <td>{{$sale->order_amount}}</td>
            @endif
            <td>{{$sale->order_date}}</td>
            <td>{{$sale->sale_date}}</td>
            <td>{{$sale->sale_total_sku}}</td>
            <td>{{$sale->total_sale_amount}}</td>
{{--            <td>{{($sale->current_balance-$sale->total_sale_amount)}}</td>--}}
            <td><a href="{{URL::to('sales-details/'.$type.'/'.$sale->id)}}"><i class="fa fa-eye"></i></a></td>
        </tr>
    @endforeach
    </tbody>
</table>



