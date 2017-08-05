<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Test_model extends Base_Model{
    function __construct(){
        parent::__construct();
    }
    
    public function register(){
        echo $this->getUserId();
    }
}
