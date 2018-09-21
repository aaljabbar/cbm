<?php

class M_tracking_progress_npk extends CI_Model
{

    function __construct() {
        parent::__construct();

        $this->load->helper('sequence');
    }

    function crud_progress_npk() {
        $oper = $this->input->post('oper');
        $id_ = $this->input->post('id');
                
        $PGL_ID = $this->input->post('PGL_ID'); 
        $PERIOD = $this->input->post('PERIOD'); 
        
        $CREATED_BY = $this->session->userdata('d_user_name');
        $UPDATED_BY = $this->session->userdata('d_user_name');

        
        $result = array();
        
        switch ($oper) {
            case 'add':
                try {
                    $p_map_npk_id = gen_id('P_MAP_NPK_ID', 'P_MAP_NPK');
                    $this->db->set('P_MAP_NPK_ID', $p_map_npk_id);                       
                    $this->db->set('PGL_ID', $PGL_ID);                       
                    $this->db->set('PERIOD', $PERIOD);                       
                    // $this->db->set('STATUS', 31);    
                    $this->db->set('CREATED_DATE',"sysdate",false);
                    $this->db->set('CREATE_BY',$CREATED_BY);   
                    $this->db->set('UPDATE_DATE',"sysdate",false);                   
                    $this->db->set('UPDATE_BY',$UPDATED_BY);                   
                    $this->db->insert('P_MAP_NPK');

                    if($this->db->affected_rows() > 0)
                    {
                        $result['success'] = true;
                        $result['message'] = 'Invoice Berhasil Ditambahkan';
    
                    }else{
                        $result['success'] = true;
                        $result['message'] = 'Invoice Gagal Ditambahkan';
                    }
                    
                }catch(Exception $e) {
                    $result['success'] = false;
                    $result['message'] = $e->getMessage();
                }
                
                break;
            case 'edit':
                
                try {

                    $p_map_npk_id = $this->input->post('P_MAP_NPK_ID'); 
                                          
                    $this->db->set('PGL_ID', $PGL_ID);                       
                    $this->db->set('PERIOD', $PERIOD);
                    $this->db->set('UPDATE_DATE',"sysdate",false);                   
                    $this->db->set('UPDATE_BY',$UPDATED_BY);  
                    $this->db->where('P_MAP_NPK_ID', $p_map_npk_id);        
                    $this->db->update('P_MAP_NPK');
                    
                    $result['success'] = true;
                    $result['message'] = 'Invoice Berhasil Diupdate';
                    
                }catch(Exception $e) {
                    $result['success'] = false;
                    $result['message'] = $e->getMessage();
                }
                
                break;
            case 'del':
                try {
                    $this->db->where('P_MAP_NPK_ID', $id_);
                    $this->db->delete('P_MAP_NPK');
                    
                    $result['success'] = true;
                    $result['message'] = 'Invoice Berhasil Dihapus';
                }catch(Exception $e) {
                    $result['success'] = false;
                    $result['message'] = $e->getMessage();
                }
                break;
        }
        
        return $result;
    }
}