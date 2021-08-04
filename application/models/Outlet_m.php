<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Outlet_m extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function data_shift_outlet($id)
    {
        $query = $this->db->query("SELECT shift_outlet FROM outlet WHERE id_outlet='$id' AND deleted IS NULL");
        return $query->row();
    }

    public function data_outlet_detail_wParam($id)
    {
        $query = $this->db->query("SELECT * FROM outlet WHERE id_outlet='$id' AND deleted IS NULL");
        return $query->row();
    }
    
    public function data_outlet()
    {
        $query = $this->db->query("SELECT * FROM outlet WHERE deleted IS NULL");
        return $query->result_array();
    }

    public function data_outlet_detail()
    {
        $id = $this->input->post('id');
        $query = $this->db->query("SELECT * FROM outlet WHERE id_outlet='$id' AND deleted IS NULL");
        return $query->row();
    }

    public function simpan_outlet()
    {
        $data = [
            "nama_outlet" => $this->input->post('nama_outlet'),
            "shift_outlet" => $this->input->post('shift_outlet'),
            "tunjangan_outlet" => $this->input->post('tunjangan_outlet'),
            "created" => date("d-m-Y H:i:s").$this->session->userdata('username'),
        ];
        $this->db->insert('outlet', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function edit_outlet($id)
    {
        $data = [
            "nama_outlet" => $this->input->post('nama_outlet'),
            "shift_outlet" => $this->input->post('shift_outlet'),
            "tunjangan_outlet" => $this->input->post('tunjangan_outlet'),
            "edited" => date("d-m-Y H:i:s").$this->session->userdata('username'),
        ];

        $this->db->where('id_outlet', $id);
        $this->db->update('outlet', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function hapus_outlet()
    {
        $id = $this->input->post('id');
        $data = [
            "deleted" => date("d-m-Y H:i:s").$this->session->userdata('username'),
        ];

        $this->db->where('id_outlet', $id);
        $this->db->update('outlet', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }
}