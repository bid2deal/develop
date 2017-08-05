<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Register
 *
 * @author margosatree1
 */
class Register extends Guest{
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Register_model');
        $this->load->model('UserRole_tbl');
    }
    
    public function registerUser(){
        //Get Input Data
        $Post = $this->getPostInput();
        $roles = $this->UserRole_tbl->getRoleString();
        //Validation Of Input Data
        $this->form_validation->set_rules('Username','username','trim|required|max_length[20]|is_unique[user_auth.username]');
        $this->form_validation->set_rules('Email','email','trim|required|max_length[50]|strtolower|valid_email|is_unique[user_auth.email]');
        $this->form_validation->set_rules('Phone','phone','trim|required|exact_length[10]|numeric|is_unique[user_auth.phone]');
        $this->form_validation->set_rules('Password','pass','trim|required');
        $this->form_validation->set_rules('Type','type','trim|required|in_list['.$roles.']');
        $this->form_validation->set_data(($Post == null) ? $temp = array() : $Post);
        if ($this->form_validation->run() == TRUE){
            $request['username'] = $Post['Username'];
            $request['email'] = $Post['Email'];
            $request['phone'] = $Post['Phone'];
            $request['pass'] = $Post['Password'];
            $request['role_id'] = $Post['Type'];
            $this->Register_model->register($request);
        }else{
            $response['status'] = 400;
            $response['message'] = 'Validation Error';
            $response['errors'] = $this->form_validation->error_array();
            $response['line'] = __LINE__;
            $response['function'] = __FUNCTION__;
            $response['controller'] = __CLASS__;
        }
        $this->jsonOutput($response,$response['status']);
    }
}
