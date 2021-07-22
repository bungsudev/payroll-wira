<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Outlet_m extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }
    
    public function data_oulet()
    {
        $query = $this->db->query("SELECT * FROM outlet WHERE deleted IS NULL");
        return $query->result_array();
    }

    public function data_oulet_detail()
    {
        $id = $this->input->post('id');
        $query = $this->db->query("SELECT * FROM outlet WHERE id_outlet='$id' AND deleted IS NULL");
        return $query->row();
    }

    public function simpan_outlet($nama_gambar)
    {
        $data = [
            "nik" => $this->input->post('nik'),
            "nama" => $this->input->post('nama'),
            "status" => $this->input->post('status'),
            "tempat_lahir" => $this->input->post('tempat_lahir'),
            "tanggal_lahir" => $this->input->post('tanggal_lahir'),
            "agama" => $this->input->post('agama'),
            "suku" => $this->input->post('suku'),
            "handphone" => $this->input->post('handphone'),
            "tinggi" => $this->input->post('tinggi'),
            "berat" => $this->input->post('berat'),
            "alamat" => $this->input->post('alamat'),
            "pendidikan" => $this->input->post('pendidikan'),
            "pengalaman" => $this->input->post('pengalaman'),
            "pelatihan" => $this->input->post('pelatihan'),
            "foto" => $nama_gambar,
            "created" => date("d-m-Y H:i:s"),
        ];
        $this->db->insert('outlet', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function edit_outlet($nama_gambar, $id)
    {
        $data = [
            "nik" => $this->input->post('nik'),
            "nama" => $this->input->post('nama'),
            "status" => $this->input->post('status'),
            "tempat_lahir" => $this->input->post('tempat_lahir'),
            "tanggal_lahir" => $this->input->post('tanggal_lahir'),
            "agama" => $this->input->post('agama'),
            "suku" => $this->input->post('suku'),
            "handphone" => $this->input->post('handphone'),
            "tinggi" => $this->input->post('tinggi'),
            "berat" => $this->input->post('berat'),
            "alamat" => $this->input->post('alamat'),
            "pendidikan" => $this->input->post('pendidikan'),
            "pengalaman" => $this->input->post('pengalaman'),
            "pelatihan" => $this->input->post('pelatihan'),
            "edited" => date("d-m-Y H:i:s"),
        ];

        //cek update tanpa gambar
        (!empty($nama_gambar))? $data = array_merge($data, ["foto" => $nama_gambar]): '';

        $this->db->where('id_outlet', $id);
        $this->db->update('outlet', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function hapus_outlet()
    {
        $id = $this->input->post('id');
        $data = [
            "deleted" => date("d-m-Y H:i:s"),
        ];

        $this->db->where('id_outlet', $id);
        $this->db->update('outlet', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }
}