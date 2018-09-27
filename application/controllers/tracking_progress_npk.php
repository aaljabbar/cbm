<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tracking_progress_npk extends CI_Controller
{

    private $head = "Tracking Progress";

    function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        checkAuth();
        $this->load->model('M_jqGrid', 'jqGrid');
        $this->load->model('M_tracking_progress_npk','tp');
    }


    public function index() {
        redirect("/");
    }


    public function progress_npk() {

        $result = array();
        $result['menu_id'] = $this->uri->segment(3);
        $this->load->view('tracking_progress/progress_npk', $result);
    }

    public function grid_progress_npk() {

        $page = intval($_REQUEST['page']);
        $limit = $_REQUEST['rows'];
        $sidx = $_REQUEST['sidx'];
        $sord = $_REQUEST['sord'];

        $t_customer_order_id = $this->input->post('t_customer_order_id', 0);
        // echo($t_customer_order_id);
        $table = "SELECT * FROM V_MAP_NPK";

        $req_param = array(
            "table" => $table,
            "sort_by" => $sidx,
            "sord" => $sord,
            "limit" => null,
            "field" => null,
            "where" => null,
            "where_in" => null,
            "where_not_in" => null,
            "search" => $_REQUEST['_search'],
            "search_field" => isset($_REQUEST['searchField']) ? $_REQUEST['searchField'] : null,
            "search_operator" => isset($_REQUEST['searchOper']) ? $_REQUEST['searchOper'] : null,
            "search_str" => isset($_REQUEST['searchString']) ? $_REQUEST['searchString'] : null
        );

        // Filter Table *
        $req_param['where'] = array();

        if($t_customer_order_id != 0){
            // Filter Table *
             $req_param['where'] = array('t_customer_order_id = '.$t_customer_order_id);
        }

        // $req_param['where'] = array();

        $count = $this->jqGrid->bootgrid_countAll($req_param);
        // print_r($row);exit;
        //$count = count($row);

        if ($count > 0) {
            $total_pages = ceil($count / $limit);
        } else {
            $total_pages = 0;
        }
        if ($page > $total_pages)
            $page = $total_pages;
        $start = $limit * $page - ($limit - 1); // do not put $limit*($page - 1)

        $req_param['limit'] = array(
            'start' => $start,
            'end' => $limit
        );


        if ($page == 0) {
            $result['page'] = 1;
        } else {
            $result['page'] = $page;
        }
        //$result['page'] = $page;
        $result['total'] = $total_pages;
        $result['records'] = $count;


        $result['Data'] = $this->jqGrid->bootgrid_get_data($req_param);
        echo json_encode($result);

    }

    public function crud_progress_npk() {
        $result = $this->tp->crud_progress_npk();

        echo json_encode($result);
        exit;
    }

    public function submitWF() {
        $doc_type_id = $this->input->post('DOC_TYPE'); // kontrak
        $t_customer_order_id = $this->input->post('T_CUSTOMER_ORDER_ID');
        $p_req_type_id = $this->input->post('REQ_TYPE'); //kontrak
        $p_map_npk_id = $this->input->post('P_MAP_NPK_ID');
        $username = $this->session->userdata('d_user_name');

        try {

            $sql_upd = "UPDATE P_MAP_NPK SET
                        STATUS = get_val_reflist_signer('SIGNING STEP')
                        WHERE P_MAP_NPK_ID =".$p_map_npk_id;

            $this->db->query($sql_upd);

            $sql = "  BEGIN ".
                            "  p_first_submit_engine_npk(:i_doc_type_id, :i_cust_req_id, :i_req_type_id, :i_map_npk_id, :i_username, :o_result_code, :o_result_msg ); END;";

            $stmt = oci_parse($this->tp->db->conn_id, $sql);

            //  Bind the input parameter
            oci_bind_by_name($stmt, ':i_doc_type_id', $doc_type_id);
            oci_bind_by_name($stmt, ':i_cust_req_id', $t_customer_order_id);
            oci_bind_by_name($stmt, ':i_req_type_id', $p_req_type_id);
            oci_bind_by_name($stmt, ':i_map_npk_id', $p_map_npk_id);
            oci_bind_by_name($stmt, ':i_username', $username);

            // Bind the output parameter
            oci_bind_by_name($stmt, ':o_result_code', $code, 2000000);
            oci_bind_by_name($stmt, ':o_result_msg', $msg, 2000000);

            ociexecute($stmt);

            $data['success'] = true;
            $data['error_code'] = $code;
            $data['error_message'] = $msg;

        } catch( Exception $e ) {
            $data['success'] = false;
            $data['message'] = $e->getMessage();
        }

        echo json_encode($data);
    }

    public function grid_npk_doc() {

        $page = intval($_REQUEST['page']);
        $limit = $_REQUEST['rows'];
        $sidx = $_REQUEST['sidx'];
        $sord = $_REQUEST['sord'];

        $table = "SELECT * FROM V_NPK_DOC_STATUS";

        $req_param = array(
            "table" => $table,
            "sort_by" => $sidx,
            "sord" => $sord,
            "limit" => null,
            "field" => null,
            "where" => null,
            "where_in" => null,
            "where_not_in" => null,
            "search" => $_REQUEST['_search'],
            "search_field" => isset($_REQUEST['searchField']) ? $_REQUEST['searchField'] : null,
            "search_operator" => isset($_REQUEST['searchOper']) ? $_REQUEST['searchOper'] : null,
            "search_str" => isset($_REQUEST['searchString']) ? $_REQUEST['searchString'] : null
        );

        // Filter Table *
        $req_param['where'] = array('P_MAP_NPK_ID = '.$this->input->post('p_map_npk_id'));

        $count = $this->jqGrid->bootgrid_countAll($req_param);
        // print_r($row);exit;
        //$count = count($row);

        if ($count > 0) {
            $total_pages = ceil($count / $limit);
        } else {
            $total_pages = 0;
        }
        if ($page > $total_pages)
            $page = $total_pages;
        $start = $limit * $page - ($limit - 1); // do not put $limit*($page - 1)

        $req_param['limit'] = array(
            'start' => $start,
            'end' => $limit
        );


        if ($page == 0) {
            $result['page'] = 1;
        } else {
            $result['page'] = $page;
        }
        //$result['page'] = $page;
        $result['total'] = $total_pages;
        $result['records'] = $count;


        $result['Data'] = $this->jqGrid->bootgrid_get_data($req_param);
        echo json_encode($result);

    }

     public function save_npk_doc(){
        $CREATED_BY = $this->session->userdata('d_user_name');
        $UPDATED_BY = $this->session->userdata('d_user_name');
        $p_map_npk_id = $this->input->post('p_map_npk_id');
        $desc = $this->input->post('desc');
        
        try {
        
            $config['upload_path'] = './application/third_party/doc_npk';
            $config['allowed_types'] = '*';
            $config['max_size'] = '10000000';
            $config['overwrite'] = TRUE;
            $file_id = date("YmdHis");
            $config['file_name'] = "NPK_". $file_id;

            $this->load->library('upload');
            $this->upload->initialize($config);

            if (!$this->upload->do_upload("filename")) {

                $error = $this->upload->display_errors();
                $result['success'] = false;
                $result['message'] = $error;

                echo json_encode($result);
                exit;
            }else{
                
                // Do Upload
                $data = $this->upload->data();          

                $idd = gen_id('DOC_ID', 'NPK_DOC');

                $sql = "INSERT INTO NPK_DOC(DOC_ID, 
                                            P_MAP_NPK_ID, 
                                            FILE_NAME, 
                                            PATH_FILE, 
                                            DESCRIPTION, 
                                            CREATED_DATE, 
                                            CREATE_BY, 
                                            UPDATE_DATE, 
                                            UPDATE_BY, 
                                            DOC_DATE, 
                                            DOC_TYPE_ID, 
                                            ORG_FILENAME) 
                            VALUES (".$idd.", 
                                    ".$p_map_npk_id.",
                                    '".$data['file_name']."',
                                    'application/third_party/doc_npk', 
                                    '".$desc."',  
                                    SYSDATE, 
                                    '".$CREATED_BY."',
                                    SYSDATE, 
                                    '".$UPDATED_BY."', 
                                    SYSDATE,  
                                    get_val_reflist_signer('INITIAL DOC'),
                                    '".$data['client_name']."'
                                    )";

                $this->db->query($sql);
                

                $result['success'] = true;
                $result['message'] = 'Dokumen Pendukung Berhasil Ditambah';

            }

        }catch(Exception $e) {
            $result['success'] = false;
            $result['message'] = $e->getMessage();
        }

        echo json_encode($result);


    }

    public function delete_npk_doc(){
        try {

            $id_ = $this->input->post('id');
            $this->db->where('DOC_ID', $id_);
            $this->db->delete('NPK_DOC');

            $result['success'] = true;
            $result['message'] = 'Dokumen Pendukung Berhasil Dihapus';

        } catch (Exception $e) {
            $result['success'] = false;
            $result['message'] = $e->getMessage();
        }

        echo json_encode($result);

    }

    public function getDetailNPK(){
        $page = intval($this->input->post('current')) ;
        $limit = $this->input->post('rowCount');
        $sort = $this->input->post('sort');
        $dir = $this->input->post('dir');

        $result = array();
        $sql = $this->db->query("SELECT * FROM v_npk_doc WHERE T_CUSTOMER_ORDER_ID = ".$this->input->post('t_customer_order_id')." AND DOC_TYPE_STATUS like '%".$this->input->post('status')."%' ");
        if($sql->num_rows() > 0)
            $result = $sql->result();
        

        if ($page == 0) {
            $hasil['current'] = 1;
        } else {
            $hasil['current'] = $page;
        }

        $hasil['total'] = count($result);
        $hasil['rowCount'] = $limit;
        $hasil['success'] = true;
        $hasil['message'] = 'Berhasil';
        $hasil['rows'] = $result;

        echo(json_encode($hasil));
        exit;
    }

    function download()
    {
        $path = $this->input->get('location',''); //getVarClean('location', 'str', '');
        // $path_v2 = 'application/third_party/doc_npk/NPK_20180927124220.docx';
        
        $name = $this->input->get('file_name',''); //getVarClean('file_name', 'str', '');

        // echo($path." ------------- FILE_NAME : ".$name);
        // echo($path);
        // echo(is_file($path));

      // make sure it's a file before doing anything!
        if(is_file($path))
        {
            // die('masuk sini');
        // required for IE
            if(ini_get('zlib.output_compression')) { ini_set('zlib.output_compression', 'Off'); }

            // get the file mime type using the file extension
            $ci = & get_instance();
            $ci->load->helper('file');

            $mime = get_mime_by_extension($path);

            // Build the headers to push out the file properly.
            header('Pragma: public');     // required
            header('Expires: 0');         // no cache
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Last-Modified: '.gmdate ('D, d M Y H:i:s', filemtime ($path)).' GMT');
            header('Cache-Control: private',false);
            header('Content-Type: '.$mime);  // Add the mime type from Code igniter.
            header('Content-Disposition: attachment; filename="'.basename($name).'"');  // Add the file name
            header('Content-Transfer-Encoding: binary');
            header('Content-Length: '.filesize($path)); // provide file size
            header('Connection: close');
            readfile($path); // push it out
            exit();
        }else{
            // die('  masuk else');
        }
    }

    public function update_ver_telkom() {
        $p_map_npk_id = $this->input->post('p_map_npk_id', 0);

        if($p_map_npk_id > 0){
            $sql = "UPDATE p_map_npk SET
                    VER_DATE_TLK = sysdate
                    WHERE P_MAP_NPK_ID = ".$p_map_npk_id;

            $this->jqGrid->db->query($sql);

            $data['success'] = true;
            $data['msg'] = 'Data berhasil diverifikasi';
        }else{
            $data['success'] = true;
            $data['msg'] = 'Data gagal diverifikasi';
        }

        echo json_encode($data);
        exit;
    }

    public function update_ver_mitra() {
        $p_map_npk_id = $this->input->post('p_map_npk_id', 0);

        if($p_map_npk_id > 0){
            $sql = "UPDATE p_map_npk SET
                    VER_DATE_MITRA = sysdate
                    WHERE P_MAP_NPK_ID = ".$p_map_npk_id;

            $this->jqGrid->db->query($sql);

            $data['success'] = true;
            $data['msg'] = 'Data berhasil diverifikasi';
        }else{
            $data['success'] = true;
            $data['msg'] = 'Data gagal diverifikasi';
        }

        echo json_encode($data);
        exit;
    }

    public function cekDetailNPK(){
        $p_map_npk_id = $this->input->post('p_map_npk_id', 0);

        if($p_map_npk_id > 0){
            $sql = "SELECT * FROM npk_doc
                    WHERE P_MAP_NPK_ID = ".$p_map_npk_id;

            $qs = $this->jqGrid->db->query($sql);

            if($qs->num_rows() > 0){
                $data['success'] = true;
                $data['message'] = 'Dokumen Pendukung ditemukan';
            }else{
                $data['success'] = false;
                $data['message'] = 'Dokumen Pendukung tidak ditemukan';
            }

            

        }else{
            $data['success'] = false;
            $data['message'] = 'Dokumen Pendukung untuk tidak ditemukan';
        }

        echo json_encode($data);
        exit;
    }

    public function getSigningNPK(){
        $page = intval($this->input->post('current')) ;
        $limit = $this->input->post('rowCount');
        $sort = $this->input->post('sort');
        $dir = $this->input->post('dir');

        $result = array();
        $sql = $this->db->query("SELECT *
                                  FROM VW_NPK_SIGNING_STEP                
                                 WHERE SIGN_DOC_TYPE = get_val_reflist_signer('SIGNING NPK')
                                 AND EXTERNAL_ID = ".$this->input->post('p_map_npk_id')." "); //DOC_TYPE_ID npk
        if($sql->num_rows() > 0)
            $result = $sql->result();
        

        if ($page == 0) {
            $hasil['current'] = 1;
        } else {
            $hasil['current'] = $page;
        }

        $hasil['total'] = count($result);
        $hasil['rowCount'] = $limit;
        $hasil['success'] = true;
        $hasil['message'] = 'Berhasil';
        $hasil['rows'] = $result;

        echo(json_encode($hasil));
        exit;
    }

    public function cekStatus(){
        $p_map_npk_id = $this->input->post('p_map_npk_id', 0);

        if($p_map_npk_id > 0){

            $sql_ck = "SELECT 1
                      FROM SIGNING_STEP
                     WHERE SIGN_DOC_TYPE = get_val_reflist_signer('SIGNING NPK')
                     AND EXTERNAL_ID = ".$p_map_npk_id;

            $qs1 = $this->jqGrid->db->query($sql_ck);

            if($qs1->num_rows() > 0){
                $sql = "SELECT 1
                          FROM SIGNING_STEP
                         WHERE SIGN_DOC_TYPE = get_val_reflist_signer('SIGNING NPK')
                         AND EXTERNAL_ID = ".$p_map_npk_id."
                         AND STATUS <> 'CLOSE'";
                     

                $qs = $this->jqGrid->db->query($sql);

                if($qs->num_rows() == 0){
                    $data['success'] = true;
                    $data['message'] = '';
                }else{
                    $data['success'] = false;
                    $data['message'] = 'Maaf Anda tidak bisa melakukan submit <br> Status Signing Step belum selesai';
                }
                
            }else{
                $data['success'] = false;
                $data['message'] = 'Maaf Anda tidak bisa melakukan submit <br> Anda belum melakukan generate';
            }

            

            

        }else{
            $data['success'] = false;
            $data['message'] = 'Maaf Anda tidak bisa melakukan submit <br> Status Signing Step belum selesai';
        }

        echo json_encode($data);
        exit;
    }

    public function update_signing(){
        $FINISH_DATE = $this->input->post('FINISH_DATE');
        $START_DATE = $this->input->post('START_DATE');
        $SIGNING_STEP_ID = $this->input->post('SIGNING_STEP_ID');
        $DUE_DATE_NUM = $this->input->post('DUE_DATE_NUM');
        if(empty($FINISH_DATE)){
            $val_finish_date = "null";
        }else{
            $val_finish_date = "to_date('".$FINISH_DATE."','DD/MM/YYYY HH24:MI:SS')";
        }

        if(empty($START_DATE)){
            $val_start_date = "null";
        }else{
            $val_start_date = "to_date('".$START_DATE."','DD/MM/YYYY HH24:MI:SS')";
        }

        try {
        
            $sql = "UPDATE SIGNING_STEP SET
                    START_DATE = ".$val_start_date.",
                    FINISH_DATE = ".$val_finish_date.",
                    DUE_DATE_NUM = ".$DUE_DATE_NUM."
                    WHERE SIGNING_STEP_ID = ".$SIGNING_STEP_ID;

            $this->db->query($sql);

            if(!empty($FINISH_DATE)){
                $type = 1; //next
                $doc_type = (integer)$this->input->post('SIGN_DOC_TYPE');
                $external_id = (integer)$this->input->post('EXTERNAL_ID');
                $ref_list_id = (integer)$this->input->post('REF_LIST_ID');

                // echo $doc_type." - ".$external_id." - ".$ref_list_id;

                $sqlfin = "BEGIN "
                        . " prc_update_status_sign_npk("
                        . " :i_doc_type, "
                        . " :i_external_id,"
                        . " :i_ref_list_id,"
                        . " :i_type"
                        . "); END;";


                $stmt = oci_parse($this->db->conn_id, $sqlfin);

                //  Bind the input parameter
                oci_bind_by_name($stmt, ':i_doc_type', $doc_type);
                oci_bind_by_name($stmt, ':i_external_id', $external_id);
                oci_bind_by_name($stmt, ':i_ref_list_id', $ref_list_id);
                oci_bind_by_name($stmt, ':i_type', $type);



                ociexecute($stmt);
            }

            $result['success'] = true;
            $result['message'] = "Data Berhasil Diupdate";

        } catch (Exception $e) {
            $result['success'] = false;
            $result['message'] = $e->getMessage();
        }

        echo json_encode($result);
    }

    function cancelStatus(){
        $FINISH_DATE = $this->input->post('FINISH_DATE');
        try {
        
            if(!empty($FINISH_DATE)){
                $type = 2; //cancel
                $doc_type = (integer)$this->input->post('SIGN_DOC_TYPE');
                $external_id = (integer)$this->input->post('EXTERNAL_ID');
                $ref_list_id = (integer)$this->input->post('REF_LIST_ID');

                // echo $doc_type." - ".$external_id." - ".$ref_list_id;

                $sqlfin = "BEGIN "
                        . " prc_update_status_sign_npk("
                        . " :i_doc_type, "
                        . " :i_external_id,"
                        . " :i_ref_list_id,"
                        . " :i_type"
                        . "); END;";


                $stmt = oci_parse($this->db->conn_id, $sqlfin);

                //  Bind the input parameter
                oci_bind_by_name($stmt, ':i_doc_type', $doc_type);
                oci_bind_by_name($stmt, ':i_external_id', $external_id);
                oci_bind_by_name($stmt, ':i_ref_list_id', $ref_list_id);
                oci_bind_by_name($stmt, ':i_type', $type);



                ociexecute($stmt);
            }

            $result['success'] = true;
            $result['message'] = "Data Berhasil Dicancel";

        } catch (Exception $e) {
            $result['success'] = false;
            $result['message'] = $e->getMessage();
        }

        echo json_encode($result);
    }

    public function save_npk_doc_final(){
        $CREATED_BY = $this->session->userdata('d_user_name');
        $UPDATED_BY = $this->session->userdata('d_user_name');
        $p_map_npk_id = $this->input->post('idd');
        $desc = $this->input->post('desc');
        
        try {
        
            $config['upload_path'] = './application/third_party/doc_npk';
            $config['allowed_types'] = '*';
            $config['max_size'] = '10000000';
            $config['overwrite'] = TRUE;
            $file_id = date("YmdHis");
            $config['file_name'] = "NPK_FINAL_" .$p_map_npk_id.'_'. $file_id;

            $this->load->library('upload');
            $this->upload->initialize($config);

            if (!$this->upload->do_upload("filename")) {

                $error = $this->upload->display_errors();
                $result['success'] = false;
                $result['message'] = $error;

                echo json_encode($result);
                exit;
            }else{
                
                // Do Upload
                $data = $this->upload->data();          

                $idd = gen_id('DOC_ID', 'NPK_DOC');

                $sql = "INSERT INTO NPK_DOC(DOC_ID, 
                                            P_MAP_NPK_ID, 
                                            FILE_NAME, 
                                            PATH_FILE, 
                                            DESCRIPTION, 
                                            CREATED_DATE, 
                                            CREATE_BY, 
                                            UPDATE_DATE, 
                                            UPDATE_BY, 
                                            DOC_DATE, 
                                            DOC_TYPE_ID, 
                                            ORG_FILENAME) 
                            VALUES (".$idd.", 
                                    ".$p_map_npk_id.",
                                    '".$data['file_name']."',
                                    'application/third_party/doc_npk', 
                                    '".$desc."',  
                                    SYSDATE, 
                                    '".$CREATED_BY."',
                                    SYSDATE, 
                                    '".$UPDATED_BY."', 
                                    SYSDATE,  
                                    get_val_reflist_signer('FINISHING DOC'),
                                    '".$data['client_name']."'
                                    )";

                $this->db->query($sql);
                

                $result['success'] = true;
                $result['message'] = 'Dokumen Pendukung Berhasil Ditambah';

            }

        }catch(Exception $e) {
            $result['success'] = false;
            $result['message'] = $e->getMessage();
        }

        echo json_encode($result);


    }

    public function update_no_npk() {
        $p_map_npk_id = $this->input->post('p_map_npk_id', 0);
        $doc_no = $this->input->post('doc_no');

        if($p_map_npk_id > 0){
            $sql = "UPDATE p_map_npk SET
                    DOC_NO = '".$doc_no."'
                    WHERE P_MAP_NPK_ID = ".$p_map_npk_id;

            $this->jqGrid->db->query($sql);

            $data['success'] = true;
            $data['msg'] = 'Data berhasil diverifikasi';
        }else{
            $data['success'] = true;
            $data['msg'] = 'Data gagal diverifikasi';
        }

        echo json_encode($data);
        exit;
    }

    public function cekStatusFinish(){
        $p_map_npk_id = $this->input->post('p_map_npk_id', 0);

        $this->cekStatusLogistic();
        $this->cekStatusFinance();
        $this->cekStatusPayment();

        if($p_map_npk_id > 0){

            $sql_fin = "SELECT 1 
                        FROM NPK_DOC 
                        WHERE P_MAP_NPK_ID = ".$p_map_npk_id."
                        AND DOC_TYPE_ID = get_val_reflist_signer('FINISHING DOC')";

            $qs1 = $this->jqGrid->db->query($sql_fin);

            if($qs1->num_rows() > 0){
                $sql = "SELECT 1
                      FROM P_MAP_NPK
                     WHERE P_MAP_NPK_ID = ".$p_map_npk_id."
                     AND DOC_NO IS NOT NULL";
                     

                $qs = $this->jqGrid->db->query($sql);

                if($qs->num_rows() > 0){
                    $data['success'] = true;
                    $data['message'] = '';
                }else{
                    $data['success'] = false;
                    $data['message'] = 'Maaf Anda tidak bisa melakukan submit <br> No. NPK Belum ada';
                }
            }else{
                $data['success'] = false;
                $data['message'] = 'Maaf Anda tidak bisa melakukan submit <br> Mohon untuk upload dokumen';
            }

        }else{
            $data['success'] = false;
            $data['message'] = 'Maaf Anda tidak bisa melakukan submit <br> No. NPK Belum ada';
        }

        echo json_encode($data);
        exit;
    }

    public function listSigner(){

        $list = "";
        $result = array();

        $sql = "SELECT *
                  FROM P_REF_TYPE_SIGNER
                 WHERE doc_type_id = get_val_reflist_signer('SIGNING NPK')";

        $qs = $this->jqGrid->db->query($sql);

        if($qs->num_rows() > 0)
            $result = $qs->result();

        /*echo json_encode($result);
        exit;*/

        $option = "";
        foreach($result as $content){
            $option  .= "<option value=".$content->P_REFERENCE_TYPE_ID.">".$content->REFERENCE_NAME."</option>";
        }
        echo $option;
    }

    function generateSign(){
        try {
            $sign_step = (integer)$this->input->post('SIGNING_STEP_ID');
            $external_id = (integer)$this->input->post('P_MAP_NPK_ID');

            // echo $sign_step." - ".$external_id;

            $sqlfin = "BEGIN "
                    . " p_generate_signer_npk("
                    . " :i_sign_step, "
                    . " :i_external_id,"
                    . " :i_result"
                    . "); END;";


            $stmt = oci_parse($this->db->conn_id, $sqlfin);

            //  Bind the input parameter
            oci_bind_by_name($stmt, ':i_sign_step', $sign_step);
            oci_bind_by_name($stmt, ':i_external_id', $external_id);

            //bind output
            oci_bind_by_name($stmt, ':i_result', $msg, 2000000);



            ociexecute($stmt);

            $result['success'] = true;
            $result['message'] = $msg;

        } catch (Exception $e) {
            $result['success'] = false;
            $result['message'] = $e->getMessage();
        }

        echo json_encode($result);
    }

    public function update_logistic() {
        $p_map_npk_id = $this->input->post('p_map_npk_id', 0);
        $no_npk = $this->input->post('no_npk');
        $docno = $this->input->post('DOC_NO');
        $entry = $this->input->post('ENTRY_LOGISTIC');
        $finish = $this->input->post('FINISH_LOGISTIC');

        if(empty($entry)){
            $entry = "null";
        }else{
            $entry = "to_date('".$entry."', 'YYYY-MM-DD')";
        }

        if(empty($finish)){
            $finish = "null";
        }else{
            $finish = "to_date('".$finish."', 'YYYY-MM-DD')";
        }

        if($p_map_npk_id > 0){
            $sql = "UPDATE p_map_npk SET
                    DOC_NO = '".$docno."',
                    ENTRY_LOGISTIC = ".$entry.",
                    FINISH_LOGISTIC = ".$finish."
                    WHERE P_MAP_NPK_ID = ".$p_map_npk_id;

            $this->jqGrid->db->query($sql);

            $data['success'] = true;
            $data['msg'] = 'Data berhasil disimpan';
        }else{
            $data['success'] = true;
            $data['msg'] = 'Data gagal disimpan';
        }

        echo json_encode($data);
        exit;
    }

    public function update_finance() {
        $p_map_npk_id = $this->input->post('p_map_npk_id', 0);
        $no_npk = $this->input->post('no_npk');
        $entry = $this->input->post('ENTRY_FINANCE_DATE');
        $finish = $this->input->post('FINISH_FINANCE_DATE');

        if(empty($entry)){
            $entry = "null";
        }else{
            $entry = "to_date('".$entry."', 'YYYY-MM-DD')";
        }

        if(empty($finish)){
            $finish = "null";
        }else{
            $finish = "to_date('".$finish."', 'YYYY-MM-DD')";
        }

        if($p_map_npk_id > 0){
            $sql = "UPDATE p_map_npk SET
                    ENTRY_FINANCE_DATE = ".$entry.",
                    FINISH_FINANCE_DATE = ".$finish."
                    WHERE P_MAP_NPK_ID = ".$p_map_npk_id;

            $this->jqGrid->db->query($sql);

            $data['success'] = true;
            $data['msg'] = 'Data berhasil disimpan';
        }else{
            $data['success'] = true;
            $data['msg'] = 'Data gagal disimpan';
        }

        echo json_encode($data);
        exit;
    }

    public function update_payment() {
        $p_map_npk_id = $this->input->post('p_map_npk_id', 0);
        $no_npk = $this->input->post('no_npk');
        $entry = $this->input->post('ENTRY_PAYMENT');
        $finish = $this->input->post('FINISH_PAYMENT');

        if(empty($entry)){
            $entry = "null";
        }else{
            $entry = "to_date('".$entry."', 'YYYY-MM-DD')";
        }

        if(empty($finish)){
            $finish = "null";
        }else{
            $finish = "to_date('".$finish."', 'YYYY-MM-DD')";
        }

        if($p_map_npk_id > 0){
            $sql = "UPDATE p_map_npk SET
                    ENTRY_PAYMENT = ".$entry.",
                    FINISH_PAYMENT = ".$finish."
                    WHERE P_MAP_NPK_ID = ".$p_map_npk_id;

            $this->jqGrid->db->query($sql);

            $data['success'] = true;
            $data['msg'] = 'Data berhasil disimpan';
        }else{
            $data['success'] = true;
            $data['msg'] = 'Data gagal disimpan';
        }

        echo json_encode($data);
        exit;
    }

    public function cekStatusLogistic(){
        $p_map_npk_id = $this->input->post('p_map_npk_id', 0);

        $sql = "SELECT 1
                      FROM P_MAP_NPK
                     WHERE P_MAP_NPK_ID = ".$p_map_npk_id."
                     AND ENTRY_LOGISTIC IS NOT NULL
                     AND FINISH_LOGISTIC IS NOT NULL";
                     

        $qs = $this->jqGrid->db->query($sql);

        if($qs->num_rows() == 0){
            $data['success'] = false;
            $data['message'] = 'Maaf Data Submit atau Finish NPK Logistik belum disimpan ';

            echo json_encode($data);
            exit;
        }

        
    }

    public function cekStatusFinance(){
        $p_map_npk_id = $this->input->post('p_map_npk_id', 0);

        $sql = "SELECT 1
                      FROM P_MAP_NPK
                     WHERE P_MAP_NPK_ID = ".$p_map_npk_id."
                     AND ENTRY_FINANCE_DATE IS NOT NULL
                     AND FINISH_FINANCE_DATE IS NOT NULL";
                     

        $qs = $this->jqGrid->db->query($sql);

        if($qs->num_rows() == 0){
            $data['success'] = false;
            $data['message'] = 'Maaf Data Submit atau Finish NPK Finance belum disimpan ';

            echo json_encode($data);
            exit;
        }

        
    }

    public function cekStatusPayment(){
        $p_map_npk_id = $this->input->post('p_map_npk_id', 0);

        $sql = "SELECT 1
                      FROM P_MAP_NPK
                     WHERE P_MAP_NPK_ID = ".$p_map_npk_id."
                     AND ENTRY_PAYMENT IS NOT NULL
                     AND FINISH_PAYMENT IS NOT NULL";
                     

        $qs = $this->jqGrid->db->query($sql);

        if($qs->num_rows() == 0){
            $data['success'] = false;
            $data['message'] = 'Maaf Data Submit atau Finish NPK Payment belum disimpan ';

            echo json_encode($data);
            exit;
        }

        
    }

}
