<table id="d_table" class="table table-bordered">
    <thead>
    <tr>
        <th>{{$type}}</th>
        @foreach($brands as $brand)
            <th style="text-align:center" colspan="{{$brand->total}}">{{$brand->brand_name}}</th>
        @endforeach
    </tr>
    <tr>
        <th>sku</th>
        @foreach($skues as $skue)
            <?php
                $base = rand(10,555);
                echo "
                    <script>
                        var dClass = '".$skue->brands_id.'_'.$skue->id."';
                        $(document).on('input','.target_'+dClass,function(){
                            var targetValue = $(this).val();
                            var baseValue = parseInt($(this).parent().parent().find('.base_total').val());
                            var uniqueRef = $(this).attr('unique_ref');

                            $('.base_distribute_'+uniqueRef).each(function(){
                                var dv = parseInt($(this).val());
                                var basePercent = ((dv*100)/baseValue)
                                var targetDistribute = ((targetValue*basePercent)/100)
                                $(this).parent().find('.target_distribute_'+uniqueRef).val(Math.round(targetDistribute));
                            });
                        });
                    </script>
                ";
            ?>
            <td style="text-align: center">
                <?php echo str_replace(' ',"&nbsp;",$skue->sku_name);?>
                <div style="width: 150px; overflow: hidden;">
                    <div style="float: left;">
                        <input class="base_total {{'base_'.$skue->brands_id.'_'.$skue->id}}" style="width: 75px;" type="text" placeholder="Base" value="{{$base}}">
                    </div>
                    <div style="float: left;">
                        <input unique_ref="{{$skue->brands_id.'_'.$skue->id}}" class="{{'target_'.$skue->brands_id.'_'.$skue->id}}" style="width: 75px;" type="text" placeholder="Target">
                    </div>
                </div>
                {{--<input type="text" placeholder="Target">--}}
            </td>
        @endforeach
    </tr>
    </thead>
    <tbody>
    @foreach($geographies as $geography)
        <tr>
            <th>
                <input type="hidden" name="geography_id[]" value="{{$geography->id}}">
                <?php echo str_replace(' ','&nbsp;',$geography->gname); ?>
            </th>
            @foreach($skues as $skue)
                <?php
                    $existing = commonHelper::getTargetJsonValue($type,$geography->id,$target_month,$existingValue);
                   // dd($existing['target'][$geography->id]);
                ?>
                <td style="text-align: center">
                    <input
                            name="base_distribute[<?php echo $geography->id; ?>][<?php echo $skue->brands_id; ?>][<?php echo $skue->id; ?>]"
                            class="{{'base_distribute_'.$skue->brands_id.'_'.$skue->id}}"
                            readonly style="width: 50px;"
                            type="number"
                            {{--value="{{$baseData[$geography->id][$skue->brands_id][$skue->id]}}"--}}
                            value="<?php echo (($existing)?$existing['base'][$skue->id]:$baseData[$geography->id][$skue->brands_id][$skue->id]); ?>">
                    <input
                            name="target_distribute[<?php echo $geography->id; ?>][<?php echo $skue->brands_id; ?>][<?php echo $skue->id; ?>]"
                            class="{{'target_distribute_'.$skue->brands_id.'_'.$skue->id}}"
                            style="width: 50px;"
                            type="text"
                            {{--value="0">--}}
                            value="<?php echo (($existing)?$existing['target'][$skue->id]:0); ?>">
                </td>
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>

