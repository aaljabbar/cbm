<link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css" />

<div id="modal_lov_signing" class="modal fade" tabindex="-1" style="overflow-y: scroll;">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">UPDATE DATA</h4>
            </div>
            <form role="form" id="form_signing" name="uploadfastel" method="post" enctype="multipart/form-data"
                  accept-charset="utf-8">
                <div class="modal-body">
                    <div class="row">
                        <div class="widget-main">
                            <input type="hidden" id="SIGNING_STEP_ID" name="SIGNING_STEP_ID" value="<?php echo $this->input->post('SIGNING_STEP_ID');?>">
                            <input type="hidden" id="REF_LIST_ID" name="REF_LIST_ID" value="<?php echo $this->input->post('REF_LIST_ID');?>">
                            <input type="hidden" id="SIGN_DOC_TYPE" name="SIGN_DOC_TYPE" value="<?php echo $this->input->post('SIGN_DOC_TYPE');?>">
                            <input type="hidden" id="EXTERNAL_ID" name="EXTERNAL_ID" value="<?php echo $this->input->post('EXTERNAL_ID');?>">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                            &nbsp;
                            <div class="form-group">
                                <div class="col-xs-3">
                                    <label>Signing Step</label>
                                </div>
                                <div class="col-xs-9">
                                    <!-- #section:custom/file-input -->
                                    <input type="text" id="REFERENCE_NAME" name="REFERENCE_NAME" readonly="" />
                                </div>
                            </div>

                            &nbsp;
                            <div class="form-group">
                                <div class="col-xs-3">
                                    <label>Status</label>
                                </div>
                                <div class="col-xs-9">
                                    <!-- #section:custom/file-input -->
                                    <input type="text" id="STATUS" name="STATUS" readonly="" />
                                </div>
                            </div>

                            &nbsp;
                            <div class="form-group">
                                <div class="col-xs-3">
                                    <label>Start Date</label>
                                </div>
                                <div class="col-xs-9">
                                    <!-- #section:custom/file-input -->
                                    <input type="text" id="START_DATE" name="START_DATE" class="required" />
                                </div>
                            </div>

                            &nbsp;
                            <div class="form-group">
                                <div class="col-xs-3">
                                    <label>Finish Date</label>
                                </div>
                                <div class="col-xs-9">
                                    <!-- #section:custom/file-input -->
                                    <input type="text" id="FINISH_DATE" name="FINISH_DATE" />
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="modal-footer">                    
                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                    <button type="button" class="btn btn-sm" data-dismiss="modal">Close</button>
                </div>
            </form>

        </div>
    </div>
</div><!-- /.end modal -->

<script>
    

    $(function() {
        /* submit */
        $("#form_signing").on('submit', (function (e) {
            e.preventDefault();   
            var data = new FormData(this);
            $.ajax({
                type: 'POST',
                dataType: "json",
                url: '<?php echo site_url('tracking_progress/update_signing');?>',
                data: data,
                timeout: 10000,
                contentType: false,       // The content type used when sending data to the server.
                cache: false,             // To unable request pages to be cached
                processData: false, 
                success: function(data) {
                    if(data.success) {
                        // $('#grid-signing').trigger("reloadGrid");
                        $('#grid-signing').bootgrid('reload');
                        
                        $('#modal_lov_signing').modal('hide');
                    }else{
                        swal("", data.message, "warning");
                    }
                   
                }
            });
            return false;
        }));
        
    });

    function modal_lov_signing_show(SIGNING_STEP_ID, REFERENCE_NAME, STATUS, START_DATE, FINISH_DATE, REF_LIST_ID, SIGN_DOC_TYPE, EXTERNAL_ID) {
        // alert(EXTERNAL_ID);
        modal_lov_signing_init(SIGNING_STEP_ID, REFERENCE_NAME, STATUS, START_DATE, FINISH_DATE, REF_LIST_ID, SIGN_DOC_TYPE, EXTERNAL_ID);
        $("#modal_lov_signing").modal({backdrop: 'static'});
    }

    function modal_lov_signing_init(SIGNING_STEP_ID, REFERENCE_NAME, STATUS, START_DATE, FINISH_DATE, REF_LIST_ID, SIGN_DOC_TYPE, EXTERNAL_ID) {

        $('#SIGNING_STEP_ID').val(SIGNING_STEP_ID);
        $('#REFERENCE_NAME').val(REFERENCE_NAME);
        $('#REF_LIST_ID').val(REF_LIST_ID);
        $('#SIGN_DOC_TYPE').val(SIGN_DOC_TYPE);
        $('#EXTERNAL_ID').val(EXTERNAL_ID);

        $('#STATUS').val(STATUS);
        if(START_DATE == 'null'){
            START_DATE = null;
        }

        if(FINISH_DATE == 'null'){
            FINISH_DATE = null;
        }
        $('#START_DATE').val(START_DATE);
        $('#FINISH_DATE').val(FINISH_DATE);

    }


    if(!ace.vars['old_ie']) $('#START_DATE').datetimepicker({
     format: 'DD/MM/YYYY hh:mm:ss',//use this option to display seconds
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

    if(!ace.vars['old_ie']) $('#FINISH_DATE').datetimepicker({
     format: 'DD/MM/YYYY hh:mm:ss',//use this option to display seconds
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

    
</script>