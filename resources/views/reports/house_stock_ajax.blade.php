<table border="1">
    <thead>

    <tr>
        <th rowspan="3" style="vertical-align: middle">House Name</th>
        @if(count(categories)> 0)
            {{--@foreach($memo_structure as $mk=>$mv)--}}
                {{--@foreach($mv as $key=>$value)--}}
                     {{--<th colspan="{{ array_sum(array_map("count", $value)) }}" style="text-align: center">{{$key}}</th>--}}
                {{--@endforeach--}}
            {{--@endforeach--}}
        @endif
    </tr>
    <tr>
        @if(isset($memo_structure1))
            @foreach($memo_structure as $mk=>$mv)
                @foreach($mv as $key=>$value)
                    @foreach($value as $k=>$v)
                        <th colspan="{{count($v)}}" style="text-align: center">{{$k}}</th>
                    @endforeach
                @endforeach
            @endforeach
        @endif
    </tr>
    <tr>
        @if(isset($memo_structure))
            @foreach($memo_structure as $mk=>$mv)
                @foreach($mv as $key=>$value)
                    @foreach($value as $k=>$v)
                        @foreach($v as $k1=>$v1)
                          <th style="text-align: center">{{$k1}}</th>
                        @endforeach
                    @endforeach
                @endforeach
            @endforeach
        @endif
    </tr>
    </thead>
    <tbody>


            @if(isset($memo_structure))
                @foreach($memo_structure as $mk=>$mv)
                    <tr>
                    <th>{{$mk}}</th>
                    @foreach($mv as $key=>$value)
                        @foreach($value as $k=>$v)
                            @foreach($v as $k1=>$v1)
                                <th style="text-align: center">{{$v1}}</th>
                            @endforeach
                        @endforeach
                    @endforeach
                    </tr>
                @endforeach
            @endif




    </tbody>
</table>