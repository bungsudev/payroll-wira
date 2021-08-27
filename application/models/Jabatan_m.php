<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jabatan_m extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }
    
    public function data_jabatan()
    {
        $query = $this->db->query("SELECT * FROM jabatan WHERE deleted IS NULL");
        return $query->result_array();
    }

    public function data_jabatan_detail()
    {
        $id = $this->input->post('id');
        $query = $this->db->query("SELECT * FROM jabatan WHERE id_jabatan='$id' AND deleted IS NULL");
        return $query->row();
    }

    public function simpan_jabatan()
    {
        $data = [
            "jabatan" => $this->input->post('jabatan'),
            "created" => date("d-m-Y H:i:s").'-'.$this->session->userdata('username'),
        ];
        $this->db->insert('jabatan', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function edit_jabatan($id)
    {
        $data = [
            "jabatan" => $this->input->post('jabatan'),
            "edited" => date("d-m-Y H:i:s").'-'.$this->session->userdata('username'),
        ];

        $this->db->where('id_jabatan', $id);
        $this->db->update('jabatan', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function hapus_jabatan()
    {
        $id = $this->input->post('id');
        $data = [
            "deleted" => date("d-m-Y H:i:s").$this->session->userdata('username'),
        ];

        $this->db->where('id_jabatan', $id);
        $this->db->update('jabatan', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }
}