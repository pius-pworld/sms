<!--for confirmation diologue-->
<div id="dialog" title="Confirmation Required" style="display: none;">
    Are you sure about this?
</div>


<!--for loader-->
<div style="
        z-index: 999999;
        bottom: 0;
        left: 0;
        position: fixed;
        right: 0;
        width: 100%;
        height: 100%;
        text-align: center;
        top: 0;
        margin-left: auto;
        margin-right: auto;
        margin-top: auto;
        margin-bottom: auto;
        display: none"
     class="loadingImage">
    <img src="{{asset('public/img/laoder.gif')}}"></div>





<div class="modal fade" id="alertError" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Alert</h4>
            </div>
            <div class="modal-body customText"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>