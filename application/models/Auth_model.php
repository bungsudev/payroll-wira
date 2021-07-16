<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }
    
    public function get($username){
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('username', $username);
        $result = $this->db->get()->row();
        return $result;
    }


    public function hitungJumlahAsset()
    {   
        $query = $this->db->get('users');
        if($query->num_rows()>0)
        {
          return $query->num_rows();
        }
        else
        {
          return 0;
        }
    }

    function fetch_pass($session_username){
        $fetch_pass=$this->db->query("select * from users where username='$session_username'");
        $res=$fetch_pass->result();
    }
    
  	function change_pass($session_username,$new_pass){
  	    $update_pass=$this->db->query("UPDATE users set Password_1='$new_pass'  where username='$session_username'");
  	}

    public function list_users(){
        $this->db->order_by('username','DESC');
        return $this->db->get('users')->result_array();
    }

    public function detail_users($username){
        $this->db->where('username',$username);
        return $this->db->get('users')->row_array();
    }

    public function detail_unit($username_unit){
        $this->db->where('username_unit',$username_unit);
        return $this->db->get('tb_unit')->row_array();
    }

    function is_username_available($username)  
      {  
          $this->db->where('username', $username);  
          $query = $this->db->get("users");  
          if($query->num_rows() > 0)  
          {  
              return true;  
          }  
          else  
          {  
              return false;  
          }  
    } 

}