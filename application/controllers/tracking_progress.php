<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tracking_progress extends CI_Controller
{

    private $head = "Tracking Progress";

    function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        checkAuth();
        $this->load->model('M_jqGrid', 'jqGrid');
        $this->load->model('M_tracking_progress','tp');
    }


    public function index() {
        redirect("/");
    }


    public function progress_pks() {

        $result = array();
        $result['menu_id'] = $this->uri->segment(3);
        $this->load->view('tracking_progress/progress_pks', $result);
    }

    public function grid_progress_pks() {

        $page = intval($_REQUEST['page']);
        $limit = $_REQUEST['rows'];
        $sidx = $_REQUEST['sidx'];
        $sord = $_REQUEST['sord'];

        $t_customer_order_id = $this->input->post('t_customer_order_id', 0);
        // echo($t_customer_order_id);
        $table = "SELECT * FROM V_MAP_PKS";

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

    public function crud_progress_pks() {
        $result = $this->tp->crud_progress_pks();

        echo json_encode($result);
        exit;
    }

    public function submitWF() {
        $doc_type_id = $this->input->post('DOC_TYPE'); // kontrak
        $t_customer_order_id = $this->input->post('T_CUSTOMER_ORDER_ID');
        $p_req_type_id = $this->input->post('REQ_TYPE'); //kontrak
        $p_map_pks_id = $this->input->post('P_MAP_PKS_ID');
        $username = $this->session->userdata('d_user_name');

        try {

            $sql = "  BEGIN ".
                            "  p_first_submit_engine(:i_doc_type_id, :i_cust_req_id, :i_req_type_id, :i_map_pks_id, :i_username, :o_result_code, :o_result_msg ); END;";

            $stmt = oci_parse($this->tp->db->conn_id, $sql);

            //  Bind the input parameter
            oci_bind_by_name($stmt, ':i_doc_type_id', $doc_type_id);
            oci_bind_by_name($stmt, ':i_cust_req_id', $t_customer_order_id);
            oci_bind_by_name($stmt, ':i_req_type_id', $p_req_type_id);
            oci_bind_by_name($stmt, ':i_map_pks_id', $p_map_pks_id);
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

    public function grid_pks_doc() {

        $page = intval($_REQUEST['page']);
        $limit = $_REQUEST['rows'];
        $sidx = $_REQUEST['sidx'];
        $sord = $_REQUEST['sord'];

        $table = "SELECT * FROM PKS_DOC";

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
        $req_param['where'] = array('P_MAP_PKS_ID = '.$this->input->post('p_map_pks_id'));

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

    public function save_pks_doc(){
        $CREATED_BY = $this->session->userdata('d_user_name');
        $UPDATED_BY = $this->session->userdata('d_user_name');
        $p_map_pks_id = $this->input->post('p_map_pks_id');
        $desc = $this->input->post('desc');
        
        try {
        
            $config['upload_path'] = './application/third_party/doc_pks';
            $config['allowed_types'] = '*';
            $config['max_size'] = '10000000';
            $config['overwrite'] = TRUE;
            $file_id = date("YmdHis");
            $config['file_name'] = "PKS_" .$p_map_pks_id.'_'. $file_id;

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

                $idd = gen_id('DOC_ID', 'PKS_DOC');

                $sql = "INSERT INTO PKS_DOC(DOC_ID, 
                                            P_MAP_PKS_ID, 
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
                                    ".$p_map_pks_id.",
                                    '".$data['file_name']."',
                                    'application/third_party/doc_pks', 
                                    '".$desc."',  
                                    SYSDATE, 
                                    '".$CREATED_BY."',
                                    SYSDATE, 
                                    '".$UPDATED_BY."', 
                                    SYSDATE,  
                                    35,
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

    public function delete_pks_doc(){
        try {

            $id_ = $this->input->post('id');
            $this->db->where('DOC_ID', $id_);
            $this->db->delete('PKS_DOC');

            $result['success'] = true;
            $result['message'] = 'Dokumen Pendukung Berhasil Dihapus';

        } catch (Exception $e) {
            $result['success'] = false;
            $result['message'] = $e->getMessage();
        }

        echo json_encode($result);

    }

    public function getDetailPKS(){
        $page = intval($this->input->post('current')) ;
        $limit = $this->input->post('rowCount');
        $sort = $this->input->post('sort');
        $dir = $this->input->post('dir');

        $result = array();
        $sql = $this->db->query("SELECT * FROM v_pks_doc WHERE T_CUSTOMER_ORDER_ID = ".$this->input->post('t_customer_order_id')." ");
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
        
        $name = $this->input->get('file_name',''); //getVarClean('file_name', 'str', '');

      // make sure it's a file before doing anything!
        if(is_file($path))
        {
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
        }   
    }

    public function update_ver_telkom() {
        $p_map_pks_id = $this->input->post('p_map_pks_id', 0);

        if($p_map_pks_id > 0){
            $sql = "UPDATE p_map_pks SET
                    VER_DATE_TLK = sysdate
                    WHERE P_MAP_PKS_ID = ".$p_map_pks_id;

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
        $p_map_pks_id = $this->input->post('p_map_pks_id', 0);

        if($p_map_pks_id > 0){
            $sql = "UPDATE p_map_pks SET
                    VER_DATE_MITRA = sysdate
                    WHERE P_MAP_PKS_ID = ".$p_map_pks_id;

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

    public function cekDetailPKS(){
        $p_map_pks_id = $this->input->post('p_map_pks_id', 0);

        if($p_map_pks_id > 0){
            $sql = "SELECT * FROM pks_doc
                    WHERE P_MAP_PKS_ID = ".$p_map_pks_id;

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
            $data['message'] = 'Dokumen Pendukung untuk p_map_pks_id tidak ditemukan';
        }

        echo json_encode($data);
        exit;
    }

    public function getSigningPKS(){
        $page = intval($this->input->post('current')) ;
        $limit = $this->input->post('rowCount');
        $sort = $this->input->post('sort');
        $dir = $this->input->post('dir');

        $result = array();
        $sql = $this->db->query("SELECT *
                                  FROM VW_PKS_SIGNING_STEP                
                                 WHERE SIGN_DOC_TYPE = 1 AND EXTERNAL_ID = ".$this->input->post('p_map_pks_id')." ");
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
        $p_map_pks_id = $this->input->post('p_map_pks_id', 0);

        if($p_map_pks_id > 0){
            $sql = "SELECT COUNT (*)
                      FROM SIGNING_STEP
                     WHERE SIGN_DOC_TYPE = 1 
                     AND EXTERNAL_ID = ".$p_map_pks_id."
                     AND STATUS <> 'WAIT' OR STATUS <> 'OPEN'";

            $qs = $this->jqGrid->db->query($sql);

            if($qs->num_rows() == 0){
                $data['success'] = true;
                $data['message'] = '';
            }else{
                $data['success'] = false;
                $data['message'] = 'Tidak bisa submit ! Status belum Finish !';
            }

            

        }else{
            $data['success'] = false;
            $data['message'] = 'Tidak bisa submit ! p_map_pks_id tidak ditemukan';
        }

        echo json_encode($data);
        exit;
    }

}
