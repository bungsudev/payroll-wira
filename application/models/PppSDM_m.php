<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PppSDM_m extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function data_shift_outlet($id)
    {
        $query = $this->db->query("SELECT shift_outlet FROM outlet WHERE id_outlet='$id' AND deleted IS NULL");
        return $query->row();
    }

    public function total_karyawan_outlet($id)
    {
        $query = $this->db->query("SELECT id_outletdetail, id_outlet FROM `outlet_detail` where id_outlet = '$id' AND deleted IS NULL");
        return $query->num_rows();
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

    //karyawan yang sudah di isi absensinya
    public function get_karyawanOutlet()
    {
        $id = $this->input->post('id_outlet');
        $periode = $this->input->post('periode');
        $query = $this->db->query("SELECT a.*,b.nama, b.jabatan,b.nis,b.nik, b.tempat_lahir, b.tanggal_lahir, c.* FROM absensi a LEFT JOIN karyawan b ON a.id_karyawan = b.id_karyawan LEFT JOIN karyawan_detail c ON a.id_karyawan = c.id_karyawan WHERE a.id_outlet = '$id' AND a.periode = '$periode' ORDER BY b.nama");
        return $query->result_array();
    }

    public function dataDefault()
    {
        // $query = $this->db->query("SELECT * FROM setting_default where id = '1'");
        $query = $this->db->query("SELECT * FROM outlet_detail a INNER JOIN outlet b on a.id_outlet = b.id_outlet 
        INNER JOIN karyawan_detail c on a.id_karyawan = c.id_karyawan GROUP BY c.id_karyawan");
        return $query->row();
    }

    public function json_dataPPP($periode, $id_karyawan)
    {
        $query = $this->db->query("SELECT * FROM ppp_sdm where periode = '$periode' AND id_karyawan = '$id_karyawan'");
        return $query->row();
    }
    public function json_dataAbsensi($periode, $id_karyawan)
    {
        $query = $this->db->query("SELECT * FROM absensi where periode = '$periode' AND id_karyawan = '$id_karyawan'");
        return $query->row();
    }

    public function getIDOutlet()
    {
        // Example OUTL201912130001;
        $date = date("Ymd");
        $queryLength = "SELECT id_outlet FROM outlet WHERE MID(id_outlet,5,8) = '$date'";
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

    public function simpan_outlet()
    {
        $data = [
            "id_outlet" => $this->getIDOutlet(),
            "nama_outlet" => $this->input->post('nama_outlet'),
            "shift_outlet" => $this->input->post('shift_outlet'),
            "g_pkk" => $this->input->post('g_pkk'),
            "t_jbt" => $this->input->post('t_jbt'),
            // "t_trans" => $this->input->post('t_trans'),
            // "t_ot" => $this->input->post('t_ot'),
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
            "urine" => $this->input->post('urine'),
            "created" => date("d-m-Y H:i:s").'-'.$this->session->userdata('username'),
        ];
        $this->db->insert('outlet', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function edit_outlet($id)
    {
        $data = [
            "nama_outlet" => $this->input->post('nama_outlet'),
            "shift_outlet" => $this->input->post('shift_outlet'),
            "g_pkk" => $this->input->post('g_pkk'),
            "t_jbt" => $this->input->post('t_jbt'),
            // "t_trans" => $this->input->post('t_trans'),
            // "t_ot" => $this->input->post('t_ot'),
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
            "urine" => $this->input->post('urine'),
            "edited" => date("d-m-Y H:i:s").'-'.$this->session->userdata('username')
        ];

        $this->db->where('id_outlet', $id);
        $this->db->update('outlet', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function update_detail_cek()
    {
        $input_type = $this->input->post('input_type');
        if ($input_type == 'kbl') {
            $data_input = $this->input->post('kbl');
        }else if($input_type == 'lhk'){
            $data_input = $this->input->post('lhk');
        }else if($input_type == 'llr'){
            $data_input = $this->input->post('llr');
        }else if($input_type == 'sp'){
            $data_input = $this->input->post('sp');
        }else if($input_type == 'lbu'){
            $data_input = $this->input->post('lbu');
        }else if($input_type == 'lain'){
            $data_input = $this->input->post('lain');
        }else if($input_type == 'urine'){
            $data_input = $this->input->post('urine');
        }else if($input_type == 'dpst'){
            $data_input = $this->input->post('dpst');
        }else if($input_type == 'bpdd'){
            $data_input = $this->input->post('bpdd');
        }else if($input_type == 'diz'){
            $data_input = $this->input->post('diz');
        }

        $data = [
            $input_type => $data_input
        ];
        // print_r($this->input->post('nik'));
        // print_r($data); die();
        $this->db->where('id_karyawan', $this->input->post('id_karyawan'));
        $this->db->where('periode', $this->input->post('periode'));
        $this->db->update('ppp_sdm', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function hapus_outlet()
    {
        $id = $this->input->post('id');
        $data = [
            "deleted" => date("d-m-Y H:i:s").'-'.$this->session->userdata('username'),
        ];

        $this->db->where('id_outlet', $id);
        $this->db->update('outlet', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    //karyawan outlet

    public function data_outlet_detail_karyawan()
    {
        $id = $this->input->post('id');
        $query = $this->db->query("SELECT a.*,b.*, c.* FROM outlet_detail a LEFT JOIN outlet b ON a.id_outlet = b.id_outlet LEFT JOIN karyawan c ON a.id_karyawan = c.id_karyawan where a.id_outlet = '$id' AND a.deleted IS NULL AND b.deleted IS NULL AND c.deleted IS NULL GROUP BY a.id_outletdetail");
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
            "created" => date("d-m-Y H:i:s").'-'.$this->session->userdata('username'),
        ];
        $this->db->insert('outlet_detail', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function edit_outlet_karyawan($id)
    {
        $data = [
            "id_karyawan" => $this->input->post('id_karyawan'),
            "shift_karyawan" => $this->input->post('shift_karyawan'),
            "edited" => date("d-m-Y H:i:s").'-'.$this->session->userdata('username'),
        ];

        $this->db->where('id_outletdetail', $id);
        $this->db->update('outlet_detail', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function hapus_outlet_karyawan()
    {
        $id = $this->input->post('id');
        $data = [
            "deleted" => date("d-m-Y H:i:s").'-'.$this->session->userdata('username'),
        ];

        $this->db->where('id_outletdetail', $id);
        $this->db->update('outlet_detail', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }
}