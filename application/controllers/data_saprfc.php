<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Data_saprfc extends CI_Controller
{


    function __construct()
    {
        parent::__construct();
    }


    public function getdata()
    {
        
        $postdate = $this->input->get('postdate', '');
        $docno = $this->input->get('docno', '');

        header('Content-Type: application/json');
        $items = array('success' => true, 'total'=> 0, 'message'=> '', 'data' => array());

        if($postdate == '' || $docno == ''){
            $items['success'] = false;
            $items['message'] = 'parameter postdate dan docno tidak ada';

            echo json_encode($items);
            exit;
        }

        if (!extension_loaded ("saprfc")){
               echo "SAPRFC extension not loaded";
               exit;
        }
        // print_r($postdate); exit;
        $l = array();
        $l["ASHOST"] = '10.6.1.134';
        $l["SYSNR"] = '00';
        $l["CLIENT"] = '100';
        $l["USER"] = '641459';
        $l["PASSWD"] = 'Telkom2018';
        $l["MSHOST"] = null;
        $l["R3NAME"] = null;
        $l["GROUP"] = null;
        $l["LANG"] = null;
        $l["TRACE"] = null;
        $l["LCHECK"] = '1';
        $l["CODEPAGE"] = '1100';

        // login data avaible, can open connection to SAP R/3
        $rfc = @saprfc_open ($l);

        // print_r($rfc); exit;
        if (! $rfc )                    // if login failed, show error message
        {
            $items['success'] = true;
            $items['total'] = 0;
            $items['message'] = 'Login error : '.saprfc_error();
            $items['data'] = array();

            echo json_encode($items);
            exit;
        }

        // discover interface of function module and set resource $sysinfo_fce
        $sysinfo_fce = @saprfc_function_discover ($rfc,"RFC_SYSTEM_INFO"); 
        if ($sysinfo_fce) 
        {
             // do RFC call to connected R/3 system
             $retval = @saprfc_call_and_receive ($sysinfo_fce); 
             if ($retval == SAPRFC_OK) 
             {
                  // retrieve export (output) parametr RFCSI_EXPORT
                  $sysinfo = saprfc_export ($sysinfo_fce,"RFCSI_EXPORT");
                  // $items['rfc_system_info'] = $sysinfo;
                  // $RFC_SYSTEM_INFO = sprintf ("system id: %s (%s), client=%03d, user=%s, application server=%s (%s,%s,%s), database=%s (%s)",
                  //                              $sysinfo["RFCSYSID"],$sysinfo["RFCSAPRL"],$l["CLIENT"],$l["USER"],$sysinfo["RFCHOST"], $sysinfo["RFCOPSYS"],
                  //                              $sysinfo["RFCIPADDR"],$sysinfo["RFCKERNRL"], $sysinfo["RFCDBHOST"], $sysinfo["RFCDBSYS"] );
             }
             // free allocated resources
             @saprfc_function_free ($sysinfo_fce);
        }

        // other, use function module RFC_FUNCTION_SEARCH to
        // get a list of RFC functions of target R/3
        $search_fce = saprfc_function_discover ($rfc,"RFC_FUNCTION_SEARCH");
        $function = "ZRFC_FINEST_SPB_STATUS_V3";

        

        $fce = @saprfc_function_discover ($rfc,$function);      // discover interface of function module $function
        if (!$fce )
        {
            $items['success'] = true;
            $items['total'] = 0;
            $items['message'] = 'Discovering function module error : '.saprfc_error();
            $items['data'] = array();

            echo json_encode($items);
            exit;

        }

        $def = @saprfc_function_interface($fce);               // retrieve definition of interface in array $def

        saprfc_import ($fce,"IM_BUKRS","1000");  // set import parameters


        saprfc_table_init ($fce,"T_BUDAT");

        $vararray =  array();
        $vararray["SIGN"] = "I"; 
        $vararray["OPTION"] = "EQ"; 
        // $vararray["LOW"] = "20180718"; 
        // $vararray["HIGH"] = "20180718";
        $vararray["LOW"] = $postdate; 
        $vararray["HIGH"] = $postdate;
        saprfc_table_append ($fce,'T_BUDAT', $vararray);

      

        // rfc call function in connected R/3
        $retval = @saprfc_call_and_receive ($fce);

        if ( $retval != SAPRFC_OK  )
        {
            $items['success'] = true;
            $items['total'] = 0;
            $items['message'] = 'Call error : '.saprfc_error();
            $items['data'] = array();

            echo json_encode($items);
            exit;
        }
        $data = array();
        for ($i=0;$i<count($def);$i++)
        {
            $interface = $def[$i];
            if ($interface["type"] == "TABLE")  // show content of internal tables
            {
                // $form .= "<tr bgcolor=#D0D0D0><td colspan=2><b>TABLE ".$interface["name"]."</b></td></tr>\n";
                // unset ($vararray);
                $rows = saprfc_table_rows ($fce,$interface["name"]);
                for ($j=1;$j<=$rows;$j++)
                    // $items['data'][] = saprfc_table_read($fce,$interface["name"],$j);
                    $data[] = saprfc_table_read($fce,$interface["name"],$j);
                // $form .= show_table_out ($interface["name"],$interface["def"],$vararray);
            }
        }

        // free resources and close rfc connection
        @saprfc_function_free($fce);
        @saprfc_close($rfc);

        $items['success'] = true;
        $items['total'] = 1;
        $items['message'] = 'success';
        

        $found_key = array_search($docno, array_column($data, 'BELNR'));
        // $found_key = array_search($docno, array_map(function ($each) {
        //                                              if(isset($each['BELNR'])){
        //                                                      return $each['BELNR'];
        //                                                  }
        //                                              }, $data));
        
        if($found_key){
            $items['data'] = $data[$found_key];
        }

        echo json_encode($items);
        exit;


    }

    public function processdata()
    {
        
        $postdate = $this->input->get('postdate', '');
        $docno = $this->input->get('docno', '');
        $p_map_npk_id = $this->input->get('p_map_npk_id', '');
        $username = $this->session->userdata('d_user_name');

        $items = array('success' => true, 'total'=> 0, 'message'=> '', 'data' => array());

        if($postdate == '' || $docno == ''){
            echo 'parameter postdate dan docno tidak ada';
            exit;
        }

        if (!extension_loaded ("saprfc")){
               echo "SAPRFC extension not loaded";
               exit;
        }
        // print_r($postdate); exit;
        $l = array();
        $l["ASHOST"] = '10.6.1.134';
        $l["SYSNR"] = '00';
        $l["CLIENT"] = '100';
        $l["USER"] = '641459';
        $l["PASSWD"] = 'Telkom2018';
        $l["MSHOST"] = null;
        $l["R3NAME"] = null;
        $l["GROUP"] = null;
        $l["LANG"] = null;
        $l["TRACE"] = null;
        $l["LCHECK"] = '1';
        $l["CODEPAGE"] = '1100';

        // login data avaible, can open connection to SAP R/3
        $rfc = @saprfc_open ($l);

        // print_r($rfc); exit;
        if (! $rfc )                    // if login failed, show error message
        {
            echo 'Login error : '.saprfc_error();
            exit;
        }

        // discover interface of function module and set resource $sysinfo_fce
        $sysinfo_fce = @saprfc_function_discover ($rfc,"RFC_SYSTEM_INFO"); 
        if ($sysinfo_fce) 
        {
             // do RFC call to connected R/3 system
             $retval = @saprfc_call_and_receive ($sysinfo_fce); 
             if ($retval == SAPRFC_OK) 
             {
                  // retrieve export (output) parametr RFCSI_EXPORT
                  $sysinfo = saprfc_export ($sysinfo_fce,"RFCSI_EXPORT");
                  // $items['rfc_system_info'] = $sysinfo;
                  // $RFC_SYSTEM_INFO = sprintf ("system id: %s (%s), client=%03d, user=%s, application server=%s (%s,%s,%s), database=%s (%s)",
                  //                              $sysinfo["RFCSYSID"],$sysinfo["RFCSAPRL"],$l["CLIENT"],$l["USER"],$sysinfo["RFCHOST"], $sysinfo["RFCOPSYS"],
                  //                              $sysinfo["RFCIPADDR"],$sysinfo["RFCKERNRL"], $sysinfo["RFCDBHOST"], $sysinfo["RFCDBSYS"] );
             }
             // free allocated resources
             @saprfc_function_free ($sysinfo_fce);
        }

        // other, use function module RFC_FUNCTION_SEARCH to
        // get a list of RFC functions of target R/3
        $search_fce = saprfc_function_discover ($rfc,"RFC_FUNCTION_SEARCH");
        $function = "ZRFC_FINEST_SPB_STATUS_V3";

        

        $fce = @saprfc_function_discover ($rfc,$function);      // discover interface of function module $function
        if (!$fce )
        {
            echo 'Discovering function module error : '.saprfc_error();
            exit;

        }

        $def = @saprfc_function_interface($fce);               // retrieve definition of interface in array $def

        saprfc_import ($fce,"IM_BUKRS","1000");  // set import parameters


        saprfc_table_init ($fce,"T_BUDAT");

        $vararray =  array();
        $vararray["SIGN"] = "I"; 
        $vararray["OPTION"] = "EQ"; 
        // $vararray["LOW"] = "20180718"; 
        // $vararray["HIGH"] = "20180718";
        $vararray["LOW"] = $postdate; 
        $vararray["HIGH"] = $postdate;
        saprfc_table_append ($fce,'T_BUDAT', $vararray);

      

        // rfc call function in connected R/3
        $retval = @saprfc_call_and_receive ($fce);

        if ( $retval != SAPRFC_OK  )
        {
            echo 'Call error : '.saprfc_error();
            exit;
        }
        $data = array();
        for ($i=0;$i<count($def);$i++)
        {
            $interface = $def[$i];
            if ($interface["type"] == "TABLE")  // show content of internal tables
            {
                // $form .= "<tr bgcolor=#D0D0D0><td colspan=2><b>TABLE ".$interface["name"]."</b></td></tr>\n";
                // unset ($vararray);
                $rows = saprfc_table_rows ($fce,$interface["name"]);
                for ($j=1;$j<=$rows;$j++)
                    // $items['data'][] = saprfc_table_read($fce,$interface["name"],$j);
                    $data[] = saprfc_table_read($fce,$interface["name"],$j);
                // $form .= show_table_out ($interface["name"],$interface["def"],$vararray);
            }
        }

        // free resources and close rfc connection
        @saprfc_function_free($fce);
        @saprfc_close($rfc);

        $items['success'] = true;
        $items['total'] = 1;
        $items['message'] = 'success';
        

        $found_key = array_search($docno, array_column($data, 'BELNR'));
        // $found_key = array_search($docno, array_map(function ($each) {
        //                                              if(isset($each['BELNR'])){
        //                                                      return $each['BELNR'];
        //                                                  }
        //                                              }, $data));
        
        if($found_key){
            $items['data'] = $data[$found_key];
            $finish_payment = $items['data']['AUGDT2'];
            $status_bayar = $items['data']['DESC_STAT'];
            
            if(strtoupper($status_bayar) != 'PAID'){
                echo 'status bayar belum PAID';
                exit;
            }

            if($finish_payment == ''){
                echo 'data Finish Payment kosong';
                exit;
            }

            if($p_map_npk_id > 0){

                $sqlpayment = "BEGIN "
                        . " p_submit_workflow_process("
                        . " :i_map_npk_id, "
                        . " :i_finish_payment,"
                        . " :i_username,"
                        . " :o_result_code,"
                        . " :o_result_msg"
                        . "); END;";


                $stmt = oci_parse($this->db->conn_id, $sqlpayment);

                // //  Bind the input parameter
                oci_bind_by_name($stmt, ':i_map_npk_id', $p_map_npk_id);
                oci_bind_by_name($stmt, ':i_finish_payment', $finish_payment);
                oci_bind_by_name($stmt, ':i_username', $username);

                // //bind output
                oci_bind_by_name($stmt, ':o_result_code', $code, 2000000);
                oci_bind_by_name($stmt, ':o_result_msg', $msg, 2000000);



                ociexecute($stmt);

                echo $msg;
                exit;
            }else{
                echo 'parameter p_map_npk_id belum ada';
                exit;
            }

        }


    }

}
