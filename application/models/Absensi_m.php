<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Absensi_m extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function data_absensi()
    {
        $periode = $this->input->post('periode');
        $id_outlet = $this->input->post('id_outlet');
        $query = $this->db->query("SELECT * FROM absensi WHERE periode = '$periode' AND id_outlet = '$id_outlet' AND deleted IS NULL");
        return $query->result_array();
    }

    public function data_absensi_detail()
    {
        $id = $this->input->post('id');
        $query = $this->db->query("SELECT * FROM absensi WHERE id_absensi='$id' AND deleted IS NULL");
        return $query->row();
    }

    public function getIDAbsensi()
    {
        // Example OUTL201912130001;
        $date = date("Ymd");
        $queryLength = "SELECT id_absensi FROM absensi WHERE MID(id_absensi,5,8) = '$date'";
        $curLength = ($this->db->query($queryLength)->num_rows()) + 1;
        if ($curLength <= 9) {
            $returnId = "OUTL" . $date . "000" . $curLength;
        } else if ($curLength <= 99) {
            $returnId = "OUTL" . $date . "00" . $curLength;
        } else if ($curLength <= 99) {
            $returnId = "OUTL" . $date . "0" . $curLength;
        } else {
            $returnId = "OUTL" . $date . $curLength;
        }
        return $returnId;
    }

    public function simpan_absensi()
    {
        $data = [
            "id_absensi" => $this->getIDAbsensi(),
            "nama_absensi" => $this->input->post('nama_absensi'),
            "created" => date("d-m-Y H:i:s").'-'.$this->session->userdata('username'),
        ];
        $this->db->insert('absensi', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function edit_absensi($id)
    {
        $data = [
            "nama_absensi" => $this->input->post('nama_absensi'),
            "edited" => date("d-m-Y H:i:s").'-'.$this->session->userdata('username')
        ];

        $this->db->where('id_absensi', $id);
        $this->db->update('absensi', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function hapus_absensi()
    {
        $id = $this->input->post('id');
        $data = [
            "deleted" => date("d-m-Y H:i:s").$this->session->userdata('username'),
        ];

        $this->db->where('id_absensi', $id);
        $this->db->update('absensi', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    //karyawan absensi

    public function data_absensi_detail_karyawan()
    {
        $id = $this->input->post('id');
        $query = $this->db->query("SELECT a.*,b.*, c.* FROM absensi_detail a LEFT JOIN absensi b ON a.id_absensi = b.id_absensi LEFT JOIN karyawan c ON a.id_karyawan = c.id_karyawan where a.id_absensi = '$id' AND a.deleted IS NULL AND b.deleted IS NULL AND c.deleted IS NULL GROUP BY a.id_absensidetail");
        return $query->result_array();
    }

    public function data_ByID()
    {
        $id = $this->input->post('id');
        $query = $this->db->query("SELECT a.*,b.*, c.* FROM absensi_detail a LEFT JOIN absensi b ON a.id_absensi = b.id_absensi LEFT JOIN karyawan c ON a.id_karyawan = c.id_karyawan where id_absensidetail = '$id' AND a.deleted IS NULL AND b.deleted IS NULL AND c.deleted IS NULL GROUP BY a.id_absensidetail");
        return $query->row();
    }

    //absensi
    public function data_karyawan_ByAbsensi()
    {
        $query = $this->db->query("SELECT a.*, b.* FROM absensi a INNER JOIN  WHERE deleted IS NULL");
        return $query->result_array();
    }

    public function simpan_absensi_karyawan()
    {
        $data = [
            "id_absensi" => $this->input->post('id_absensi'),
            "id_karyawan" => $this->input->post('id_karyawan'),
            "shift_karyawan" => $this->input->post('shift_karyawan'),
            "created" => date("d-m-Y H:i:s").'-'.$this->session->userdata('username'),
        ];
        $this->db->insert('absensi_detail', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function edit_absensi_karyawan($id)
    {
        $data = [
            "id_karyawan" => $this->input->post('id_karyawan'),
            "shift_karyawan" => $this->input->post('shift_karyawan'),
            "edited" => date("d-m-Y H:i:s").'-'.$this->session->userdata('username'),
        ];

        $this->db->where('id_absensidetail', $id);
        $this->db->update('absensi_detail', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function hapus_absensi_karyawan()
    {
        $id = $this->input->post('id');
        $data = [
            "deleted" => date("d-m-Y H:i:s").$this->session->userdata('username'),
        ];

        $this->db->where('id_absensidetail', $id);
        $this->db->update('absensi_detail', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }
}