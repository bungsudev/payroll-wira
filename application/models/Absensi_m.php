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
        $query = $this->db->query("SELECT a.*, b.* FROM absensi a LEFT JOIN karyawan b on a.id_karyawan = b.id_karyawan WHERE periode = '$periode' AND id_outlet = '$id_outlet' AND a.deleted IS NULL");
        return $query->result_array();
    }

    public function getAbsensiDtl()
    {
        $id_absensi = $this->input->post('id_absensi');
        $query = $this->db->query("SELECT a.*, b.* FROM absensi a LEFT JOIN karyawan b on a.id_karyawan = b.id_karyawan WHERE id_absensi = '$id_absensi' AND a.deleted IS NULL");
        return $query->row();
    }

    public function get_karyawanOutlet()
    {
        $outlet_filter = $this->input->post('outlet_filter');
        $periode_filter = $this->input->post('periode_filter');
        $query = $this->db->query("SELECT a.*, b.*,a.shift_karyawan as shift_out ,c.shift_outlet as shift_kry, 
        a.id_karyawan AS idKaryawan, a.id_outlet AS idOutlet FROM outlet_detail a 
        LEFT JOIN karyawan b ON a.id_karyawan = b.id_karyawan 
        LEFT JOIN karyawan_detail c ON a.id_karyawan = c.id_karyawan 
        where a.id_outlet = '$outlet_filter' 
        AND a.deleted IS NULL 
        AND b.deleted IS NULL 
        GROUP BY a.id_outletdetail");
        return $query->result_array();
    }

    public function cek_karyawan_absen()
    {
        $id_karyawan = $this->input->post('id_karyawan');
        $outlet_filter = $this->input->post('outlet_filter');
        $periode_filter = $this->input->post('periode_filter');
        $query = $this->db->query("SELECT * FROM absensi 
        where absensi.id_outlet = '$outlet_filter'
        AND absensi.periode = '$periode_filter'
        AND absensi.id_karyawan = '$id_karyawan'
        AND absensi.deleted IS NULL ");
        return $query->row();
    }

    public function data_absensi_detail()
    {
        $id = $this->input->post('id');
        $query = $this->db->query("SELECT * FROM absensi WHERE id_absensi='$id' AND deleted IS NULL");
        return $query->row();
    }

    public function getIDAbsensi()
    {
        // Example ABSN201912130001;
        $date = date("Ymd");
        $queryLength = "SELECT id_absensi FROM absensi WHERE MID(id_absensi,5,8) = '$date'";
        $curLength = ($this->db->query($queryLength)->num_rows()) + 1;
        if ($curLength <= 9) {
            $returnId = "ABSN" . $date . "000" . $curLength;
        } else if ($curLength <= 99) {
            $returnId = "ABSN" . $date . "00" . $curLength;
        } else if ($curLength <= 99) {
            $returnId = "ABSN" . $date . "0" . $curLength;
        } else {
            $returnId = "ABSN" . $date . $curLength;
        }
        return $returnId;
    }

    public function simpan_absensi()
    {
        if(!empty($this->input->post("jenisLembur"))){
            foreach ($this->input->post("jenisLembur") as $key => $value) {
                $lembur[$key] = $value."|".$_POST["tanggalLembur"][$key];
            }
            $lembur = implode(",",$lembur);
        }else{
            $lembur = '';
        }

        $id_absensi = $this->getIDAbsensi();

        $data = [
            "id_absensi" => $id_absensi,
            "id_outlet" => $this->input->post('id_outlet'),
            "id_karyawan" => $this->input->post('id_karyawan'),
            "bulan" => $this->input->post('bulan'),
            "periode" => $this->input->post('periode'),
            "hadir" => $this->input->post('hadir'),
            "absen" => $this->input->post('absen'),
            "lembur" => $lembur,
            "created" => date("d-m-Y H:i:s").'-'.$this->session->userdata('username'),
        ];
        $this->db->insert('absensi', $data);

        //create ppp_sdm
        $data2 = [
            "id_absensi" => $id_absensi,
            "id_outlet" => $this->input->post('id_outlet'),
            "id_karyawan" => $this->input->post('id_karyawan'),
            "periode" => $this->input->post('periode'),
            "created" => date("d-m-Y H:i:s").'-'.$this->session->userdata('username'),
        ];
        $this->db->insert('ppp_sdm', $data2);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function createPPPSdm($id_absensi)
    {
        $data2 = [
            "id_absensi" => $id_absensi,
            "id_outlet" => $this->input->post('id_outlet'),
            "id_karyawan" => $this->input->post('id_karyawan'),
            "periode" => $this->input->post('periode'),
            "created" => date("d-m-Y H:i:s").'-'.$this->session->userdata('username'),
        ];
        $this->db->insert('ppp_sdm', $data2);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function edit_absensi($id)
    {
        if(!empty($this->input->post("jenisLembur"))){
            foreach ($this->input->post("jenisLembur") as $key => $value) {
                $lembur[$key] = $value."|".$_POST["tanggalLembur"][$key];
            }
            $lembur = implode(",",$lembur);
        }else{
            $lembur = '';
        }
        $data = [
            "id_outlet" => $this->input->post('id_outlet'),
            "id_karyawan" => $this->input->post('id_karyawan'),
            "bulan" => $this->input->post('bulan'),
            "periode" => $this->input->post('periode'),
            "hadir" => $this->input->post('hadir'),
            "absen" => $this->input->post('absen'),
            "lembur" => $lembur,
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
            "deleted" => date("d-m-Y H:i:s").'-'.$this->session->userdata('username'),
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
            "deleted" => date("d-m-Y H:i:s").'-'.$this->session->userdata('username'),
        ];

        $this->db->where('id_absensidetail', $id);
        $this->db->update('absensi_detail', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }
}