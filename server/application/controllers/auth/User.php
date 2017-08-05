<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Auth {

    public function __construct() {
        parent::__construct();
//        $this->load->model('LoginUser_tbl');
//        $this->load->model('UserMaster_tbl');
    }
    
    public function getUsersState(){
        $this->dd('DASDAS');
    }
    public function get(){
        $this->dd('DASDAS');
    }
    public function getUserinfo(){
        
    }
    
    public function getUser(){
        
    }
    
    public function getUsers(){
        echo $this->getUserId();
        echo $this->getUserRole();
    }
    
}
