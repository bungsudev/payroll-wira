<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logs_m extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }
    
    public function save($log)
    {
        $data = [
            "log" => $log,
            "user" => $this->session->userdata('username')
        ];
        $this->db->insert('logs', $data);
    }

}