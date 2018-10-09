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

                            <div class="form-group">
                                <div class="col-xs-3">
                                    <label>Signing Step</label>
                                </div>
                                <div class="col-xs-9">
                                    <!-- #section:custom/file-input -->
                                    <input type="text" class="col-xs-10" id="REFERENCE_NAME" name="REFERENCE_NAME" readonly="" />
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
                                    <input type="text" id="START_DATE" name="START_DATE" style="background-color: #FBEC88;" />
                                </div>
                            </div>

                            &nbsp;
                            <div class="form-group">
                                <div class="col-xs-3">
                                    <label>Due Date</label>
                                </div>
                                <div class="col-xs-9">
                                    <!-- #section:custom/file-input -->
                                    <input type="number" onkeypress="return isNumberKey(event)" id="DUE_DATE_NUM" name="DUE_DATE_NUM" style="background-color: #FBEC88; width: 100px;" />
                                    <label>&emsp;Day</label>
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

                            &nbsp;
                            <div class="form-group">
                                <div class="col-xs-3">
                                    <label>Note</label>
                                </div>
                                <div class="col-xs-9">
                                    <!-- #section:custom/file-input -->
                                    <textarea rows="3" class="col-sm-10" id="NOTE" name="NOTE" />                                    
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
            var startDate = $('#START_DATE').val();
            var due_date_num = $('#DUE_DATE_NUM').val();

            if (startDate == "" || startDate == null) {
                swal("Informasi","Start Date Harus Diisi !","info");
                return false;
            }
            if(due_date_num == "" || due_date_num == null){
                swal("Informasi","Due Date Harus Diisi !","info");
                return false;
            };

            // alert('masuk');
            
            e.preventDefault();   
            var data = new FormData(this);

            $.ajax({
                type: 'POST',
                dataType: "json",
                url: '<?php echo site_url('tracking_progress_npk/update_signing');?>',
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

    function modal_lov_signing_show(SIGNING_STEP_ID, REFERENCE_NAME, STATUS, START_DATE, FINISH_DATE, REF_LIST_ID, SIGN_DOC_TYPE, EXTERNAL_ID, DUE_DATE_NUM, NOTE) {
        // alert(EXTERNAL_ID);
        modal_lov_signing_init(SIGNING_STEP_ID, REFERENCE_NAME, STATUS, START_DATE, FINISH_DATE, REF_LIST_ID, SIGN_DOC_TYPE, EXTERNAL_ID, DUE_DATE_NUM, NOTE);
        $("#modal_lov_signing").modal({backdrop: 'static'});
    }

    function modal_lov_signing_init(SIGNING_STEP_ID, REFERENCE_NAME, STATUS, START_DATE, FINISH_DATE, REF_LIST_ID, SIGN_DOC_TYPE, EXTERNAL_ID, DUE_DATE_NUM, NOTE) {

        $('#SIGNING_STEP_ID').val(SIGNING_STEP_ID);
        $('#REFERENCE_NAME').val(REFERENCE_NAME);
        $('#REF_LIST_ID').val(REF_LIST_ID);
        $('#SIGN_DOC_TYPE').val(SIGN_DOC_TYPE);
        $('#EXTERNAL_ID').val(EXTERNAL_ID);
        

        $('#STATUS').val(STATUS);
        if(NOTE == 'null'){
            NOTE = null;
        }
        if(START_DATE == 'null'){
            START_DATE = null;
        }

        if(FINISH_DATE == 'null'){
            FINISH_DATE = null;
        }

        $('#NOTE').val(NOTE);
        $('#START_DATE').val(START_DATE);
        $('#FINISH_DATE').val(FINISH_DATE);
        $('#DUE_DATE_NUM').val(DUE_DATE_NUM);

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
    })/*.next().on(ace.change_event, function(){
        $('#FINISH_DATE').val('');
        alert('masuk');
    })*/;/*

    $('#START_DATE').on('change'){
        //$('#FINISH_DATE').val('');
        alert('masuk');
    };*/

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
     },
    }).next().on(ace.click_event, function(){
        $(this).prev().focus();
    });

    jQuery("#START_DATE").on("dp.change", function (e) {
        /*console.log('change start');
        console.log(e.date);*/
        jQuery('#FINISH_DATE').data("DateTimePicker").minDate(e.date);
        jQuery('#FINISH_DATE').val('');
    });

    function isNumberKey(evt){
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }


    
</script>