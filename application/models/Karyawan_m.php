<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Karyawan_m extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }
    
    public function data_karyawan()
    {
        $query = $this->db->query("SELECT * FROM karyawan WHERE deleted IS NULL");
        return $query->result_array();
    }

    public function data_karyawan_detail()
    {
        $id = $this->input->post('id');
        $query = $this->db->query("SELECT * FROM karyawan WHERE id_karyawan='$id' AND deleted IS NULL");
        return $query->row();
    }

    public function getIDKaryawan()
    {
        // Example KRYW201912130001;
        $date = date("Ymd");
        $queryLength = "SELECT id_absensi FROM absensi WHERE MID(id_absensi,5,8) = '$date'";
        $curLength = ($this->db->query($queryLength)->num_rows()) + 1;
        if ($curLength <= 9) {
            $returnId = "KRYW" . $date . "000" . $curLength;
        } else if ($curLength <= 99) {
            $returnId = "KRYW" . $date . "00" . $curLength;
        } else if ($curLength <= 99) {
            $returnId = "KRYW" . $date . "0" . $curLength;
        } else {
            $returnId = "KRYW" . $date . $curLength;
        }
        return $returnId;
    }

    public function simpan_karyawan($nama_gambar)
    {
        $data = [
            "id_karyawan" => $this->getIDKaryawan(),
            "nik" => $this->input->post('nik'),
            "nama" => $this->input->post('nama'),
            "status" => $this->input->post('status'),
            "tempat_lahir" => $this->input->post('tempat_lahir'),
            "tanggal_lahir" => $this->input->post('tanggal_lahir'),
            "agama" => $this->input->post('agama'),
            "suku" => $this->input->post('suku'),
            "handphone" => $this->input->post('handphone'),
            "jabatan" => $this->input->post('jabatan'),
            "tinggi" => $this->input->post('tinggi'),
            "berat" => $this->input->post('berat'),
            "alamat" => $this->input->post('alamat'),
            "pendidikan" => $this->input->post('pendidikan'),
            "pengalaman" => $this->input->post('pengalaman'),
            "pelatihan" => $this->input->post('pelatihan'),
            "foto" => $nama_gambar,
            "created" => date("d-m-Y H:i:s").'-'.$this->session->userdata('username'),
        ];
        $this->db->insert('karyawan', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function edit_karyawan($nama_gambar, $id)
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
            "jabatan" => $this->input->post('jabatan'),
            "tinggi" => $this->input->post('tinggi'),
            "berat" => $this->input->post('berat'),
            "alamat" => $this->input->post('alamat'),
            "pendidikan" => $this->input->post('pendidikan'),
            "pengalaman" => $this->input->post('pengalaman'),
            "pelatihan" => $this->input->post('pelatihan'),
            "edited" => date("d-m-Y H:i:s").'-'.$this->session->userdata('username'),
        ];

        //cek update tanpa gambar
        (!empty($nama_gambar))? $data = array_merge($data, ["foto" => $nama_gambar]): '';

        $this->db->where('id_karyawan', $id);
        $this->db->update('karyawan', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function hapus_karyawan()
    {
        $id = $this->input->post('id');
        $data = [
            "deleted" => date("d-m-Y H:i:s").'-'.$this->session->userdata('username'),
        ];

        $this->db->where('id_karyawan', $id);
        $this->db->update('karyawan', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }
}