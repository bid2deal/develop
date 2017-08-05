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
class Verify extends Guest{
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Verify_model');
    }
    
    public function verifyUser(){
        //Get Input Data
        $Post = $this->getPostInput();
        $this->form_validation->set_rules('Token','Token','trim|required|exact_length[32]');
        $this->form_validation->set_rules('EmailOTP','Email OTP','trim|required|exact_length[8]|numeric');
        $this->form_validation->set_rules('PhoneOTP','Phone OTP','trim|required|exact_length[8]|numeric');
        $this->form_validation->set_data($Post);
        if ($this->form_validation->run() == TRUE){
            $request['token'] = $Post['Token'];
            $request['email_otp'] = $Post['EmailOTP'];
            $request['phone_otp'] = $Post['PhoneOTP'];
            $this->Verify_model->verifyUser($request);
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
    
    public function verifyForgotEmail(){
        //Get Input Data
        $Post = $this->getPostInput();
        $this->form_validation->set_rules('Token','Token','trim|required|exact_length[32]');
        $this->form_validation->set_rules('EmailOTP','EmailOTP','trim|required|exact_length[8]|numeric');
        $this->form_validation->set_data($Post);
        if ($this->form_validation->run() == TRUE){
            $request['token'] = $Post['Token'];
            $request['email_otp'] = $Post['EmailOTP'];
            $this->Verify_model->verifyForgotEmail($request);
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
