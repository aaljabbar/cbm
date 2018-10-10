<?php 
$menu_id = !isset($menu_id) ? $this->input->post('menu_id') : $menu_id ;
$prv = getPrivilege($menu_id); ?>
<script type="text/css">
    .ui-jqgrid .ui-jqgrid-btable
    {
        table-layout:auto;
    }
</script>
<div class="breadcrumbs" id="breadcrumbs">
    <?php echo getBreadcrumb(array('Tracking Progress','Progress PKS')); ?>
</div>

<!-- /section:basics/content.breadcrumbs -->
<div class="page-content">
    <div class="row">
        <div class="col-xs-12">
            <div class="tabbable">
                <ul class="nav nav-tabs padding-18 tab-size-bigger tab-color-blue">
                    <li class="active">
                        <a href="#" data-toggle="tab" aria-expanded="true" id="tab-1">
                            <i class="blue bigger-120"></i>
                            <strong>Entry Progress PKS</strong>
                        </a>
                    </li>
                    <li class="">
                        <a href="#" data-toggle="tab" aria-expanded="true" id="tab-2">
                            <i class="blue bigger-120"></i>
                            <strong>Dokumen Pendukung</strong>
                        </a>
                    </li>
                    <input type="hidden" id="tab_customer_order_id" value="">
                    <input type="hidden" id="tab_order_no" value="">
                    <input type="hidden" id="tab_status" value="">
                </ul>
            </div>

            <div class="tab-content no-border">

                <div class="row">
                    <div class="col-xs-12">       
                       <table id="grid-table"></table>
                       <div id="grid-pager"></div>

                       <script type="text/javascript">
                            var $path_base = "..";//in Ace demo this will be used for editurl parameter
                        </script>    
                    </div>
                </div>

            <br>

                <!-- PAGE CONTENT BEGINS -->
                <div class="row">
                    <div class="col-xs-12">
                        <table id="grid-table"></table>
                        <div id="grid-pager"></div>
                    </div>
                </div>
                <!-- PAGE CONTENT ENDS -->

                <!-- GRID CHILD -->
                 <div class="row">
                    <div class="col-xs-12">
                        <div id="detailsPlaceholder" style="display:none">
                            <table id="jqGridDetails"></table>
                            <div id="jqGridDetailsPager"></div>
                        </div>
                    </div>
                </div>
                <!-- END GRID CHILD -->
            </div>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.page-content -->

<?php $this->load->view('tracking_progress/lov_cust_pgl.php'); ?>

<script>
  
    jQuery(function($) {
        $( "#tab-2" ).on( "click", function(event) {
            event.stopPropagation();
            var grid = $('#grid-table');
            var rowid = grid.jqGrid ('getGridParam', 'selrow');
            var p_map_pks_id = grid.jqGrid ('getCell', rowid, 'P_MAP_PKS_ID');
            var pgl_name = grid.jqGrid ('getCell', rowid, 'PGL_NAME');
            var status = grid.jqGrid ('getCell', rowid, 'P_ORDER_STATUS_ID');

            if (status == "") {
                status = 1;
            };


            if(p_map_pks_id == "" || p_map_pks_id == null) {
                swal("Informasi", "Silahkan Pilih Salah Satu Baris Data", "info");
                return false;
            }
            
            loadContentWithParams("tracking_progress-pks_doc.php", {
                p_map_pks_id: p_map_pks_id,
                pgl_name: pgl_name,
                status: status,
                menu_id : <?php echo $menu_id; ?>
            });
        });
    });

    function showLovPGL(PGL_ID, PGL_NAME, PGL_ADDR) {        
        modal_lov_cust_pgl_show(PGL_ID, PGL_NAME, PGL_ADDR);
    }

    function submitWF(custId, map_pks_id){
        if (custId == null) {
            custId = 0;
        };
        var idoc_type = 2; //WF PEMBUATAN KONTRAK
        var ireq_type = 2; //WF PEMBUATAN KONTRAK
        //var user_name = rowObject['T_CUSTOMER_ORDER_ID'];
        swal({
            title: "Konfirmasi",
            text: "Apakah Anda yakin akan melakukan submit?",
            type: "warning",
            showCancelButton: true,
            showLoaderOnConfirm: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Ya, Submit!',
            cancelButtonText: "Tidak, cancel!",
            closeOnConfirm: false,
            closeOnCancel: true,
            html: true
         },
         function(isConfirm){
            if (isConfirm){

                cekDetail(map_pks_id,custId, idoc_type, ireq_type);
                // return false;
                
                // swal("Submitted!", "Data berhasil disubmit !", "success");

            } else {
                swal("Cancelled", "Data tidak jadi disubmit :)", "error");
            }
         });
        //alert(map_pks_id);

    }


    jQuery(function($) {
        
        var grid_selector = "#grid-table";
        var pager_selector = "#grid-pager";
        
        $(window).on('resize.jqGrid', function () {
            responsive_jqgrid(grid_selector, pager_selector);
        });
        
        $(document).on('settings.ace.jqGrid' , function(ev, event_name, collapsed) {
            if( event_name === 'sidebar_collapsed' || event_name === 'main_container_fixed' ) {
               responsive_jqgrid(grid_selector, pager_selector);
            }
        });       
        
        
        jQuery("#grid-table").jqGrid({
            url: '<?php echo site_url('tracking_progress/grid_progress_pks');?>',
            datatype: "json",
            mtype: "POST",
            colModel: [
                {label: 'ID', name: 'P_MAP_PKS_ID', key: true, width: 35, sorttype: 'number', sortable: true, editable: true, hidden:true},
                {
                    label: '<center>Submit</center>',
                    name: 'T_CUST_ORDER_ID_ACTION',
                    width: 70, 
                    align: "center",
                    editable: false,
                    formatter: function(cellvalue, options, rowObject) {
                        var order = String(rowObject.ORDER_NO);
                        var status = String(rowObject.P_ORDER_STATUS_ID);
                        var custId = rowObject['T_CUSTOMER_ORDER_ID'];
                        var map_pks_id = rowObject['P_MAP_PKS_ID'];
                        // alert(status);

                        if(!cellvalue){
                            return '<button type="button" class="btn btn-white btn-sm btn-primary" onclick="submitWF('+custId+','+map_pks_id+');">Submit</button>';
                        }else{
                            if(status == 1){
                                return '<button type="button" class="btn btn-white btn-sm btn-primary" onclick="submitWF('+custId+','+map_pks_id+');">Submit</button>>';
                            }else if(status == 2){
                                return '<label style="color:green; font-size: 11px;">IN-PROCESS</label>';
                            }else{
                                return '<label style="color:red; font-size: 11px;">FINISH</label>';
                            }
                        }
                        
                    }
                },
                {   
                    label: 'T_CUSTOMER_ORDER_ID',
                    name: 'T_CUSTOMER_ORDER_ID', 
                    width: 200, 
                    sortable: true, 
                    editable: false,
                    hidden: true
                },
                {
                    label: 'No. Order',
                    name: 'ORDER_NO', 
                    width: 180, 
                    sortable: true, 
                    editable: true,
                    editoptions: {
                        size: 45,
                        readonly: "readonly"
                    },
                    editrules: {required: false}
                },
                {   
                    label: 'Status Order',
                    name: 'P_ORDER_STATUS_ID', 
                    width: 200, 
                    sortable: true, 
                    editable: false,
                    hidden: true
                },
                {   
                    label: 'Status Order',
                    name: 'ORDER_STATUS_CODE', 
                    width: 200, 
                    sortable: true, 
                    editable: false,
                    hidden: true
                },
                {
                    label: 'No. PKS',
                    name: 'NO_PKS', 
                    width: 200, 
                    sortable: true, 
                    editable: false
                },  
                {
                    label: 'Valid From',
                    name: 'VALID_FROM', 
                    width: 100, 
                    sortable: true, 
                    editable: false,
                    formatter: 'date', formatoptions: { srcformat: 'Y-m-d', newformat: 'd-M-Y'}
                }, 
                {
                    label: 'Valid Until',
                    name: 'VALID_UNTIL', 
                    width: 100, 
                    sortable: true, 
                    editable: false,
                    formatter: 'date', formatoptions: { srcformat: 'Y-m-d', newformat: 'd-M-Y'}
                },
                {
                    label: 'Nama Mitra',
                    name: 'PGL_NAME', 
                    width: 200, 
                    sortable: true, 
                    editable: false
                },
                {   label: 'Nama Mitra',
                    name: 'PGL_ID', 
                    width: 100, 
                    sortable: true,  
                    hidden:true, 
                    editable: true,
                    editrules: {edithidden: true, number:true, required:true},
                    edittype: 'custom',
                    editoptions: {
                        "custom_element":function( value  , options) {                            
                            var elm = $('<span></span>');
                            
                            // give the editor time to initialize
                            setTimeout( function() {
                                elm.append('<input id="form_pgl_id" type="text"  style="display:none;">'+
                                        '<input id="form_pgl_name" type="text" disabled class="col-xs-5 jqgrid-required" style="background-color:#FBEC88 !important; margin-left: 3px;" placeholder="Pilih Mitra">'+
                                        '<button class="btn btn-warning btn-sm" type="button" onclick="showLovPGL(\'form_pgl_id\',\'form_pgl_name\',\'PGL_ADDR\')">'+
                                        '   <span class="ace-icon fa fa-search icon-on-right bigger-110"></span>'+
                                        '</button>');
                                $("#form_pgl_id").val(value);
                                elm.parent().removeClass('jqgrid-required');
                            }, 100);
                            
                            return elm;
                        },
                        "custom_value":function( element, oper, gridval) {
                            
                            if(oper === 'get') {
                                return $("#form_pgl_id").val();
                            } else if( oper === 'set') {
                                $("#form_pgl_id").val(gridval);
                                var gridId = this.id;
                                // give the editor time to set display
                                setTimeout(function(){
                                    var selectedRowId = $("#"+gridId).jqGrid ('getGridParam', 'selrow');
                                    if(selectedRowId != null) {
                                        var code_display = $("#"+gridId).jqGrid('getCell', selectedRowId, 'PGL_NAME');
                                        $("#form_pgl_name").val( code_display );
                                    }
                                },100);
                            }
                        }
                    }
                },
                {
                    label: 'Alamat Mitra',
                    name: 'PGL_ADDR', 
                    edittype: 'textarea',
                    width: 200, 
                    sortable: true, 
                    hidden:true, 
                    editable: true,
                    editoptions: {
                                    style : 'width:400px;background-color: #f5f5f5;',
                                    rows : 2,
                                    readonly: "readonly"
                    },
                    editrules: {edithidden: true, required:false}
                },
                {
                    label: 'Keterangan',
                    name: 'DESCRIPTION', 
                    edittype: 'textarea',
                    width: 200, 
                    sortable: true, 
                    hidden:true, 
                    editable: true,
                    editoptions: {
                                    style : 'width:400px',
                                    rows : 3
                    },
                    editrules: {edithidden: true, required:false}
                },  
                {
                    label: 'Message Reject',
                    name: 'MESSAGE_TXT', 
                    edittype: 'textarea',
                    width: 200, 
                    sortable: true, 
                    editable: false
                },              
                {label: 'Tgl Pembuatan', name: 'CREATION_DATE', width: 120, align: "left", hidden:true, editable: false},
                {label: 'Dibuat Oleh', name: 'CREATED_BY', width: 120, align: "left", hidden:true, editable: false},
                {label: 'Tgl Update', name: 'UPDATED_DATE', width: 120, align: "left", hidden:true, editable: false},
                {label: 'Diupdate Oleh', name: 'UPDATED_BY', width: 120, align: "left", hidden:true, editable: false}
            ],
            height: '100%',
            autowidth: true,
            rowNum: 10,
            viewrecords: true,
            rowList: [5, 10, 20],
            rownumbers: true, // show row numbers
            rownumWidth: 35, // the width of the row numbers columns
            altRows: true,
            shrinkToFit: true,
            multiboxonly: true,
            onSelectRow: function (rowid) {
                var celValue = $('#grid-table').jqGrid('getCell', rowid, 'T_CUSTOMER_ORDER_ID');
                var celCode = $('#grid-table').jqGrid('getCell', rowid, 'ORDER_NO');
                var status = $('#grid-table').jqGrid('getCell', rowid, 'P_ORDER_STATUS_ID');
                //var custId = $('#cust_id');

                      //alert(custId);
                if(status == ""){
                    status = 1;
                }
                if(!celValue){
                    $('#edit_grid-table').show();
                    $('#del_grid-table').show();
                }else{
                    if (status == 1){
                        $('#edit_grid-table').show();
                        $('#del_grid-table').show();
                    }else{
                        $('#edit_grid-table').hide();
                        $('#del_grid-table').hide();
                    }
                    
                }
                //alert(status);
         
                $('#tab_customer_order_id').val(celValue);
                $('#tab_order_no').val(celCode);
                $('#tab_status').val(status);

                var t_cust_order_id = $('#grid-table').jqGrid('getCell', rowid, 'T_CUSTOMER_ORDER_ID');
                // alert(t_cust_order_id);
                if (rowid != null) {
                     $("#jqGridDetails").jqGrid('setGridParam', {
                        url: "<?php echo site_url('tracking_progress/gridMessage');?>" ,
                        datatype: 'json',
                        postData: {T_CUSTOMER_ORDER_ID: t_cust_order_id},
                        userData: {row: rowid}
                    });
                     $("#jqGridDetails").jqGrid('setCaption', 'Message :: ' + celCode);
                    $("#detailsPlaceholder").show();
                    $("#jqGridDetails").trigger("reloadGrid");
                }
                
            },
            onSortCol: clearSelection,
            onPaging: clearSelection,
            pager: '#grid-pager',
            jsonReader: {
                root: 'Data',
                id: 'id',
                repeatitems: false
            },
            loadComplete: function () {
                var table = this;
                setTimeout(function () {
                    updatePagerIcons(table);
                }, 0);

            },

            //memanggil controller jqgrid yang ada di controller crud
            editurl: '<?php echo site_url('tracking_progress/crud_progress_pks');?>',
            caption: "Progress PKS"
        });

        jQuery('#grid-table').jqGrid('navGrid', '#grid-pager',
            {   //navbar options
                edit: <?php
                if ($prv['UBAH'] == "Y") {
                    echo 'true';
                } else {
                    echo 'false';

                }
                ?>,
                editicon: 'ace-icon fa fa-pencil blue',
                add:  <?php
                if ($prv['TAMBAH'] == "Y") {
                    echo 'true';
                } else {
                    echo 'false';

                }
                ?>,
                addicon: 'ace-icon fa fa-plus-circle purple',
                del: <?php
                if ($prv['HAPUS'] == "Y") {
                    echo 'true';
                } else {
                    echo 'false';

                }
                ?>,
                delicon: 'ace-icon fa fa-trash-o red',
                search: true,
                searchicon: 'ace-icon fa fa-search orange',
                refresh: true,
                afterRefresh: function () {
                    // some code here
                    
                },

                refreshicon: 'ace-icon fa fa-refresh green',
                view: false,
                viewicon: 'ace-icon fa fa-search-plus grey'
            },

            {
                // options for the Edit Dialog
                closeAfterEdit: true,
                closeOnEscape:true,
                recreateForm: true,
                width: 'auto',
                errorTextFormat: function (data) {
                    return 'Error: ' + data.responseText
                },
                beforeShowForm: function (e, form) {
                    var form = $(e[0]);
                    form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
                    style_edit_form(form);
                    form.css({"height": 0.40*screen.height+"px"});
                    form.css({"width": 0.50*screen.width+"px"});
                                      
                },
                afterShowForm: function(form) {
                    form.closest('.ui-jqdialog').center();
                    $(".mce-widget").hide();
                },
                afterSubmit:function(response,postdata) {
                    var response = jQuery.parseJSON(response.responseText);
                    if(response.success == false) {
                        return [false,response.message,response.responseText];
                    }
                    return [true,"",response.responseText];
                }
            },
            {
                //new record form
                closeAfterAdd: false,
                clearAfterAdd : true,
                closeOnEscape:true,
                recreateForm: true,
                width: 'auto',
                errorTextFormat: function (data) {
                    return 'Error: ' + data.responseText
                },
                viewPagerButtons: false,
                beforeShowForm: function (e, form) {
                    var form = $(e[0]);
                    form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar')
                        .wrapInner('<div class="widget-header" />')
                    style_edit_form(form);
                    form.css({"height": 0.40*screen.height+"px"});
                    form.css({"width": 0.50*screen.width+"px"});

                    setTimeout( function() {    
                        $('#form_pgl_id').val('');
                        $('#form_pgl_name').val('');
                    }, 100);
                    
                },
                afterShowForm: function(form) {
                    form.closest('.ui-jqdialog').center();
                    $(".mce-widget").hide();

                },
                afterSubmit:function(response,postdata) {
                    var response = jQuery.parseJSON(response.responseText);
                    if(response.success == false) {
                        return [false,response.message,response.responseText];
                    }
                    
                    $(".topinfo").html('<div class="ui-state-success">' + response.message + '</div>'); 
                    var tinfoel = $(".tinfo").show();
                    tinfoel.delay(3000).fadeOut();
                    $('#form_pgl_id').val('');
                    $('#form_pgl_name').val('');

                    return [true,"",response.responseText];
                }
            },
            {
                //delete record form
                recreateForm: true,
                beforeShowForm: function (e) {
                    var form = $(e[0]);
                    if (form.data('styled')) return false;

                    form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
                    style_delete_form(form);

                    form.data('styled', true);
                },
                afterShowForm: function(form) {
                    form.closest('.ui-jqdialog').center();
                },
                onClick: function (e) {
                    //alert(1);
                },
                afterSubmit:function(response,postdata) {
                    var response = jQuery.parseJSON(response.responseText);
                    if(response.success == false) {
                        return [false,response.message,response.responseText];
                    }
                    return [true,"",response.responseText];
                }
            },
            {
                //search form
                closeAfterSearch: false,
                recreateForm: true,
                afterShowSearch: function (e) {
                    var form = $(e[0]);
                    form.closest('.ui-jqdialog').find('.ui-jqdialog-title').wrap('<div class="widget-header" />')
                    style_search_form(form);
                    
                    form.closest('.ui-jqdialog').center();
                },
                afterRedraw: function () {
                    style_search_filters($(this));
                }
            },
            {
                //view record form
                recreateForm: true,
                beforeShowForm: function (e) {
                    var form = $(e[0]);
                    form.closest('.ui-jqdialog').find('.ui-jqdialog-title').wrap('<div class="widget-header" />')
                }
            }
        );
        
    }); /* end jquery onload */

    //JqGrid Detail
    $("#jqGridDetails").jqGrid({
        mtype: "POST",
        datatype: "json",
        colModel: [
            {label: 'Pekerjaan', name: 'PROC_NAME', width:300, editable: true},
            {label: 'Status', name: 'PROFILE_TYPE', editable: false, hidden: false},
            {label: 'Sender', name: 'USER_NAME', editable: false, hidden: false},
            {label: 'Message', name: 'MESSAGE', width:400, editable: false}
        ],
        autowidth: true,
        height: '100%',
        rowNum: 5,
        page: 1,
        shrinkToFit: false,
        rownumbers: true,
        rownumWidth: 35, // the width of the row numbers columns
        viewrecords: true,
        sortname: 'T_PRODUCT_ORDER_CONTROL_ID ', // default sorting ID
        caption: 'Message',
        sortorder: 'asc',
        pager: "#jqGridDetailsPager",
        jsonReader: {
            root: 'Data',
            id: 'id',
            repeatitems: false
        },
        loadComplete: function () {
            // var table = this;
            // setTimeout(function () {
                //  styleCheckbox(table);

                //  updateActionIcons(table);
                // updatePagerIcons(table);
                // enableTooltips(table);
            // }, 0);
        },
    });

    //navButtons Grid Detail
    $('#jqGridDetails').jqGrid('navGrid', '#jqGridDetailsPager',
        {   //navbar options
            edit: false,
            excel: true,
            editicon: 'ace-icon fa fa-pencil blue',
            add: false,
            addicon: 'ace-icon fa fa-plus-circle purple',
            del: false,
            delicon: 'ace-icon fa fa-trash-o red',
            search: true,
            searchicon: 'ace-icon fa fa-search orange',
            refresh: true,
            refreshicon: 'ace-icon fa fa-refresh green',
            view: false,
            viewicon: 'ace-icon fa fa-search-plus grey'
        },
        {

            // options for the Edit Dialog
            closeAfterEdit: true,
            width: 500,
            errorTextFormat: function (data) {
                return 'Error: ' + data.responseText
            },
            recreateForm: true,
            beforeShowForm: function (e) {
                var form = $(e[0]);
                form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />');
                style_edit_form(form);
            }
        },
        {
            //new record form
            width: 400,
            errorTextFormat: function (data) {
                return 'Error: ' + data.responseText
            },
            closeAfterAdd: true,
            recreateForm: true,
            viewPagerButtons: false,
            beforeShowForm: function (e) {
                var form = $(e[0]);
                form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar')
                    .wrapInner('<div class="widget-header" />');
                style_edit_form(form);
            }

        },
        {
            //delete record form
            recreateForm: true,
            beforeShowForm: function (e) {
                var form = $(e[0]);
                if (form.data('styled')) return false;

                form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />');
                style_delete_form(form);

                form.data('styled', true);
            },
            onClick: function (e) {
                //alert(1);
            }
        },
        {
            //search form
            //closeAfterSearch: true,
            recreateForm: true,
            afterShowSearch: function (e) {
                var form = $(e[0]);
                form.closest('.ui-jqdialog').find('.ui-jqdialog-title').wrap('<div class="widget-header" />');
                style_search_form(form);
            },
            afterRedraw: function () {
                style_search_filters($(this));
            }

            // multipleSearch: true
            /**
             multipleGroup:true,
             showQuery: true
             */
        },
        {
            //view record form
            recreateForm: true,
            beforeShowForm: function (e) {
                var form = $(e[0]);
                form.closest('.ui-jqdialog').find('.ui-jqdialog-title').wrap('<div class="widget-header" />')
            }
        }
    );

    function clearSelection() {

        // return null;
        var jqGridDetail = $("#jqGridDetails");
        // jqGridDetail.jqGrid('setCaption', 'Menu Child ::');
        jqGridDetail.jqGrid("clearGridData");
    }

    function style_edit_form(form) {
        //enable datepicker on "sdate" field and switches for "stock" field
        form.find('input[name=sdate]').datepicker({format: 'yyyy-mm-dd', autoclose: true})

        form.find('input[name=stock]').addClass('ace ace-switch ace-switch-5').after('<span class="lbl"></span>');
        form.find('input[name=stock]').addClass('ace ace-switch ace-switch-5').after('<span class="lbl"></span>');
        //don't wrap inside a label element, the checkbox value won't be submitted (POST'ed)
        //.addClass('ace ace-switch ace-switch-5').wrap('<label class="inline" />').after('<span class="lbl"></span>');


        //update buttons classes
        var buttons = form.next().find('.EditButton .fm-button');
        buttons.addClass('btn btn-sm').find('[class*="-icon"]').hide();//ui-icon, s-icon
        buttons.eq(0).addClass('btn-primary').prepend('<i class="ace-icon fa fa-check"></i>');
        buttons.eq(1).prepend('<i class="ace-icon fa fa-times"></i>')

        buttons = form.next().find('.navButton a');
        buttons.find('.ui-icon').hide();
        buttons.eq(0).append('<i class="ace-icon fa fa-chevron-left"></i>');
        buttons.eq(1).append('<i class="ace-icon fa fa-chevron-right"></i>');
    }

    function style_delete_form(form) {
        var buttons = form.next().find('.EditButton .fm-button');
        buttons.addClass('btn btn-sm btn-white btn-round').find('[class*="-icon"]').hide();//ui-icon, s-icon
        buttons.eq(0).addClass('btn-danger').prepend('<i class="ace-icon fa fa-trash-o"></i>');
        buttons.eq(1).addClass('btn-default').prepend('<i class="ace-icon fa fa-times"></i>')
    }

    function style_search_filters(form) {
        form.find('.delete-rule').val('X');
        form.find('.add-rule').addClass('btn btn-xs btn-primary');
        form.find('.add-group').addClass('btn btn-xs btn-success');
        form.find('.delete-group').addClass('btn btn-xs btn-danger');
    }
    function style_search_form(form) {
        var dialog = form.closest('.ui-jqdialog');
        var buttons = dialog.find('.EditTable')
        buttons.find('.EditButton a[id*="_reset"]').addClass('btn btn-sm btn-info').find('.ui-icon').attr('class', 'ace-icon fa fa-retweet');
        buttons.find('.EditButton a[id*="_query"]').addClass('btn btn-sm btn-inverse').find('.ui-icon').attr('class', 'ace-icon fa fa-comment-o');
        buttons.find('.EditButton a[id*="_search"]').addClass('btn btn-sm btn-purple').find('.ui-icon').attr('class', 'ace-icon fa fa-search');
    }

    function beforeDeleteCallback(e) {
        var form = $(e[0]);
        if (form.data('styled')) return false;

        form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
        style_delete_form(form);

        form.data('styled', true);
    }

    function beforeEditCallback(e) {
        var form = $(e[0]);
        form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
        style_edit_form(form);
    }

    function updatePagerIcons(table) {
        var replacement =
        {
            'ui-icon-seek-first': 'ace-icon fa fa-angle-double-left bigger-140',
            'ui-icon-seek-prev': 'ace-icon fa fa-angle-left bigger-140',
            'ui-icon-seek-next': 'ace-icon fa fa-angle-right bigger-140',
            'ui-icon-seek-end': 'ace-icon fa fa-angle-double-right bigger-140'
        };
        $('.ui-pg-table:not(.navtable) > tbody > tr > .ui-pg-button > .ui-icon').each(function () {
            var icon = $(this);
            var $class = $.trim(icon.attr('class').replace('ui-icon', ''));

            if ($class in replacement) icon.attr('class', 'ui-icon ' + replacement[$class]);
        })
    }

    function responsive_jqgrid(grid_selector, pager_selector) {
        var parent_column = $(grid_selector).closest('[class*="col-"]');
        $(grid_selector).jqGrid( 'setGridWidth', $(".page-content").width() );
        $(pager_selector).jqGrid( 'setGridWidth', parent_column.width() );
    }

    function cekDetail(p_map_pks_id,custId, idoc_type, ireq_type){
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: '<?php echo site_url('tracking_progress/cekDetailPKS');?>',
            data: { p_map_pks_id : p_map_pks_id
            },
            timeout: 10000,
            success: function(data) {
                if (!data.success) {
                    swal("Informasi",data.message,"info");
                   // return false;
                }else{
                    $.ajax({
                        type: 'POST',
                        datatype: "json",
                        url: '<?php echo site_url('tracking_progress/submitWF');?>',
                        data: { 
                                DOC_TYPE : idoc_type,
                                REQ_TYPE : ireq_type,
                                T_CUSTOMER_ORDER_ID :custId,
                                P_MAP_PKS_ID :p_map_pks_id
                        },
                        timeout: 10000,
                        success: function(data) {
                            var response = JSON.parse(data);
                            if(response.success) {
                                jQuery('#grid-table').trigger("reloadGrid");
                                $('#edit_grid-table').show();
                                $('#del_grid-table').show();
                                swal("Submitted!", "Data berhasil disubmit !", "success");
                            }else {
                                swal("", data.message, "warning");
                            }
                        }
                    });
                };
            }
        });
    }
    
</script>