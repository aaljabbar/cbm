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
    <?php echo getBreadcrumb(array('Tracking Progress','Cek Status Bayar')); ?>
</div>

<!-- /section:basics/content.breadcrumbs -->
<div class="page-content">
    <div class="space-4"></div>
    <div class="row">
        <div class="col-xs-12">
            <div class="form-group">
                <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> No. Document Finest : </label>

                <!-- Dropdown Bulan -->
                <div class="col-sm-7">
                    <input type="text" class="col-sm-6" placeholder="No. DOC" id="DOC_NO" name="DOC_NO" style="margin-right: 10px; margin-bottom: 5px;" readonly />

                    <input type="hidden" class="col-sm-6" placeholder="SAP DOC" id="SAP_DOC_NO" name="SAP_DOC_NO" style="margin-right: 10px; margin-bottom: 5px;" readonly />

                    <input type="text" class="col-sm-2" placeholder="Start Date" id="STARTDAT" name="STARTDAT" style="margin-right: 10px;" readonly />

                    <input type="text" placeholder="SAP PostDate" id="SAPPOSTDATE" name="SAPPOSTDATE" class="col-sm-2" style="margin-right: 10px;" readonly />

                    <button class="btn btn-warning btn-sm" type="button" onclick="showLovFinest('DOC_NO','SAP_DOC_NO','STARTDAT','SAPPOSTDATE')">
                    <span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
                    </button>
                </div>

                <!-- Button Find -->
                <div class="col-sm-1">
                    <button class="btn btn-sm btn-info" type="button" id="btn-find">
                        <span class="ace-icon fa fa-search"></span>Find
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="hr hr-double hr-dotted hr18"></div>

    <div class="row">
        <div class="col-xs-12">
            <h3 class="header smaller lighter green"> <i class="ace-icon fa fa-check"></i> CEK STATUS BAYAR </h3>
        </div>
    </div>        
    <div class="space-8"></div>
    <div class="row">
        <div class="col-xs-12">
            <form class="form-horizontal" id="sample-form">
                 <div class="form-group">
                    <label class="control-label col-sm-4" for="name">No. Document Finest:</label>
                    <div class="col-sm-7">
                        <div class="clearfix">
                            <input type="text" id="DOC_ID" name="DOC_ID" class="col-sm-5" readonly />
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-4" for="name">SAP Document :</label>
                    <div class="col-sm-7">
                        <div class="clearfix">
                            <input type="text" id="BELNR" name="BELNR" class="col-sm-5" readonly />
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-4" for="name">No. Ref:</label>
                    <div class="col-sm-7">
                        <div class="clearfix">
                            <input type="text" id="REFNO" name="REFNO" class="col-sm-5" readonly />
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-4" for="name">Payment Date:</label>
                    <div class="col-sm-7">
                        <div class="clearfix">
                            <input type="text" id="AUGDT2" name="AUGDT2" class="col-sm-5" readonly />
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-4" for="name">Status Bayar:</label>
                    <!-- <div class="col-sm-7"> -->
                        <!-- <div class="clearfix"> -->
                            <label class="control-label col-sm-5 green" id="DESC_STAT" name="DESC_STAT" style="text-align: left; font-weight: bold;"> ---------xxxxxx--------- </label>
                            <!-- <input type="text" id="DESC_STAT" name="DESC_STAT" class="col-sm-5" readonly /> -->
                        <!-- </div> -->
                    <!-- </div> -->
                </div>
            </form>
        </div>
    </div>
</div><!-- /.page-content -->

<?php 
    $this->load->view('tracking_progress/lov_doc_finest.php'); 
?>
<script type="text/javascript">
    function showLovFinest(docno, sapdocno, startdate, postdate){
        modal_lov_doc_finest_show(docno, sapdocno, startdate, postdate);
    }
</script>

<script type="text/javascript">
    $('#btn-find').on('click', function(){
        var sap_doc_no = $('#SAP_DOC_NO').val();
        var period_sappostdate = $('#SAPPOSTDATE').val();

        if(sap_doc_no == ''){
            swal({html: true, title: "Informasi", text: "No. Document Finest Belum ada", type: "info"});
            return false;
        }

        if(period_sappostdate == ''){
            swal({html: true, title: "Informasi", text: "SAP PostDate Belum ada", type: "info"});
            return false;
        }

        var sappostdate = period_sappostdate.split('-').join('');

        var urls = "<?php echo base_url().'data_saprfc/getdata?postdate='; ?>" +sappostdate+'&docno='+sap_doc_no;

        $.ajax({
            type: 'POST',
            dataType: "json",
            url: urls,
            data: {},
            success: function(data) {  
                // alert(data.success);
                // console.log(data);
                // var status_desc = data.data.DESC_STAT.toUpperCase();
                // var finish_payment = data.data.AUGDT2;     

                $('#DOC_ID').val($('#DOC_NO').val());
                $('#BELNR').val(data.data.BELNR);
                $('#REFNO').val(data.data.REFNO);
                $('#AUGDT2').val(data.data.AUGDT2);
                $('#DESC_STAT').text(data.data.DESC_STAT.toUpperCase());
            }
        });
    });
</script>