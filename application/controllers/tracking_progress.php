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
        $doc_type_id = $this->input->post('DOC_TYPE_ID');
        $t_customer_order_id = $this->input->post('T_CUSTOMER_ORDER_ID');
        $username = $this->session->userdata('d_user_name');

        try {

            $sql = "  BEGIN ".
                            "  p_first_submit_engine(:i_doc_type_id, :i_cust_req_id, :i_username, :o_result_code, :o_result_msg ); END;";

            $stmt = oci_parse($this->workflow->db->conn_id, $sql);

            //  Bind the input parameter
            oci_bind_by_name($stmt, ':i_doc_type_id', $doc_type_id);
            oci_bind_by_name($stmt, ':i_cust_req_id', $t_customer_order_id);
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


}
