<div id="modal_lov_doc_finest" class="modal fade" tabindex="-1" style="overflow-y: scroll;">
	<div class="modal-dialog" style="width:900px;">
		<div class="modal-content">
		    <!-- modal title -->
			<div class="modal-header no-padding">
				<div class="table-header">
					<span class="form-add-edit-title"> Data Dokumen Finest </span>
				</div>
			</div>
            <input type="hidden" id="modal_lov_doc_finest_doc_no" value="" />
            <input type="hidden" id="modal_lov_doc_finest_sapdoc_no" value="" />
            <input type="hidden" id="modal_lov_doc_finest_start_date" value="" />
            <input type="hidden" id="modal_lov_doc_finest_post_date" value="" />

			<!-- modal body -->
			<div class="modal-body">
			    <p>
                  <button type="button" class="btn btn-sm btn-success" id="modal_lov_doc_finest_btn_blank">
  	                <span class="fa fa-pencil-square-o" aria-hidden="true"></span> BLANK
                  </button>
                 </p>

				<table id="modal_lov_doc_finest_grid_selection" class="table table-striped table-bordered table-hover">
                <thead>
                  <tr>
                     <th data-header-align="center" data-align="center" data-formatter="opt-edit" data-sortable="false" data-width="100">Options</th>
                     <th data-column-id="DOCID">DOC ID</th>
                     <th data-column-id="SAPNODOC">SAP DOC</th>
                     <th data-column-id="DATESTART">START DATE</th>
                     <th data-column-id="SAPPOSTDATE">SAP POSTDATE</th>
                     <th data-column-id="AMOUNT" data-align="right">AMOUNT</th>
                  </tr>
                </thead>
                </table>
			</div>

			<!-- modal footer -->
			<div class="modal-footer no-margin-top">
			    <div class="bootstrap-dialog-footer">
			        <div class="bootstrap-dialog-footer-buttons">
        				<button class="btn btn-danger btn-xs radius-4" data-dismiss="modal">
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

    jQuery(function($) {
        $("#modal_lov_doc_finest_btn_blank").on(ace.click_event, function() {
            $("#"+ $("#modal_lov_doc_finest_doc_no").val()).val("");
            $("#"+ $("#modal_lov_doc_finest_sapdoc_no").val()).val("");
            $("#"+ $("#modal_lov_doc_finest_start_date").val()).val("");
            $("#"+ $("#modal_lov_doc_finest_post_date").val()).val("");
            $("#modal_lov_doc_finest").modal("toggle");
        });
    });

    function modal_lov_doc_finest_show(the_doc_no_field, the_sapdoc_no_field, the_start_date_field, the_post_date_field) {
        modal_lov_doc_finest_set_field_value(the_doc_no_field, the_sapdoc_no_field, the_start_date_field, the_post_date_field);
        $("#modal_lov_doc_finest").modal({backdrop: 'static'});
        modal_lov_doc_finest_prepare_table();
    }


    function modal_lov_doc_finest_set_field_value(the_doc_no_field, the_sapdoc_no_field, the_start_date_field, the_post_date_field) {
         $("#modal_lov_doc_finest_doc_no").val(the_doc_no_field);
         $("#modal_lov_doc_finest_sapdoc_no").val(the_sapdoc_no_field);
         $("#modal_lov_doc_finest_start_date").val(the_start_date_field);
         $("#modal_lov_doc_finest_post_date").val(the_post_date_field);
    }

    function modal_lov_doc_finest_set_value(the_doc_no, the_sapdoc_no, the_start_date, the_post_date) {
         $("#"+ $("#modal_lov_doc_finest_doc_no").val()).val(the_doc_no);
         $("#"+ $("#modal_lov_doc_finest_sapdoc_no").val()).val(the_sapdoc_no);
         $("#"+ $("#modal_lov_doc_finest_start_date").val()).val(the_start_date);
         $("#"+ $("#modal_lov_doc_finest_post_date").val()).val(the_post_date);
         $("#modal_lov_doc_finest").modal("toggle");
         
         $("#"+ $("#modal_lov_doc_finest_doc_no").val()).change();
         $("#"+ $("#modal_lov_doc_finest_sapdoc_no").val()).change();
         $("#"+ $("#modal_lov_doc_finest_start_date").val()).change();
         $("#"+ $("#modal_lov_doc_finest_post_date").val()).change();
    }

    function modal_lov_doc_finest_prepare_table() {
      $("#modal_lov_doc_finest_grid_selection").bootgrid("destroy");
        $("#modal_lov_doc_finest_grid_selection").bootgrid({
    	     formatters: {
                "opt-edit" : function(col, row) {
                    return '<a href="#'+ $("#modal_lov_doc_finest_start_date").val() +'" title="Set Value" onclick="modal_lov_doc_finest_set_value(\''+ row.DOCID +'\', \''+ row.SAPNODOC +'\', \''+ row.DATESTART +'\', \''+ row.SAPPOSTDATE +'\')" class="blue"><i class="ace-icon fa 	fa-pencil-square-o bigger-130"></i></a>';
                }
             },
    	     rowCount:[5,10],
    		 ajax: true,
    	     requestHandler:function(request) {
    	        if(request.sort) {
    	            var sortby = Object.keys(request.sort)[0];
    	            request.dir = request.sort[sortby];

    	            delete request.sort;
    	            request.sort = sortby;
    	        }
    	        return request;
    	     },
    	     responseHandler:function (response) {
    	        if(response.success == false) {
    	            showBootDialog(true, BootstrapDialog.TYPE_WARNING, 'Attention', response.message);
    	        }
    	        return response;
    	     },
       	     url: "<?php echo site_url('tracking_progress_npk/gridLovFinest');?>",
    	     selection: true,
    	     sorting:true
    	});
    }

</script>