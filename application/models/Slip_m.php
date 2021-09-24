<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Slip_m extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function total_karyawan_slip($id)
    {
        $query = $this->db->query("SELECT id_slip_dtl, id_slip FROM `slip_detail` where id_slip = '$id' AND deleted IS NULL");
        return $query->num_rows();
    }

    public function data_slip_detail_wParam($id)
    {
        $query = $this->db->query("SELECT * FROM slip WHERE id_slip='$id' AND deleted IS NULL");
        return $query->row();
    }
    
    public function data_slip()
    {
        $query = $this->db->query("SELECT * FROM slip WHERE deleted IS NULL");
        return $query->result_array();
    }

    public function data_slip_detail()
    {
        $id = $this->input->post('id');
        $query = $this->db->query("SELECT * FROM slip WHERE id_slip='$id' AND deleted IS NULL");
        return $query->row();
    }

    public function getIDSlip()
    {
        // Example OUTL201912130001;
        $date = date("Ymd");
        $queryLength = "SELECT id_slip FROM slip WHERE MID(id_slip,5,8) = '$date'";
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

    public function simpan_slip()
    {
        $data = [
            "id_slip" => $this->getIDSlip(),
            "nama_slip" => $this->input->post('nama_slip'),
            "shift_slip" => $this->input->post('shift_slip'),
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
            "created" => date("d-m-Y H:i:s").'-'.$this->session->userdata('username'),
        ];
        $this->db->insert('slip', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function edit_slip($id)
    {
        $data = [
            "nama_slip" => $this->input->post('nama_slip'),
            "shift_slip" => $this->input->post('shift_slip'),
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
            "edited" => date("d-m-Y H:i:s").'-'.$this->session->userdata('username')
        ];

        $this->db->where('id_slip', $id);
        $this->db->update('slip', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function hapus_slip()
    {
        $id = $this->input->post('id');
        $data = [
            "deleted" => date("d-m-Y H:i:s").'-'.$this->session->userdata('username'),
        ];

        $this->db->where('id_slip', $id);
        $this->db->update('slip', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function hapus_slip_detail()
    {
        $id = $this->input->post('id');
        $data = [
            "deleted" => date("d-m-Y H:i:s").'-'.$this->session->userdata('username'),
        ];

        $this->db->where('id_slip_dtl', $id);
        $this->db->update('slip_detail', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    //karyawan slip

    public function data_slip_detail_karyawan()
    {
        $id = $this->input->post('id');
        $query = $this->db->query("SELECT a.*,b.*, c.* FROM slip_detail a LEFT JOIN slip b ON a.id_slip = b.id_slip LEFT JOIN karyawan c ON a.id_karyawan = c.id_karyawan where a.id_slip = '$id' AND a.deleted IS NULL AND b.deleted IS NULL AND c.deleted IS NULL GROUP BY a.id_slip_dtl");
        return $query->result_array();
    }

    public function data_ByID()
    {
        $id = $this->input->post('id');
        $query = $this->db->query("SELECT a.*,b.*, c.* FROM slip_detail a LEFT JOIN slip b ON a.id_slip = b.id_slip LEFT JOIN karyawan c ON a.id_karyawan = c.id_karyawan where id_slip_dtl = '$id' AND a.deleted IS NULL AND b.deleted IS NULL AND c.deleted IS NULL GROUP BY a.id_slip_dtl");
        return $query->row();
    }

    //slip
    public function data_karyawan_BySlip()
    {
        $query = $this->db->query("SELECT a.*, b.* FROM slip a INNER JOIN  WHERE deleted IS NULL");
        return $query->result_array();
    }

    public function simpan_slip_karyawan()
    {
        $data = [
            "id_slip" => $this->input->post('id_slip'),
            "id_karyawan" => $this->input->post('id_karyawan'),
            "shift_karyawan" => $this->input->post('shift_karyawan'),
            "created" => date("d-m-Y H:i:s").'-'.$this->session->userdata('username'),
        ];
        $this->db->insert('slip_detail', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function edit_slip_karyawan($id)
    {
        $data = [
            "id_karyawan" => $this->input->post('id_karyawan'),
            "shift_karyawan" => $this->input->post('shift_karyawan'),
            "edited" => date("d-m-Y H:i:s").'-'.$this->session->userdata('username'),
        ];

        $this->db->where('id_slip_dtl', $id);
        $this->db->update('slip_detail', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function hapus_slip_karyawan()
    {
        $id = $this->input->post('id');
        $data = [
            "deleted" => date("d-m-Y H:i:s").'-'.$this->session->userdata('username'),
        ];

        $this->db->where('id_slip_dtl', $id);
        $this->db->update('slip_detail', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }
}