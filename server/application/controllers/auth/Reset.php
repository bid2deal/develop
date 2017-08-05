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
class Reset extends Auth{
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Reset_model');
        $this->Reset_model->setUserData($this->getCurrentUserArray());
    }
    
    public function resetPassword(){
        //Get Input Data
        $Post = $this->getPostInput();
        if($this->getUserRoleId() == 1){
            $this->form_validation->set_rules('UserID','User ID','trim|require|numeric');
        }
        $this->form_validation->set_rules('CurrentPass','CurrentPass','trim|required|max_length[20]');
        $this->form_validation->set_rules('NewPass','NewPass','trim|required|max_length[20]');
        $this->form_validation->set_rules('confirm_NewPass','confirm_NewPass','trim|required|max_length[20]|matches[NewPass]');
        $this->form_validation->set_data($Post);
        if ($this->form_validation->run() == TRUE){
            $request['current_pass'] = $Post['CurrentPass'];
            $request['new_pass'] = $Post['NewPass'];
            $this->Reset_model->changePassword($request);
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
