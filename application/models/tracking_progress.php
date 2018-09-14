<?php

class Tracking_progress extends CI_Model
{

    function __construct() {
        parent::__construct();

        $this->load->helper('sequence');
    }


    function crud_progress_pks() {

        // $oper = $this->input->post('oper');
        // $id_ = $this->input->post('id');
                
        // $PGL_ID = $this->input->post('PGL_ID'); 
        // $DESCRIPTION = $this->input->post('DESCRIPTION'); 
        
        // $CREATED_BY = $this->session->userdata('d_user_name');
        // $UPDATED_BY = $this->session->userdata('d_user_name');

        
        // $result = array();
        
        // switch ($oper) {
        //     case 'add':
        //         try {
        //             $p_map_pks_id = gen_id('P_MAP_PKS_ID', 'P_MAP_PKS');
        //             $this->db->set('P_MAP_PKS_ID', $p_map_pks_id);                       
        //             $this->db->set('PGL_ID', $PGL_ID);                       
        //             $this->db->set('DESCRIPTION', $DESCRIPTION);                       
        //             $this->db->set('STATUS', 'INITIAL STEP');    
        //             $this->db->set('CREATED_DATE',"sysdate",false);
        //             $this->db->set('CREATE_BY',$CREATED_BY);   
        //             $this->db->set('UPDATE_DATE',"sysdate",false);                   
        //             $this->db->set('UPDATE_BY',$UPDATED_BY);                   
        //             $this->db->insert('P_MAP_PKS');

        //             if($this->db->affected_rows() > 0)
        //             {
        //                 $result['success'] = true;
        //                 $result['message'] = 'Kontrak Gagal Ditambahkan';
    
        //             }else{
        //                 $result['success'] = true;
        //                 $result['message'] = 'Kontrak Gagal Ditambahkan';
        //             }
                    
        //         }catch(Exception $e) {
        //             $result['success'] = false;
        //             $result['message'] = $e->getMessage();
        //         }
                
        //         break;
        //     case 'edit':
                
        //         try {

        //             $p_map_pks_id = $this->input->post('P_MAP_PKS_ID'); 
        //             $this->db->set('P_MAP_PKS_ID', $p_map_pks_id);                       
        //             $this->db->set('PGL_ID', $PGL_ID);                       
        //             $this->db->set('DESCRIPTION', $DESCRIPTION);
        //             $this->db->set('UPDATE_DATE',"sysdate",false);                   
        //             $this->db->set('UPDATE_BY',$UPDATED_BY);                   
        //             $this->db->update('P_MAP_PKS');
                    
        //             $result['success'] = true;
        //             $result['message'] = 'Kontrak Berhasil Diupdate';
                    
        //         }catch(Exception $e) {
        //             $result['success'] = false;
        //             $result['message'] = $e->getMessage();
        //         }
                
        //         break;
        //     case 'del':
        //         try {
        //             $this->db->where('P_MAP_PKS_ID', $id_);
        //             $this->db->delete('P_MAP_PKS');
                    
        //             $result['success'] = true;
        //             $result['message'] = 'Kontrak Berhasil Dihapus';
        //         }catch(Exception $e) {
        //             $result['success'] = false;
        //             $result['message'] = $e->getMessage();
        //         }
        //         break;
        // }
        
        // return $result;
    }


}