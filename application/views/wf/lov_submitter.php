<div id="modal_lov_submitter" class="modal fade" tabindex="-1" style="overflow-y: scroll;">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- modal title -->
            <div class="modal-header no-padding">
                <div class="table-header">
                    <span class="form-add-edit-title"> KONFIRMASI PENUTUPAN PEKERJAAN </span>
                </div>
            </div>
            
            <!-- modal body -->
            <div class="modal-body">
                <form class="form-horizontal" application="form" id="form_submitter">
                    <input type="hidden" id="form_submitter_params">
                    <input type="hidden" id="form_submitter_back_summary">
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right"> Tanggal :</label>
                        <div class="col-sm-3">
                            <input id="form_submitter_date" name="submitter_date" class="col-xs-12 blue" type="text" style="border:none;font-size:14px;font-weight:bold;padding:0px !important;">
                        </div>

                        <label class="col-sm-3 control-label no-padding-right"> Submit Oleh :</label>
                        <div class="col-sm-3">
                            <label class="control-label blue" id="form_submitter_by" style="font-weight:bold;"> <?php echo $this->session->userdata("d_user_name"); ?> </label>
                        </div>

                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right"> Pekerjaan Tersedia :</label>
                        <div class="col-sm-9">
                            <label class="control-label blue" id="form_submitter_available_job" style="font-weight:bold;"> </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right"> Status Dokumen : </label>
                        <div class="col-sm-9">
                            <select id="form_submitter_status_dok_wf" disabled></select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right"> Pesan Dikirim : </label>
                        <div class="col-sm-9">
                            <textarea id="form_submitter_interactive_message" rows="1" cols="52" placeholder="Ketikkan Pesan Anda Disini..."></textarea>
                        </div>
                    </div>

                    <hr/>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right green"> Pesan Berhasil Dikirim :</label>
                        <div class="col-sm-9">
                            <textarea id="form_submitter_success_message" class="green" readonly="readonly" rows="1" cols="52" placeholder="Generated By System"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right red"> Pesan Error :</label>
                        <div class="col-sm-9">
                            <textarea id="form_submitter_error_message" class="red" readonly="readonly" rows="1" cols="52" placeholder="Generated By System"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right orange"> Pesan Peringatan :</label>
                        <div class="col-sm-9">
                            <textarea id="form_submitter_warning_message" class="orange" readonly="readonly" rows="1" cols="52" placeholder="Generated By System"></textarea>
                        </div>
                    </div>

                </form>
            </div>

            <!-- modal footer -->
            <div class="modal-footer no-margin-top">
                <div class="bootstrap-dialog-footer">
                    <div class="bootstrap-dialog-footer-buttons col-xs-7">
                        <button class="btn btn-primary btn-xs radius-4" id="btn-submitter-submit" data-dismiss="modal">
                            <i class="ace-icon glyphicon glyphicon-upload"></i>
                            Submit
                        </button>
                        <button class="btn btn-warning btn-xs radius-4" id="btn-submitter-reject" data-dismiss="modal">
                            <i class="ace-icon fa fa-ban"></i>
                            Reject
                        </button>
                        <button class="btn btn-warning btn-xs radius-15" id="btn-submitter-back" data-dismiss="modal">
                            <i class="glyphicon glyphicon-circle-arrow-left"></i>
                            Send Back Job
                        </button>
                    </div>
                    <div class="bootstrap-dialog-footer-buttons col-xs-5">
                        <button class="btn btn-danger btn-xs radius-4" id="btn-submitter-close" data-dismiss="modal">
                            <i class="ace-icon fa fa-times"></i>
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.end modal -->

<script>
    

    $(function() {
        /* submit */
        $('#btn-submitter-submit').on('click', function() {
            result = confirm('Apakah Anda yakin menutup pekerjaan ini ?');
            if (result) { 
                var submitter_params = $('#form_submitter_params').val();
                var messages = $('#form_submitter_interactive_message').val();

                $.ajax({
                    type: 'POST',
                    datatype: "json",
                    url: '<?php echo site_url('wf/submitter_submit');?>',
                    data: { params : submitter_params , interactive_message : messages},
                    timeout: 10000,
                    success: function(data) {
                        var response = JSON.parse(data);
                        if(response.success) {

                            $('#form_submitter_success_message').val( response.return_message );
                            $('#form_submitter_error_message').val( response.error_message );
                            $('#form_submitter_warning_message').val( response.warning );

                            if( response.return_message.trim() == 'BERHASIL') {
                                modal_lov_submitter_back_summary();
                            }                            

                        }else {
                            swal("", data.message, "warning");
                        }
                    }
                });
            }
            return false;
        });

        /* reject */
        $('#btn-submitter-reject').on('click', function() {

            if( $('#form_submitter_interactive_message').val() == "" ) {
                swal("", "Ketikkan pesan Anda sebagai alasan penolakan pekerjaan", "info");  
                return false;
            }

            result = confirm('Apakah Anda yakin menolak pekerjaan ini ?');
            if (result) { 
                var submitter_params = $('#form_submitter_params').val();
                var messages = $('#form_submitter_interactive_message').val();

                $.ajax({
                    type: 'POST',
                    datatype: "json",
                    url: '<?php echo site_url('wf/submitter_reject');?>',
                    data: { params : submitter_params , interactive_message : messages},
                    timeout: 10000,
                    success: function(data) {
                        var response = JSON.parse(data);
                        if(response.success) {

                            $('#form_submitter_success_message').val( response.return_message );
                            $('#form_submitter_error_message').val( response.error_message );
                            $('#form_submitter_warning_message').val( response.warning );

                            if( response.return_message.trim() == 'BERHASIL') {
                                modal_lov_submitter_back_summary();
                            }    

                        }else {
                            swal("", data.message, "warning");
                        }
                    }
                });    
            }
            return false;
        });

        /* back */
        $('#btn-submitter-back').on('click', function() {
            if( $('#form_submitter_interactive_message').val() == "" ) {
                swal("", "Ketikkan pesan Anda sebagai alasan mengembalikan pekerjaan", "info");  
                return false;
            }

            result = confirm('Apakah Anda yakin mengembalikan pekerjaan ini ?');
            if (result) { 
                var submitter_params = $('#form_submitter_params').val();
                var messages = $('#form_submitter_interactive_message').val();

                $.ajax({
                    type: 'POST',
                    datatype: "json",
                    url: '<?php echo site_url('wf/submitter_back');?>',
                    data: { params : submitter_params , interactive_message : messages},
                    timeout: 10000,
                    success: function(data) {
                        var response = JSON.parse(data);
                        if(response.success) {

                            $('#form_submitter_success_message').val( response.return_message );
                            $('#form_submitter_error_message').val( response.error_message );
                            $('#form_submitter_warning_message').val( response.warning );

                            if( response.return_message.trim() == 'BERHASIL') {
                                modal_lov_submitter_back_summary();
                            }    

                        }else {
                            swal("", data.message, "warning");
                        }
                    }
                });
            }
            return false;
        });
    });

    function modal_lov_submitter_show(params_submit, params_back_summary) {
        modal_lov_submitter_init(params_submit, params_back_summary, modal_lov_submitter_show_up);
    }

    function modal_lov_submitter_show_up() {
        $("#modal_lov_submitter").modal({backdrop: 'static'});
    }

    function modal_lov_submitter_init(params_submit, params_back_summary, callback) {

        $('#form_submitter_params').val( JSON.stringify(params_submit) );
        $('#form_submitter_back_summary').val( JSON.stringify(params_back_summary) );
        $('#form_submitter_interactive_message').val("");
        /*init date*/
        $("#form_submitter_date").datepicker({
                                format: 'dd-mm-yyyy',
                                enabled:false,
                                beforeShowDay: function (date) {
                                    var day = date.getDay();
                                    return [(day != 0 && day != 6)];
                                }
                            });
        $("#form_submitter_date").datepicker('setDate', new Date());

        /*init pekerjaan tersedia*/
        $.ajax({
            type: 'POST',
            datatype: "json",
            url: '<?php echo site_url('wf/pekerjaan_tersedia');?>',
            data: { curr_proc_id : params_submit.CURR_PROC_ID, curr_doc_type_id: params_submit.CURR_DOC_TYPE_ID },
            timeout: 10000,
            success: function(data) {
                var response = JSON.parse(data);
                $("#form_submitter_available_job").html( response.task );
            }
        });


        /*init status dokumen wf*/
        $.ajax({
            type: 'POST',
            datatype: "json",
            url: '<?php echo site_url('wf/status_dokumen_workflow');?>',
            timeout: 10000,
            success: function(data) {
                var response = JSON.parse(data);
                $("#form_submitter_status_dok_wf").html( response.opt_status );
            }
        });

        callback();
    }

    function modal_lov_submitter_back_summary() {
        var obj_summary_params = JSON.parse( $('#form_submitter_back_summary').val() );
        var file_name = obj_summary_params.FSUMMARY;
        delete obj_summary_params.FSUMMARY;
        
        $('#btn-submitter-submit').remove();
        $('#btn-submitter-reject').remove();
        $('#btn-submitter-back').remove();
        $('#btn-submitter-close').remove();

        setTimeout(function(){
            $("#modal_lov_submitter").modal('hide'); 
            loadContentWithParams( file_name , obj_summary_params );
        },3000);
    }

    
</script>