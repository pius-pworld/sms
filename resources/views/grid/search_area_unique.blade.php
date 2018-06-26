<div class="panel panel-default " id="search_by" style='display:none'>
    <div class="panel-heading" style="overflow: hidden;">
        <span style="float: left;">SEARCH BY</span>
        <span class="top_search" style="float: right; color: #C9302C; cursor: pointer;"><span class="glyphicon glyphicon-remove"></span></span>
    </div>
    <div class="panel-body">
        <form id="grid_list_frm" action="" method="post">
            <div class="col-lg-12">
                <div class="col-lg-4 form-group">
                    <label>ASO Name</label>
                    <select class="form-control" name="requester_name">
                        <option value="">Select ASO</option>
                        <?php
                            foreach($aso_name as $an)
                            { ?>
                                <option value="<?php echo $an->requester_name; ?>"><?php echo $an->requester_name; ?></option>
                            <?php }
                        ?>
                    </select>


                </div>
                <div class="col-lg-4 form-group">
                    <label>Distributor House</label>
                    <select class="form-control" name="dh_name">
                        <option value="">Select House</option>
                        <?php
                        foreach($houses as $house)
                        { ?>
                        <option value="<?php echo $house->dh_name; ?>"><?php echo $house->dh_name; ?></option>
                        <?php }
                        ?>
                    </select>
                </div>
                <div class="col-lg-4 form-group">
                    <label>Route</label>
                    <select class="form-control" name="route_name">
                        <option value="">Select Route</option>
                        <?php
                        foreach($routes as $route)
                        { ?>
                            <option value="<?php echo $route->route_name; ?>"><?php echo $route->route_name; ?></option>
                        <?php }
                        ?>
                    </select>
                </div>
                <div class="col-lg-4 form-group">
                    <label>Date Range</label>
                    <input type="text" name="created_at" placeholder="ASO Name" value="" class="form-control user-error date_range" aria-invalid="true">
                </div>
            </div>
            <div class="col-lg-12 text-right">
                <input class="btn btn-primary search_unique_submit" type="button" value="Search">
            </div>
        </form>
    </div>
</div>


@include('grid.grid_view_css_js')