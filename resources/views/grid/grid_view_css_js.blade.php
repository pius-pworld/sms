
<script>

    $(document).on('click', '#top_search, .top_search', function () {
        $('#search_by').slideToggle();
        $('.advanchedSearchToggle').slideToggle();
    });
    $(document).on('click', '#left_search', function () {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });


    $(document).on('click', '.search_unique_submit', function (e) {
        e.preventDefault();
        var url = "<?php echo $ajaxUrl; ?>";
        var _token = '<?php echo csrf_token() ?>';
        $.ajax({
            url: url,
            type: 'POST',
            //data: $('#grid_list_frm').serialize(),
            data: $('#grid_list_frm').serialize()+'&_token='+_token,
            beforeSend: function(){ $('.loadingImage').show();},
            success: function (d) {
                $('.showSearchDataUnique').html(d);
                myConfiguration();
                $('.loadingImage').hide();

            }
        });
    });
</script>

<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>

<style>
    #wrapper {
        padding-left: 0;
        -webkit-transition: all 0.5s ease;
        -moz-transition: all 0.5s ease;
        -o-transition: all 0.5s ease;
        transition: all 0.5s ease;
    }

    #wrapper.toggled {
        padding-left: 250px;
    }

    #sidebar-wrapper {
        z-index: 1000;
        position: absolute;
        left: 260px;
        width: 0;
        height: 100%;
        margin-left: -250px;
        overflow-y: auto;
        -webkit-transition: all 0.5s ease;
        -moz-transition: all 0.5s ease;
        -o-transition: all 0.5s ease;
        transition: all 0.5s ease;
    }

    #wrapper.toggled #sidebar-wrapper {
        width: 250px;
    }

    #page-content-wrapper {
        width: 100%;
        position: absolute;
        padding: 15px;
    }

    #wrapper.toggled #page-content-wrapper {
        position: absolute;
        margin-right: -250px;
    }


    @media(min-width:768px) {
        #wrapper {
            padding-left: 260px;
        }

        #wrapper.toggled {
            padding-left: 0;
        }

        #sidebar-wrapper {
            width: 250px;
        }

        #wrapper.toggled #sidebar-wrapper {
            width: 0;
        }

        #page-content-wrapper {
            padding: 20px;
            position: relative;
        }

        #wrapper.toggled #page-content-wrapper {
            position: relative;
            margin-right: 0;
        }
    }


    /*for grid view search area*/
    .moresearchfield {
        display:none;
        background: #777 none repeat scroll 0 0;
        list-style: outside none none;
        padding: 0;
        position: absolute;
        right: 66px;
        border-radius: 4px;
        /*top: 33px;*/
        width: auto;
        z-index: 99;
    }
    .moresearchfield > li {
        cursor: pointer;
        padding: 2px 36px;
    }

    .moresearchfield > li:hover {
        background: #fff none repeat scroll 0 0;
    }

    .custom_label{
        cursor: pointer;
    }
    .btn-primary{
        background: #C9302C !important;
        border-color: #C9302C !important;
    }


    tfoot {
        display: table-header-group;
    }
</style>