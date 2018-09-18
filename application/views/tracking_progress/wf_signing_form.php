<!-- #section:basics/content.breadcrumbs -->
<div class="breadcrumbs" id="breadcrumbs">
    <?php echo getBreadcrumb(array('Workflow Summary','Signing Step')); ?>
</div>

<div class="page-content">
    <!-- parameter untuk kembali ke workflow summary -->
    <input type="hidden" id="TEMP_ELEMENT_ID" value="<?php echo $this->input->post('ELEMENT_ID'); ?>" />
    <input type="hidden" id="TEMP_PROFILE_TYPE" value="<?php echo $this->input->post('PROFILE_TYPE'); ?>" />
    <input type="hidden" id="TEMP_P_W_DOC_TYPE_ID" value="<?php echo $this->input->post('P_W_DOC_TYPE_ID'); ?>" />
    <input type="hidden" id="TEMP_P_W_PROC_ID" value="<?php echo $this->input->post('P_W_PROC_ID'); ?>" />
    <input type="hidden" id="TEMP_USER_ID" value="<?php echo $this->input->post('USER_ID'); ?>" />
    <input type="hidden" id="TEMP_FSUMMARY" value="<?php echo $this->input->post('FSUMMARY'); ?>" />
    <!-- end type hidden -->

    <!-- paramater untuk kebutuhan submit dan status -->
    <input type="hidden" id="CURR_DOC_ID" value="<?php echo $this->input->post('CURR_DOC_ID'); ?>">
    <input type="hidden" id="CURR_DOC_TYPE_ID" value="<?php echo $this->input->post('CURR_DOC_TYPE_ID'); ?>">
    <input type="hidden" id="CURR_PROC_ID" value="<?php echo $this->input->post('CURR_PROC_ID'); ?>">
    <input type="hidden" id="CURR_CTL_ID" value="<?php echo $this->input->post('CURR_CTL_ID'); ?>">
    <input type="hidden" id="USER_ID_DOC" value="<?php echo $this->input->post('USER_ID_DOC'); ?>">
    <input type="hidden" id="USER_ID_DONOR" value="<?php echo $this->input->post('USER_ID_DONOR'); ?>">
    <input type="hidden" id="USER_ID_LOGIN" value="<?php echo $this->input->post('USER_ID_LOGIN'); ?>">
    <input type="hidden" id="USER_ID_TAKEN" value="<?php echo $this->input->post('USER_ID_TAKEN'); ?>">
    <input type="hidden" id="IS_CREATE_DOC" value="<?php echo $this->input->post('IS_CREATE_DOC'); ?>">
    <input type="hidden" id="IS_MANUAL" value="<?php echo $this->input->post('IS_MANUAL'); ?>">
    <input type="hidden" id="CURR_PROC_STATUS" value="<?php echo $this->input->post('CURR_PROC_STATUS'); ?>">
    <input type="hidden" id="CURR_DOC_STATUS" value="<?php echo $this->input->post('CURR_DOC_STATUS'); ?>">
    <input type="hidden" id="PREV_DOC_ID" value="<?php echo $this->input->post('PREV_DOC_ID'); ?>">
    <input type="hidden" id="PREV_DOC_TYPE_ID" value="<?php echo $this->input->post('PREV_DOC_TYPE_ID'); ?>">
    <input type="hidden" id="PREV_PROC_ID" value="<?php echo $this->input->post('PREV_PROC_ID'); ?>">
    <input type="hidden" id="PREV_CTL_ID" value="<?php echo $this->input->post('PREV_CTL_ID'); ?>">
    <input type="hidden" id="SLOT_1" value="<?php echo $this->input->post('SLOT_1'); ?>">
    <input type="hidden" id="SLOT_2" value="<?php echo $this->input->post('SLOT_2'); ?>">
    <input type="hidden" id="SLOT_3" value="<?php echo $this->input->post('SLOT_3'); ?>">
    <input type="hidden" id="SLOT_4" value="<?php echo $this->input->post('SLOT_4'); ?>">
    <input type="hidden" id="SLOT_5" value="<?php echo $this->input->post('SLOT_5'); ?>">
    <input type="hidden" id="MESSAGE" value="<?php echo $this->input->post('MESSAGE'); ?>">
    <input type="hidden" id="PROFILE_TYPE" value="<?php echo $this->input->post('PROFILE_TYPE'); ?>">
    <input type="hidden" id="ACTION_STATUS" value="<?php echo $this->input->post('ACTION_STATUS'); ?>">
    <!-- end type hidden -->
    <div class="row">
        <div class="widget-box">
            <div class="widget-header widget-header-blue widget-header-flat">
                <h4 class="widget-title lighter"> SIGNING STEP </h4>
            </div>


            <div class="widget-body">
                <div class="widget-main">
                    <div id="fuelux-wizard-container">
                        <div>
                            <ul class="steps">
                                <li data-step="1" class="active">
                                    <span class="step">1</span>
                                    <span class="title">Initial Step</span>
                                </li>

                                <li data-step="2">
                                    <span class="step">2</span>
                                    <span class="title">Signing Step</span>
                                </li>

                            </ul>

                        </div>

                        <hr />

                        <div class="step-content pos-rel">
                            <div class="step-pane active" data-step="1">
                                <form class="form-horizontal" id="sample-form">

                                    <input id="form_t_customer_order_id" name="t_customer_order_id" type="text" value="<?php echo $this->input->post('CURR_DOC_ID'); ?>" style="display:none;">
                                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                    <input type="hidden" id="p_map_pks_id" name="p_map_pks_id" />

                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="name">No. Order:</label>
                                        <div class="col-sm-10">
                                            <div class="clearfix">
                                                <input type="text" id="order_no" name="order_no" class="col-sm-3" readonly />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="name">Tanggal:</label>
                                        <div class="col-sm-10">
                                            <div class="clearfix">
                                                <input type="text" id="order_date" name="order_date" class="col-sm-2" readonly />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="name">Nama Mitra:</label>
                                        <div class="col-sm-10">
                                            <div class="clearfix">
                                                <input type="text" id="nama_mitra" name="nama_mitra" class="col-sm-5" readonly />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="name">Alamat Mitra:</label>
                                        <div class="col-sm-10">
                                            <div class="clearfix">
                                                <textarea rows="3" class="col-sm-5" id="alamat_mitra" name="alamat_mitra" style="background-color: #F5F5F5;" readonly />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="name">Approval Telkom:</label>
                                        <div class="col-sm-10">
                                            <div class="clearfix">   
                                                <input type="text" id="approval_telkom" name="approval_telkom" class="col-sm-2" readonly />                                            
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="name">Approval Mitra:</label>
                                        <div class="col-sm-10">
                                            <div class="clearfix">         
                                                <input type="text" id="approval_mitra" name="approval_mitra" class="col-sm-2" readonly />                                      
                                            </div>
                                        </div>
                                    </div>

                                </form>

                                <table id="grid-detail-download" class="table table-striped table-bordered table-hover">
                                    <thead>
                                      <tr>
                                            <th data-column-id="P_MAP_PKS_ID" data-visible="false">ID</th>
                                            <th data-column-id="ORG_FILENAME" data-width="200">Filename</th>
                                            <th data-column-id="DESCRIPTION">Description</th>                                             
                                            <th data-column-id="action" data-formatter="action" data-width="100" data-header-align="center" data-align="center">Download</th>                                                                                       
                                      </tr>
                                    </thead>
                                </table>
                               
                            </div>

                            <div class="step-pane" data-step="2">
                                <div class="col-sm-12">
                                    <center><h3>Table Status Signing</h3></center>
                                    <!-- <a id="add_log" class="btn btn-white btn-sm btn-round">
                                        <i class="ace-icon fa fa-plus green"></i>
                                        Add
                                    </a> -->
                                </div>
                                <table id="grid-signing" class="table table-striped table-bordered table-hover">
                                    <thead>
                                      <tr>
                                            <th data-column-id="SIGNING_STEP_ID" data-visible="false">ID</th>
                                            <th data-column-id="REF_LIST_ID" data-visible="false">ID</th>
                                            <th data-column-id="SIGN_DOC_TYPE" data-visible="false">ID</th>
                                            <th data-column-id="EXTERNAL_ID" data-visible="false">ID</th>
                                            <th data-column-id="P_REFERENCE_TYPE_ID" data-visible="false">ID</th>
                                            <th data-column-id="P_REFERENCE_LIST_ID" data-visible="false">ID</th>
                                            <th data-column-id="DOC_TYPE_ID" data-visible="false">ID</th>
                                            <th data-column-id="REFERENCE_NAME">Signing Step</th> 
                                            <th data-column-id="START_DATE" data-width="150" data-header-align="center" data-align="center">Start Date</th>
                                            <th data-column-id="FINISH_DATE" data-width="150" data-header-align="center" data-align="center">Finish Date</th>
                                            <th data-column-id="DUE_DATE_NUM" data-width="100" data-header-align="center" data-align="center">Due Date</th>
                                            <th data-column-id="STATUS" data-width="100" data-header-align="center" data-align="center">Status</th>  
                                            <th data-column-id="action" data-formatter="action" data-width="160" data-header-align="center" data-align="center">Action</th>               
                                                                              
                                      </tr>
                                    </thead>
                                </table>

                            </div>

                        </div>

                    </div>

                    <hr />
                    <div class="wizard-actions">
                        <button class="btn btn-prev">
                            <i class="ace-icon fa fa-arrow-left"></i>
                            Prev
                        </button>

                        <button class="btn btn-primary btn-next" data-last="Finish">
                            Next
                            <i class="ace-icon fa fa-arrow-right icon-on-right"></i>
                        </button>

                    </div>

                </div>
            </div>
        </div>

    </div>  
  
</div>

<?php 
    $this->load->view('wf/lov_submitter.php'); 
    $this->load->view('tracking_progress/lov_signing.php'); 
?>

<script src="<?php echo base_url(); ?>assets/js/fuelux/fuelux.wizard.js"></script>
<script>    
    
    $(function() {           

        /* parameter kembali ke workflow summary */
        params_back_summary = {};
        params_back_summary.ELEMENT_ID = $('#TEMP_ELEMENT_ID').val();
        params_back_summary.PROFILE_TYPE = $('#TEMP_PROFILE_TYPE').val();
        params_back_summary.P_W_DOC_TYPE_ID = $('#TEMP_P_W_DOC_TYPE_ID').val();
        params_back_summary.P_W_PROC_ID = $('#TEMP_P_W_PROC_ID').val();
        params_back_summary.USER_ID = $('#TEMP_USER_ID').val();
        params_back_summary.FSUMMARY = $('#TEMP_FSUMMARY').val();
        /* end parameter */   

        $('#fuelux-wizard-container').ace_wizard().on('finished.fu.wizard', function(e) {
            var params_submit = {};
            
            params_submit.CURR_DOC_ID         = $('#CURR_DOC_ID').val();  
            params_submit.CURR_DOC_TYPE_ID    = $('#CURR_DOC_TYPE_ID').val();
            params_submit.CURR_PROC_ID        = $('#CURR_PROC_ID').val();
            params_submit.CURR_CTL_ID         = $('#CURR_CTL_ID').val();
            params_submit.USER_ID_DOC         = $('#USER_ID_DOC').val();
            params_submit.USER_ID_DONOR       = $('#USER_ID_DONOR').val();
            params_submit.USER_ID_LOGIN       = $('#USER_ID_LOGIN').val();
            params_submit.USER_ID_TAKEN       = $('#USER_ID_TAKEN').val();
            params_submit.IS_CREATE_DOC       = $('#IS_CREATE_DOC').val();
            params_submit.IS_MANUAL           = $('#IS_MANUAL').val();
            params_submit.CURR_PROC_STATUS    = $('#CURR_PROC_STATUS').val();
            params_submit.CURR_DOC_STATUS     = $('#CURR_DOC_STATUS').val();
            params_submit.PREV_DOC_ID         = $('#PREV_DOC_ID').val();
            params_submit.PREV_DOC_TYPE_ID    = $('#PREV_DOC_TYPE_ID').val();
            params_submit.PREV_PROC_ID        = $('#PREV_PROC_ID').val();
            params_submit.PREV_CTL_ID         = $('#PREV_CTL_ID').val();
            params_submit.SLOT_1              = $('#SLOT_1').val();    
            params_submit.SLOT_2              = $('#SLOT_2').val(); 
            params_submit.SLOT_3              = $('#SLOT_3').val();    
            params_submit.SLOT_4              = $('#SLOT_4').val();  
            params_submit.SLOT_5              = $('#SLOT_5').val();    
            params_submit.MESSAGE             = $('#MESSAGE').val();    
            params_submit.PROFILE_TYPE        = $('#PROFILE_TYPE').val();
            params_submit.ACTION_STATUS       = $('#ACTION_STATUS').val();

            cekStatus($('#p_map_pks_id').val(), params_submit, params_back_summary);

            /*if(cekStatus($('#p_map_pks_id').val())){
                if (  $('#ACTION_STATUS').val() != 'VIEW' ) {
                modal_lov_submitter_show(params_submit, params_back_summary); 
                } else {
                    loadContentWithParams( $('#TEMP_FSUMMARY').val() , params_back_summary );
                }
            }*/

            
        });  

        /*ketika link 'workflow summary' diklik, maka kembali ke summary */
        $("a").on('click', function(e) {
            var txt = $(e.target).text();
            if( txt.toLowerCase() == 'workflow summary' ) {
                loadContentWithParams( $('#TEMP_FSUMMARY').val() , params_back_summary );
            }
        });

        /*ketika tombol cancel diklik, maka kembali ke summary*/
        $("#form_customer_order_btn_cancel").on('click', function() {
            loadContentWithParams( $('#TEMP_FSUMMARY').val() , params_back_summary );
        });



        /* cek jika tipe view */
        if (  $('#ACTION_STATUS').val() == 'VIEW' ) {
            $('#btn-submit').hide();
        }

        /* mengisi form customer order */
        $.ajax({
            type: 'POST',
            datatype: "json",
            url: '<?php echo site_url('tracking_progress/grid_progress_pks');?>',
            data: { t_customer_order_id : $("#CURR_DOC_ID").val(), 
                    p_w_proc_id : $('#TEMP_P_W_PROC_ID').val(),
                    page:1, 
                    rows:1,
                    sord:'',
                    _search:'',
                    sidx:''
            },
            timeout: 10000,
            success: function(data) {
                var response = JSON.parse( data );
                var items = response.Data[0];
                
                $("#order_no").val( items.ORDER_NO );
                $("#nama_mitra").val( items.PGL_NAME );
                $("#order_date").val( items.ORDER_DATE );
                $("#p_map_pks_id").val( items.P_MAP_PKS_ID );
                $("#alamat_mitra").val( items.PGL_ADDR );
                $("#approval_telkom").val( items.VER_DATE_TLK );
                $("#approval_mitra").val( items.VER_DATE_MITRA );
                
                loadgrid(items.P_MAP_PKS_ID);
            }
        });

        function cekStatus(p_map_pks_id, params_submit, params_back_summary){
            $.ajax({
                type: 'POST',
                dataType: "json",
                url: '<?php echo site_url('tracking_progress/cekStatus');?>',
                data: { p_map_pks_id : p_map_pks_id
                },
                timeout: 10000,
                success: function(data) {
                    if (!data.success) {
                        // swal("Informasi",data.message,"info");
                        swal({html: true, title: "Informasi", text: data.message, type: "info"});
                        //return data.success;
                    }else{
                        // alert('masuk');
                        if (  $('#ACTION_STATUS').val() != 'VIEW' ) {
                            modal_lov_submitter_show(params_submit, params_back_summary); 
                        } else {
                            loadContentWithParams( $('#TEMP_FSUMMARY').val() , params_back_summary );
                        }
                    };
                    // return data.success;
                }
            });
        }

        function loadgrid(p_map_pks_id){
            $("#grid-signing").bootgrid({
                ajax: true,
                post: function ()
                {
                    return {
                        "p_map_pks_id": p_map_pks_id
                    };
                },
                url: "<?php echo site_url('tracking_progress/getSigningPKS');?>",
                navigation:0,
                formatters: {
                    "action": function(column, row)
                    {
                        var SIGNING_STEP_ID = row.SIGNING_STEP_ID;
                        var STATUS = row.STATUS;
                        var REFERENCE_NAME = row.REFERENCE_NAME;
                        var START_DATE = row.START_DATE;
                        var FINISH_DATE = row.FINISH_DATE;
                        var REF_LIST_ID = row.REF_LIST_ID;
                        var SIGN_DOC_TYPE = row.SIGN_DOC_TYPE;
                        var EXTERNAL_ID = row.EXTERNAL_ID;

                        if(STATUS == 'OPEN'){
                            return '<button type="button" class="btn btn-xs btn-primary" onclick="updateSign(\''+SIGNING_STEP_ID+'\',\''+REFERENCE_NAME+'\',\''+STATUS+'\',\''+START_DATE+'\',\''+FINISH_DATE+'\',\''+REF_LIST_ID+'\',\''+SIGN_DOC_TYPE+'\',\''+EXTERNAL_ID+'\')"> Update </button> <button type="button" class="btn btn-xs btn-danger" onclick="updateCancel(\''+SIGNING_STEP_ID+'\',\''+REFERENCE_NAME+'\',\''+STATUS+'\',\''+START_DATE+'\',\''+FINISH_DATE+'\',\''+REF_LIST_ID+'\',\''+SIGN_DOC_TYPE+'\',\''+EXTERNAL_ID+'\')"> Cancel </button>';
                        }else if (STATUS == 'CLOSE'){
                            return '';
                        }
                    }

                }
            });
        }

        /*menyimpan data customer order */
        $("#btn-approval").on('click', (function (e) {
            var data = $(this).serialize();
            $.ajax({
                url: "<?php echo site_url('tracking_progress/update_ver_mitra');?>", // Url to which the request is send
                type: "POST",             // Type of request to be send, called as method
                data: {
                    p_map_pks_id: $("#p_map_pks_id").val()
                }, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                dataType: "json",
                success: function (data)   // A function to be called if request succeeds
                {
                    if (data.success == true) {
                        swal("", data.msg, "success");
                        $("#status_approval").text('APPROVED By Mitra');
                        $("#btn-approval").hide();
                    } else {
                        swal("", data.msg, "error");
                        $("#status_approval").text('NOT APPROVED');
                    }
                }
            });
            return false;
        }));
        
    });

    $("#grid-detail-download").bootgrid({
        ajax: true,
        post: function ()
        {
            return {
                "t_customer_order_id": $("#CURR_DOC_ID").val()
            };
        },
        url: "<?php echo site_url('tracking_progress/getDetailPKS');?>",
        navigation:0,
        formatters: {
            "action": function(column, row)
            {
                var location = "./"+row.PATH_FILE+"/"+row.FILE_NAME;
                var file_name = row.FILE_NAME;
                return '<button type="button" class="btn btn-xs btn-primary" onclick="downloadDoc(\''+location+'\',\''+file_name+'\')"> Download </button>';
            }

        }
    });

    function downloadDoc(location,file_name){

        var url = "<?php echo base_url();?>tracking_progress/download?";
        url += "location=" + location;
        url += "&file_name=" + file_name;
        url += "&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>";
        window.location = url;
        // window.location = url;
    }


    function updateSign(SIGNING_STEP_ID, REFERENCE_NAME, STATUS, START_DATE, FINISH_DATE, REF_LIST_ID, SIGN_DOC_TYPE, EXTERNAL_ID){
        // alert(EXTERNAL_ID);
        modal_lov_signing_show(SIGNING_STEP_ID, REFERENCE_NAME, STATUS, START_DATE, FINISH_DATE, REF_LIST_ID, SIGN_DOC_TYPE, EXTERNAL_ID);
    }

    function updateCancel(SIGNING_STEP_ID, REFERENCE_NAME, STATUS, START_DATE, FINISH_DATE, REF_LIST_ID, SIGN_DOC_TYPE, EXTERNAL_ID){
        $.ajax({
                type: 'POST',
                dataType: "json",
                url: '<?php echo site_url('tracking_progress/cancelStatus');?>',
                data: { 
                    SIGNING_STEP_ID : SIGNING_STEP_ID,
                    REFERENCE_NAME : REFERENCE_NAME,
                    STATUS : STATUS,
                    START_DATE : START_DATE,
                    FINISH_DATE : FINISH_DATE,
                    REF_LIST_ID : REF_LIST_ID,
                    SIGN_DOC_TYPE : SIGN_DOC_TYPE,
                    EXTERNAL_ID : EXTERNAL_ID
                },
                timeout: 10000,
                success: function(data) {                    
                    $('#grid-signing').bootgrid('reload');
                }
            });
    }
</script>