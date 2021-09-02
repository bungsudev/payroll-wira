<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lembur_m extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }
    
    public function data_lembur()
    {
        $query = $this->db->query("SELECT * FROM lembur WHERE deleted IS NULL");
        return $query->result_array();
    }

    public function getLemburAktif()
    {
        $query = $this->db->query("SELECT * FROM lembur WHERE status = 'aktif' AND deleted IS NULL");
        return $query->result_array();
    }

    public function data_lembur_detail()
    {
        $id = $this->input->post('id');
        $query = $this->db->query("SELECT * FROM lembur WHERE id_lembur='$id' AND deleted IS NULL");
        return $query->row();
    }

    public function getIDLembur()
    {
        // Example LMBR201912130001;
        $date = date("Ymd");
        $queryLength = "SELECT id_lembur FROM lembur WHERE MID(id_lembur,5,8) = '$date'";
        $curLength = ($this->db->query($queryLength)->num_rows()) + 1;
        if ($curLength <= 9) {
            $returnId = "LMBR" . $date . "000" . $curLength;
        } else if ($curLength <= 99) {
            $returnId = "LMBR" . $date . "00" . $curLength;
        } else if ($curLength <= 99) {
            $returnId = "LMBR" . $date . "0" . $curLength;
        } else {
            $returnId = "LMBR" . $date . $curLength;
        }
        return $returnId;
    }

    public function simpan_lembur()
    {
        $data = [
            "id_lembur" => $this->getIDLembur(),
            "nama" => $this->input->post('nama'),
            "jenis_nilai" => $this->input->post('jenis_nilai'),
            "nilai" => $this->input->post('nilai'),
            "keterangan" => $this->input->post('keterangan'),
            "status" => $this->input->post('status'),
            "created" => date("d-m-Y H:i:s").'-'.$this->session->userdata('username'),
        ];
        $this->db->insert('lembur', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function edit_lembur($id)
    {
        $data = [
            "nama" => $this->input->post('nama'),
            "jenis_nilai" => $this->input->post('jenis_nilai'),
            "nilai" => $this->input->post('nilai'),
            "keterangan" => $this->input->post('keterangan'),
            "status" => $this->input->post('status'),
            "edited" => date("d-m-Y H:i:s").'-'.$this->session->userdata('username'),
        ];

        $this->db->where('id_lembur', $id);
        $this->db->update('lembur', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function hapus_lembur()
    {
        $id = $this->input->post('id');
        $data = [
            "deleted" => date("d-m-Y H:i:s").'-'.$this->session->userdata('username'),
        ];

        $this->db->where('id_lembur', $id);
        $this->db->update('lembur', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }
}