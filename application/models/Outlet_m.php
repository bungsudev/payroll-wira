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
            "t_ot" => $this->input->post('t_ot'),
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
            "t_ot" => $this->input->post('t_ot'),
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

    //karyawan outlet

    public function data_outlet_detail_karyawan()
    {
        $id = $this->input->post('id');
        $query = $this->db->query("SELECT a.*,b.*, c.* FROM outlet_detail a LEFT JOIN outlet b ON a.id_outlet = b.id_outlet LEFT JOIN karyawan c ON a.id_karyawan = c.id_karyawan where a.deleted IS NULL AND b.deleted IS NULL AND c.deleted IS NULL GROUP BY a.id_outletdetail");
        return $query->result_array();
    }

    public function data_ByID()
    {
        $id = $this->input->post('id');
        $query = $this->db->query("SELECT a.*,b.*, c.* FROM outlet_detail a LEFT JOIN outlet b ON a.id_outlet = b.id_outlet LEFT JOIN karyawan c ON a.id_karyawan = c.id_karyawan where id_outletdetail = '$id' AND a.deleted IS NULL AND b.deleted IS NULL AND c.deleted IS NULL GROUP BY a.id_outletdetail");
        return $query->row();
    }

    //outlet
    public function data_karyawan_ByOutlet()
    {
        $query = $this->db->query("SELECT a.*, b.* FROM outlet a INNER JOIN  WHERE deleted IS NULL");
        return $query->result_array();
    }

    public function simpan_outlet_karyawan()
    {
        $data = [
            "id_outlet" => $this->input->post('id_outlet'),
            "id_karyawan" => $this->input->post('id_karyawan'),
            "shift_karyawan" => $this->input->post('shift_karyawan'),
            "created" => date("d-m-Y H:i:s").$this->session->userdata('username'),
        ];
        $this->db->insert('outlet_detail', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function edit_outlet_karyawan($id)
    {
        $data = [
            "id_karyawan" => $this->input->post('id_karyawan'),
            "shift_karyawan" => $this->input->post('shift_karyawan'),
            "edited" => date("d-m-Y H:i:s").$this->session->userdata('username'),
        ];

        $this->db->where('id_outletdetail', $id);
        $this->db->update('outlet_detail', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function hapus_outlet_karyawan()
    {
        $id = $this->input->post('id');
        $data = [
            "deleted" => date("d-m-Y H:i:s").$this->session->userdata('username'),
        ];

        $this->db->where('id_outletdetail', $id);
        $this->db->update('outlet_detail', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }
}