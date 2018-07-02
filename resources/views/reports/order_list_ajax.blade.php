<table id="dataTableId" class="table table-bordered table-striped dataTable no-footer" role="grid" aria-describedby="example2_info">
    <thead>
    <tr>
        <th>House Name</th>
        <th>ASM/RSM</th>
        <th>ASM/RSM Phone</th>
        <th>Total SKU Quantity</th>
        <th>Order Date</th>
        <th>Deposite Amount</th>
        <th>Current Balance</th>
        <th>Order Amount</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($orders as $order)
        <tr>
            <td>{{$order->dh_name}}</td>
            <td>{{$order->requester_name}}</td>
            <td>{{$order->requester_phone}}</td>
            <td>{{$order->order_total}}</td>
            <td>{{date('d-m-Y',strtotime($order->created_at))}}</td>
            <td>{{$order->order_da}}</td>
            <td>Current balance</td>
            <td>{{$order->order_amount}}</td>
            <td>{{$order->order_status}}</td>
            <td>
                @if($order->order_status == 'Pending')
                    <a href="{{URL::to('primary-order-details/'.$order->id)}}"><i class="fa fa-eye"></i></a>
                @else
                    <i class="fa fa-eye"></i>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>



