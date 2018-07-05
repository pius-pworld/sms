<table id="dataTableId" class="table table-bordered table-striped dataTable no-footer" role="grid" aria-describedby="example2_info">
    <thead>
    <tr>
        @if($type == 'primary')
            <th>ASM/RSM</th>
            <th>ASM/RSM Phone</th>
        @elseif($type == 'secondary')
            <th>ASO/SO</th>
            <th>ASO/SO Phone</th>
        @endif
        <th>Order Date</th>
        <th>Sale Date</th>
        <th>House</th>
        <th>House Mobile</th>
        <th>Total Sale Quantity</th>
        <th>Total Amount</th>
        <th>Current Balance</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($sales as $sale)
        <tr>
            <td>{{$sale->sender_name}}</td>
            <td>{{$sale->sender_phone}}</td>
            <td>{{$sale->order_date}}</td>
            <td>{{$sale->sale_date}}</td>
            <td>{{$sale->dh_name}}</td>
            <td>{{$sale->dh_phone}}</td>
            <td>{{$sale->sale_total}}</td>
            <td>{{$sale->total_sale_amount}}</td>
            <td>{{($sale->current_balance-$sale->total_sale_amount)}}</td>
            <td><a href="{{URL::to('sales-details/'.$type.'/'.$sale->id)}}"><i class="fa fa-eye"></i></a></td>
        </tr>
    @endforeach
    </tbody>
</table>



