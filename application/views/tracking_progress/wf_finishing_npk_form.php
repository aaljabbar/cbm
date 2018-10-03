<!-- #section:basics/content.breadcrumbs -->
<div class="breadcrumbs" id="breadcrumbs">
    <?php echo getBreadcrumb(array('Workflow Summary','Finishing Step')); ?>
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
                <h4 class="widget-title lighter"> FINISHING STEP </h4>
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
                                    <span class="title">Upload Dokumen</span>
                                </li>

                                <li data-step="3">
                                    <span class="step">3</span>
                                    <span class="title">Signing Step</span>
                                </li>

                                <li data-step="4">
                                    <span class="step">4</span>
                                    <span class="title">Logistik</span>
                                </li>

                                <li data-step="5">
                                    <span class="step">5</span>
                                    <span class="title">Finance</span>
                                </li>

                               <!--  <li data-step="6">
                                    <span class="step">6</span>
                                    <span class="title">Payment</span>
                                </li>
 -->
                            </ul>

                        </div>

                        <hr />

                        <div class="step-content pos-rel">
                            <div class="step-pane active" data-step="1">
                                <form class="form-horizontal" id="sample-form">

                                    <input id="form_t_customer_order_id" name="t_customer_order_id" type="text" value="<?php echo $this->input->post('CURR_DOC_ID'); ?>" style="display:none;">
                                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                    <input type="hidden" id="p_map_npk_id" name="p_map_npk_id" />

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
                                        <label class="control-label col-sm-2" for="name">Period:</label>
                                        <div class="col-sm-10">
                                            <div class="clearfix">   
                                                <input type="text" id="period" name="period" class="col-sm-2" readonly />                                            
                                            </div>
                                        </div>
                                    </div>

                                </form>

                                <table id="grid-detail-download" class="table table-striped table-bordered table-hover">
                                    <thead>
                                      <tr>
                                            <th data-column-id="P_MAP_NPK_ID" data-visible="false">ID</th>
                                            <th data-column-id="ORG_FILENAME" data-width="200">Filename</th>
                                            <th data-column-id="DESCRIPTION">Description</th>                                             
                                            <th data-column-id="action" data-formatter="action" data-width="100" data-header-align="center" data-align="center">Download</th>                                                                                       
                                      </tr>
                                    </thead>
                                </table>
                               
                            </div>

                            <div class="step-pane" data-step="2">
                                <div class="col-sm-12">
                                    <center><h3>Final Dokumen</h3></center>
                                    <hr>
                                    <br>
                                </div>
                                <table id="grid-detail-upload" class="table table-striped table-bordered table-hover">
                                    <thead>
                                      <tr>
                                            <th data-column-id="DOC_ID" data-visible="false">DOC ID</th>
                                            <th data-column-id="P_MAP_NPK_ID" data-visible="false">ID</th>
                                            <th data-column-id="ORG_FILENAME" data-width="250">Filename</th>
                                            <th data-column-id="DESCRIPTION">Description</th>                                             
                                            <th data-column-id="action" data-formatter="action" data-width="150" data-header-align="center" data-align="center">Download</th>                                                                                       
                                      </tr>
                                    </thead>
                                </table>  

                            </div>

                            <div class="step-pane" data-step="3">
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
                                                                              
                                      </tr>
                                    </thead>
                                </table>

                            </div>

                            <div class="step-pane active" data-step="4">
                                <div class="col-sm-12">
                                    <center><h3>Entry Logistic</h3></center>
                                    <hr>
                                    <br>
                                </div>
                                <form class="form-horizontal" id="sample-form">

                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="name">No. Document:</label>
                                        <div class="col-sm-10">
                                            <div class="clearfix">
                                                <input type="text" placeholder="No. DOC" id="DOC_NO" name="DOC_NO" class="col-sm-4" style="margin-right: 10px;" readonly />
                                                <button class="btn btn-warning btn-sm" type="button" onclick="showLovFinest('DOC_NO','STARTDAT','SAPPOSTDATE')">
                                                <span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="name">Start Date:</label>
                                        <div class="col-sm-10">
                                            <div class="clearfix">
                                                <input type="text" placeholder="Start Date" id="STARTDAT" name="STARTDAT" class="col-sm-2" style="margin-right: 10px;" readonly />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="name">SAP PostDate:</label>
                                        <div class="col-sm-10">
                                            <div class="clearfix">
                                                <input type="text" placeholder="SAP PostDate" id="SAPPOSTDATE" name="SAPPOSTDATE" class="col-sm-2" style="margin-right: 10px;" readonly />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="name">Submit NPK Logistik:</label>
                                        <div class="col-sm-10">
                                            <div class="clearfix">
                                                <input type="text" id="ENTRY_LOGISTIC" name="ENTRY_LOGISTIC" class="col-sm-2" />
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="name">Finish NPK Logistik:</label>
                                        <div class="col-sm-10">
                                            <div class="clearfix">   
                                                <input type="text" id="FINISH_LOGISTIC" name="FINISH_LOGISTIC" class="col-sm-2" />                                            
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="name"></label>
                                        <div class="col-sm-10">
                                            <div class="clearfix">   
                                                <button class="btn btn-success" type="button" id="btn-logistic"> Submit </button>                                            
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>

                            <div class="step-pane active" data-step="5">
                                <div class="col-sm-12">
                                    <center><h3>Entry Finance</h3></center>
                                    <hr>
                                    <br>
                                </div>
                                <form class="form-horizontal" id="sample-form">

                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="name">Submit NPK Finance:</label>
                                        <div class="col-sm-10">
                                            <div class="clearfix">
                                                <input type="text" id="ENTRY_FINANCE_DATE" name="ENTRY_FINANCE_DATE" class="col-sm-2" />
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="name">Finish NPK Finance:</label>
                                        <div class="col-sm-10">
                                            <div class="clearfix">   
                                                <input type="text" id="FINISH_FINANCE_DATE" name="FINISH_FINANCE_DATE" class="col-sm-2" />                                            
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="name"></label>
                                        <div class="col-sm-10">
                                            <div class="clearfix">   
                                                <button class="btn btn-success" type="button" id="btn-finance"> Submit </button>                                            
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>

                            <!-- <div class="step-pane active" data-step="6">
                                <div class="col-sm-12">
                                    <center><h3>Entry Payment</h3></center>
                                    <hr>
                                    <br>
                                </div>
                                <form class="form-horizontal" id="sample-form">

                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="name">Submit NPK Payment:</label>
                                        <div class="col-sm-10">
                                            <div class="clearfix">
                                                <input type="text" id="ENTRY_PAYMENT" name="ENTRY_PAYMENT" class="col-sm-2" />
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="name">Finish NPK Payment:</label>
                                        <div class="col-sm-10">
                                            <div class="clearfix">   
                                                <input type="text" id="FINISH_PAYMENT" name="FINISH_PAYMENT" class="col-sm-2" />                                            
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="name"></label>
                                        <div class="col-sm-10">
                                            <div class="clearfix">   
                                                <button class="btn btn-success" type="button" id="btn-payment"> Submit </button>                                            
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div> -->
                            

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
    $this->load->view('tracking_progress/lov_doc_finest.php'); 
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

        $('#fuelux-wizard-container').ace_wizard()
        .on('actionclicked.fu.wizard' , function(e, info){
                // console.log(e);
                    if(info.step == 4 && info.direction == "next") {
                        if($('#DOC_NO').val() == ''){
                            swal({html: true, title: "Informasi", text: "No. Document  Belum diisi", type: "info"});
                            return false;
                        }

                        if($('#STARTDAT').val() == ''){
                            swal({html: true, title: "Informasi", text: "Start Date  Belum diisi", type: "info"});
                            return false;
                        }

                        if($('#SAPPOSTDATE').val() == ''){
                            swal({html: true, title: "Informasi", text: "SAP PostDate  Belum diisi", type: "info"});
                            return false;
                        }

                        if($('#ENTRY_LOGISTIC').val() == ''){
                            swal({html: true, title: "Informasi", text: "Submit NPK Logistik Belum diisi", type: "info"});
                            return false;
                        }

                        if($('#FINISH_LOGISTIC').val() == ''){
                            swal({html: true, title: "Informasi", text: "Finish NPK Logistik  Belum diisi", type: "info"});
                            return false;
                        }

                        // cekLogistic();
                    }

                    if(info.step == 5 && info.direction == "next") {
                        if($('#ENTRY_FINANCE_DATE').val() == ''){
                            swal({html: true, title: "Informasi", text: "Submit NPK Finance Belum diisi", type: "info"});
                            return false;
                        }

                        if($('#FINISH_FINANCE_DATE').val() == ''){
                            swal({html: true, title: "Informasi", text: "Finish NPK Finance Belum diisi", type: "info"});
                            return false;
                        }

                        // cekFinance();
                    }

                })
        .on('finished.fu.wizard', function(e) {

            // if($('#ENTRY_PAYMENT').val() == ''){
            //     swal({html: true, title: "Informasi", text: "Submit NPK Payment Belum diisi", type: "info"});
            //     return false;
            // }

            // if($('#FINISH_PAYMENT').val() == ''){
            //     swal({html: true, title: "Informasi", text: "Finish NPK Payment Belum diisi", type: "info"});
            //     return false;
            // }

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

            cekStatus($('#p_map_npk_id').val(), params_submit, params_back_summary);

            
            // if (  $('#ACTION_STATUS').val() != 'VIEW' ) {
            //      modal_lov_submitter_show(params_submit, params_back_summary); 
            // } else {
            //     loadContentWithParams( $('#TEMP_FSUMMARY').val() , params_back_summary );                
            // }

            
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
            $('#btn-logistic').hide();
            $('#btn-finance').hide();
            // $('#btn-payment').hide();
        }

        /* mengisi form customer order */
        $.ajax({
            type: 'POST',
            datatype: "json",
            url: '<?php echo site_url('tracking_progress_npk/grid_progress_npk');?>',
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
                $("#p_map_npk_id").val( items.P_MAP_NPK_ID );
                $("#alamat_mitra").val( items.PGL_ADDR );
                $("#period").val( items.PERIOD );
                $("#ENTRY_LOGISTIC").val( items.ENTRY_LOGISTIC );
                $("#ENTRY_FINANCE_DATE").val( items.ENTRY_FINANCE_DATE );
                // $("#ENTRY_PAYMENT").val( items.ENTRY_PAYMENT );

                $("#FINISH_LOGISTIC").val( items.FINISH_LOGISTIC );
                $("#FINISH_FINANCE_DATE").val( items.FINISH_FINANCE_DATE );
                // $("#FINISH_PAYMENT").val( items.FINISH_PAYMENT );
                $("#DOC_NO").val( items.DOC_NO );
                $('#STARTDAT').val( items.STARTDAT );
                $('#SAPPOSTDATE').val( items.SAPPOSTDATE );

                loadgrid(items.P_MAP_NPK_ID);
            }
        });


        function loadgrid(p_map_npk_id){
            $("#grid-signing").bootgrid({
                ajax: true,
                post: function ()
                {
                    return {
                        "p_map_npk_id": p_map_npk_id
                    };
                },
                url: "<?php echo site_url('tracking_progress_npk/getSigningNPK');?>",
                navigation:0,
                formatters: {}
            });
        }
        
    });

    $("#grid-detail-download").bootgrid({
        ajax: true,
        post: function ()
        {
            return {
                "t_customer_order_id": $("#CURR_DOC_ID").val(),
                "status" : 'INITIAL DOC'
            };
        },
        url: "<?php echo site_url('tracking_progress_npk/getDetailNPK');?>",
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

        var url = "<?php echo base_url();?>tracking_progress_npk/download?";
        url += "location=" + location;
        url += "&file_name=" + file_name;
        url += "&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>";
        window.location = url;
        // window.location = url;
    }

    $("#grid-detail-upload").bootgrid({
        ajax: true,
        post: function ()
        {
            return {
                "t_customer_order_id": $("#CURR_DOC_ID").val(),
                "status" : 'FINISHING DOC'
            };
        },
        url: "<?php echo site_url('tracking_progress_npk/getDetailNPK');?>",
        navigation:0,
        formatters: {
            "action": function(column, row)
            {
                var location = "./"+row.PATH_FILE+"/"+row.FILE_NAME;
                var file_name = row.FILE_NAME;
                // var ids = row.P_MAP_NPK_ID;
                var ids = row.DOC_ID;
                return '<button type="button" class="btn btn-xs btn-primary" onclick="downloadDoc(\''+location+'\',\''+file_name+'\')"> Download </button>';
            }

        }
    });

    // $(".datepicker").datepicker({
    //     autoclose: true,
    //     format: 'yyyy-mm-dd',
    //     orientation : 'top',
    //     todayHighlight : true
    // });

    if(!ace.vars['old_ie']) $('#FINISH_LOGISTIC').datetimepicker({
     format: 'YYYY-MM-DD',//use this option to display seconds
     icons: {
        time: 'fa fa-clock-o',
        date: 'fa fa-calendar',
        up: 'fa fa-chevron-up',
        down: 'fa fa-chevron-down',
        previous: 'fa fa-chevron-left',
        next: 'fa fa-chevron-right',
        today: 'fa fa-arrows ',
        clear: 'fa fa-trash',
        close: 'fa fa-times'
     }
    }).next().on(ace.click_event, function(){
        $(this).prev().focus();
    });

    if(!ace.vars['old_ie']) $('#ENTRY_LOGISTIC').datetimepicker({
     format: 'YYYY-MM-DD',//use this option to display seconds
     icons: {
        time: 'fa fa-clock-o',
        date: 'fa fa-calendar',
        up: 'fa fa-chevron-up',
        down: 'fa fa-chevron-down',
        previous: 'fa fa-chevron-left',
        next: 'fa fa-chevron-right',
        today: 'fa fa-arrows ',
        clear: 'fa fa-trash',
        close: 'fa fa-times'
     }
    }).next().on(ace.click_event, function(){
        $(this).prev().focus();
    });

    jQuery("#ENTRY_LOGISTIC").on("dp.change", function (e) {
        jQuery('#FINISH_LOGISTIC').data("DateTimePicker").minDate(e.date);
        jQuery('#FINISH_LOGISTIC').val('');
    });


    if(!ace.vars['old_ie']) $('#FINISH_FINANCE_DATE').datetimepicker({
     format: 'YYYY-MM-DD',//use this option to display seconds
     icons: {
        time: 'fa fa-clock-o',
        date: 'fa fa-calendar',
        up: 'fa fa-chevron-up',
        down: 'fa fa-chevron-down',
        previous: 'fa fa-chevron-left',
        next: 'fa fa-chevron-right',
        today: 'fa fa-arrows ',
        clear: 'fa fa-trash',
        close: 'fa fa-times'
     }
    }).next().on(ace.click_event, function(){
        $(this).prev().focus();
    });

    if(!ace.vars['old_ie']) $('#ENTRY_FINANCE_DATE').datetimepicker({
     format: 'YYYY-MM-DD',//use this option to display seconds
     icons: {
        time: 'fa fa-clock-o',
        date: 'fa fa-calendar',
        up: 'fa fa-chevron-up',
        down: 'fa fa-chevron-down',
        previous: 'fa fa-chevron-left',
        next: 'fa fa-chevron-right',
        today: 'fa fa-arrows ',
        clear: 'fa fa-trash',
        close: 'fa fa-times'
     }
    }).next().on(ace.click_event, function(){
        $(this).prev().focus();
    });

    jQuery("#ENTRY_FINANCE_DATE").on("dp.change", function (e) {
        jQuery('#FINISH_FINANCE_DATE').data("DateTimePicker").minDate(e.date);
        jQuery('#FINISH_FINANCE_DATE').val('');
    });

    /*if(!ace.vars['old_ie']) $('#FINISH_PAYMENT').datetimepicker({
     format: 'YYYY-MM-DD',//use this option to display seconds
     icons: {
        time: 'fa fa-clock-o',
        date: 'fa fa-calendar',
        up: 'fa fa-chevron-up',
        down: 'fa fa-chevron-down',
        previous: 'fa fa-chevron-left',
        next: 'fa fa-chevron-right',
        today: 'fa fa-arrows ',
        clear: 'fa fa-trash',
        close: 'fa fa-times'
     }
    }).next().on(ace.click_event, function(){
        $(this).prev().focus();
    });

    if(!ace.vars['old_ie']) $('#ENTRY_PAYMENT').datetimepicker({
     format: 'YYYY-MM-DD',//use this option to display seconds
     icons: {
        time: 'fa fa-clock-o',
        date: 'fa fa-calendar',
        up: 'fa fa-chevron-up',
        down: 'fa fa-chevron-down',
        previous: 'fa fa-chevron-left',
        next: 'fa fa-chevron-right',
        today: 'fa fa-arrows ',
        clear: 'fa fa-trash',
        close: 'fa fa-times'
     }
    }).next().on(ace.click_event, function(){
        $(this).prev().focus();
    });

    jQuery("#ENTRY_PAYMENT").on("dp.change", function (e) {
        jQuery('#FINISH_PAYMENT').data("DateTimePicker").minDate(e.date);
        jQuery('#FINISH_PAYMENT').val('');
    });*/

    $('#btn-submit').on('click', function() {
        var p_map_npk_id = $('#p_map_npk_id').val();
        var doc_no = $('#DOC_NO').val();

        if(doc_no == ''){
            swal({html: true, title: "Informasi", text: "No. DOC Belum diisi", type: "info"});
            return false;
        }


        $.ajax({
            type: 'POST',
            datatype: "json",
            url: '<?php echo site_url('tracking_progress_npk/update_no_npk');?>',
            timeout: 10000,
            data: { p_map_npk_id : p_map_npk_id, doc_no : doc_no},
            success: function(data) {
                 $('#grid-detail-upload').bootgrid('reload');
            }
        });
    });


    function cekStatus(p_map_npk_id, params_submit, params_back_summary){
            $.ajax({
                type: 'POST',
                dataType: "json",
                url: '<?php echo site_url('tracking_progress_npk/cekStatusFinish');?>',
                data: { p_map_npk_id : p_map_npk_id
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

    $('#btn-logistic').on('click', function() {
        var p_map_npk_id = $('#p_map_npk_id').val();
        var docno = $('#DOC_NO').val();
        var entry = $('#ENTRY_LOGISTIC').val();
        var finish = $('#FINISH_LOGISTIC').val();
        var start = $('#STARTDAT').val();
        var sapdate = $('#SAPPOSTDATE').val();

        $.ajax({
            type: 'POST',
            dataType: "json",
            url: '<?php echo site_url('tracking_progress_npk/update_logistic');?>',
            timeout: 10000,
            data: { p_map_npk_id : p_map_npk_id, ENTRY_LOGISTIC : entry, FINISH_LOGISTIC : finish, DOC_NO: docno, STARTDAT : start, SAPPOSTDATE : sapdate},
            success: function(data) {
                 $('#grid-detail-upload').bootgrid('reload');
                 swal("Informasi",data.msg,"info");
            }
        });
    });

    $('#btn-finance').on('click', function() {
        var p_map_npk_id = $('#p_map_npk_id').val();
        var entry = $('#ENTRY_FINANCE_DATE').val();
        var finish = $('#FINISH_FINANCE_DATE').val();

        $.ajax({
            type: 'POST',
            dataType: "json",
            url: '<?php echo site_url('tracking_progress_npk/update_finance');?>',
            timeout: 10000,
            data: { p_map_npk_id : p_map_npk_id, ENTRY_FINANCE_DATE : entry, FINISH_FINANCE_DATE : finish},
            success: function(data) {
                 $('#grid-detail-upload').bootgrid('reload');
                 swal("Informasi",data.msg,"info");
            }
        });
    });
/*
    $('#btn-payment').on('click', function() {
        var p_map_npk_id = $('#p_map_npk_id').val();
        var entry = $('#ENTRY_PAYMENT').val();
        var finish = $('#FINISH_PAYMENT').val();

        $.ajax({
            type: 'POST',
            dataType: "json",
            url: '<?php echo site_url('tracking_progress_npk/update_payment');?>',
            timeout: 10000,
            data: { p_map_npk_id : p_map_npk_id, ENTRY_PAYMENT : entry, FINISH_PAYMENT : finish},
            success: function(data) {
                 $('#grid-detail-upload').bootgrid('reload');
                 swal("Informasi",data.msg,"info");
            }
        });
    }); */

    function cekLogistic(){
        $.ajax({
                type: 'POST',
                dataType: "json",
                url: '<?php echo site_url('tracking_progress_npk/cekStatusLogistic');?>',
                data: { p_map_npk_id : $('#p_map_npk_id').val()
                },
                timeout: 10000,
                success: function(data) {
                    if (!data.success) {

                        swal({html: true, title: "Informasi", text: data.message, type: "info"});
                        return false;
                    }
                }
            });
    }

    function cekFinance(){
        $.ajax({
                type: 'POST',
                dataType: "json",
                url: '<?php echo site_url('tracking_progress_npk/cekStatusFinance');?>',
                data: { p_map_npk_id : $('#p_map_npk_id').val()
                },
                timeout: 10000,
                success: function(data) {
                    if (!data.success) {

                        swal({html: true, title: "Informasi", text: data.message, type: "info"});
                        return false;
                    }
                }
            });
    }

    function cekPayment(){
        $.ajax({
                type: 'POST',
                dataType: "json",
                url: '<?php echo site_url('tracking_progress_npk/cekStatusPayment');?>',
                data: { p_map_npk_id : $('#p_map_npk_id').val()
                },
                timeout: 10000,
                success: function(data) {
                    if (!data.success) {

                        swal({html: true, title: "Informasi", text: data.message, type: "info"});
                        return false;
                    }
                }
            });
    }

    function showLovFinest(docno, startdate, postdate){
        modal_lov_doc_finest_show(docno, startdate, postdate);
    }
</script>