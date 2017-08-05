<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Base_Form_validation extends CI_Form_validation{
    protected $CI;

    public function __construct() {
        echo "bhavik";die();
        parent::__construct();
            // reference to the CodeIgniter super object
        $this->CI =& get_instance();
    }
//    function __construct(){
//        echo "bhavik";die();
//        $this->load->database();
//    }
    
    function exist($str, $value){       
        list($table, $column) = explode('.', $value, 2);    
        $query = $this->CI->db->query("SELECT COUNT(*) AS count FROM $table WHERE $column = $str'");
        $row = $query->row();
        $this->form_validation->set_message('exist', 'Invalid Email Address');
        return ($row->count > 0) ? FALSE : TRUE;
      }
}