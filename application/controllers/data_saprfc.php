<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Data_saprfc extends CI_Controller
{


    function __construct()
    {
        parent::__construct();
    }


    public function getdata()
    {
        $items = array('success' => true, 'total'=> 0, 'message'=> '', 'rfc_system_info' => array(),'data' => array());

        if (!extension_loaded ("saprfc")){
               echo "SAPRFC extension not loaded";
               exit;
        }

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
                  $items['rfc_system_info'] = $sysinfo;
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
        $vararray =  array();

        $vararray["LAUFD"] = null; 
        $vararray["LAUFI"] = null; 
        $vararray["ZBUKR"] = null; 
        $vararray["LIFNR"] = null; 
        $vararray["VBLNR"] = null; 
        $vararray["PYORD"] = null; 
        $vararray["TDPROCSS"] = null; 
        $vararray["TDCOPIES"] = null; 
        $vararray["LASTR"] = null; 
        $vararray["SRTGB"] = null; 
        $vararray["KOSTL"] = null; 
        $vararray["BELNR"] = "1900116331";
        $vararray["XBLNR"] = null; 
        $vararray["BUDAT"] = null; 
        $vararray["BLDAT"] = null; 
        $vararray["GSBER"] = null; 
        $vararray["TRIW"] = null; 
        $vararray["ACDRK"] = null; 
        $vararray["ANGTH"] = null; 
        $vararray["REKNG"] = null; 
        $vararray["LOGTR"] = null; 
        $vararray["PERKD"] = null; 
        $vararray["WAERS"] = null; 
        $vararray["RWBTR"] = null; 
        $vararray["ZNME1"] = null; 
        $vararray["ZSTRA"] = null; 
        $vararray["ZORT1"] = null; 
        $vararray["ZPSTL"] = null; 
        $vararray["ZBNKN"] = null; 
        $vararray["ZBANK"] = null; 
        $vararray["ZBRNC"] = null; 
        $vararray["ZBNKY"] = null; 
        $vararray["ZBNKS"] = null; 
        $vararray["SGTXT"] = null; 
        $vararray["TGBTR"] = null; 
        $vararray["UMBTR"] = null; 
        $vararray["PNBTR"] = null; 
        $vararray["PHBTR1"] = null; 
        $vararray["PHBTR2"] = null; 
        $vararray["PHBTR3"] = null; 
        $vararray["PHBTR5"] = null; 
        $vararray["PHBTR4"] = null; 
        $vararray["PHBTR6"] = null; 
        $vararray["PHBTRDD"] = null; 
        $vararray["SGORT1"] = null; 
        $vararray["SGDAT1"] = null; 
        $vararray["OFFCR1"] = null; 
        $vararray["JOBTT1"] = null; 
        $vararray["NIKNR1"] = null; 
        $vararray["SGORT2"] = null; 
        $vararray["SGDAT2"] = null; 
        $vararray["OFFCR2"] = null; 
        $vararray["JOBTT2"] = null; 
        $vararray["NIKNR2"] = null; 
        $vararray["UNAME"] = null; 
        $vararray["UDATE"] = null; 
        $vararray["UZEIT"] = null; 
        $vararray["STATS"] = null; 
        $vararray["SNAME"] = null; 
        $vararray["SDATE"] = null; 
        $vararray["SZEIT"] = null; 
        $vararray["BUKRS"] = null; 
        $vararray["HBKID"] = null; 
        $vararray["HKTID"] = null; 
        $vararray["REFNO"] = null; 
        $vararray["PNAME"] = null; 
        $vararray["PDATE"] = null; 
        $vararray["PZEIT"] = null; 
        $vararray["BTRCP"] = null; 
        $vararray["STACH"] = null; 
        $vararray["CHUSR"] = null; 
        $vararray["CHDTE"] = null; 
        $vararray["CHHRS"] = null; 
        $vararray["BLUSR"] = null; 
        $vararray["BLDTE"] = null; 
        $vararray["BLHRS"] = null; 
        $vararray["AUGDT1"] = null; 
        $vararray["AUGBL1"] = null; 
        $vararray["AUGDT2"] = null; 
        $vararray["AUGBL2"] = null; 
        $vararray["DESC_STAT"] = null; 
        saprfc_table_init ($fce,'T_REPORT');
        saprfc_table_append ($fce,'T_REPORT', $vararray);

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

        for ($i=0;$i<count($def);$i++)
        {
            $interface = $def[$i];
            if ($interface["type"] == "TABLE")  // show content of internal tables
            {
                // $form .= "<tr bgcolor=#D0D0D0><td colspan=2><b>TABLE ".$interface["name"]."</b></td></tr>\n";
                // unset ($vararray);
                $rows = saprfc_table_rows ($fce,$interface["name"]);
                for ($j=1;$j<=$rows;$j++)
                    $items['data'][] = saprfc_table_read($fce,$interface["name"],$j);
                // $form .= show_table_out ($interface["name"],$interface["def"],$vararray);
            }
        }

        // free resources and close rfc connection
        @saprfc_function_free($fce);
        @saprfc_close($rfc);

        echo json_encode($items);
        exit;


    }

}
