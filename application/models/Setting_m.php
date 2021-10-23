<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting_m extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }
    
    public function data_setting()
    {
        $query = $this->db->query("SELECT * FROM setting_default WHERE deleted IS NULL");
        return $query->result_array();
    }

    public function data_setting_detail($id_karyawan)
    {
        $otl = $this->db->query("SELECT id_outletdetail ,id_outlet, id_karyawan FROM outlet_detail where id_karyawan = '$id_karyawan'")->row();
        $query = $this->db->query("SELECT * FROM outlet where id_outlet = '$otl->id_outlet'");
        return $query->row();
    }

    public function edit_setting()
    {
        $data = [
            "bpjs_kesehatan" => $this->input->post('bpjs_kesehatan'),
            "bpjs_tk" => $this->input->post('bpjs_tk'),
            "bpjs_jp" => $this->input->post('bpjs_jp'),
            "t_urine" => $this->input->post('t_urine'),
            "shift_outlet" => $this->input->post('shift_outlet'),
            "g_pkk" => $this->input->post('g_pkk'),
            "t_jbt" => $this->input->post('t_jbt'),
            "t_trans" => $this->input->post('t_trans'),
            "t_ot" => $this->input->post('t_ot'),
            "lhk" => $this->input->post('lhk'),
            "lbu" => $this->input->post('lbu'),
            "llr" => $this->input->post('llr'),
            "jst" => $this->input->post('jst'),
            "dpst" => $this->input->post('dpst'),
            "srg" => $this->input->post('srg'),
            "bpdd" => $this->input->post('bpdd'),
            "dab" => $this->input->post('dab'),
            "diz" => $this->input->post('diz'),
            "dis" => $this->input->post('dis'),
            "lain" => $this->input->post('lain'),
            "edited" => date("d-m-Y H:i:s").'-'.$this->session->userdata('username'),
        ];

        $this->db->update('setting_default', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }
}