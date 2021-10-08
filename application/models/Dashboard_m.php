<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_m extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }
    
    public function jumlah_karyawan()
    {
        $query = $this->db->query("SELECT * FROM karyawan WHERE deleted IS NULL");
        return $query->num_rows();
    }

    public function jumlah_outlet()
    {
        $query = $this->db->query("SELECT * FROM outlet WHERE deleted IS NULL");
        return $query->num_rows();
    }
}