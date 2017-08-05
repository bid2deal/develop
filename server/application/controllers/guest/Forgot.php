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
class Forgot extends Guest{
    
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model('Forgot_model');
        $this->load->helper('security');
    }
    
    public function forgotPass(){
        //Get Input Data
        $Post = $this->getPostInput();
        if(is_numeric($Post['EmailORPhone'])){
            $this->form_validation->set_rules('EmailORPhone','Phone','trim|required|exact_length[10]|numeric');
        }else{
            $this->form_validation->set_rules('EmailORPhone','Email','trim|required|strtolower|valid_email');
        }
        $this->form_validation->set_data(($Post == null) ? $temp = array() : $Post);
        if ($this->form_validation->run() == TRUE){
            if(is_numeric($Post['EmailORPhone'])){
                $this->dd('Comming Soon');
                $request['phone'] = $Post['EmailORPhone'];
                $this->Forgot_model->forgotEmail($request);
            }else{
                $request['email'] = $Post['EmailORPhone'];
                $this->Forgot_model->forgotEmail($request);
            }
        }else{
            $response['status'] = 400;
            $response['message'] = 'Validation Error';
            $response['errors'] = $this->form_validation->error_array();
            $response['line'] = __LINE__;
            $response['function'] = __FUNCTION__;
            $response['controller'] = __CLASS__;
            $this->jsonOutput($response,$response['status']);
        }
    }
    
}
