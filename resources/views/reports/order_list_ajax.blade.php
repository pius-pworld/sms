<table id="dataTableId" class="table table-bordered table-striped dataTable no-footer" role="grid" aria-describedby="example2_info">
    <thead>
    <tr>
        <th>ASO</th>
        <th>ASO Phone</th>
        <th>Route</th>
        <th>Total Outlet</th>
        <th>Order Type</th>
        <th>Order Total</th>
        <th>House</th>
        <th>Order Date</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($orders as $order)
        <tr>
            <td>{{$order->requester_name}}</td>
            <td>{{$order->requester_phone}}</td>
            <td>{{$order->route_name}}</td>
            <td>{{$order->total_outlet}}</td>
            <td>{{$order->order_type}}</td>
            <td>{{$order->order_total}}</td>
            <td>{{$order->dh_name}}</td>
            <td>{{$order->created_at}}</td>
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



