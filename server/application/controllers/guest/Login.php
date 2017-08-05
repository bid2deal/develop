<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends Guest {

    public function __construct() {
        parent::__construct();
        $this->load->model('Login_model');
    }

    public function LoginUserById(){
        $post = $this->getPostInput();
        if(isset($post['Username']) && is_numeric($post['Username'])){
            $this->form_validation->set_rules('Username', 'Mobile', 'trim|required|numeric|exact_length[10]');
        }else{
            $this->form_validation->set_rules('Username', 'Username', 'trim|required|valid_email|max_length[50]');
        }
        $this->form_validation->set_rules('Password', 'Password', 'trim|required|max_length[50]');
        $this->form_validation->set_data(($post == null) ? $temp = array() : $post);
        if ($this->form_validation->run()){
            $request['username'] = $post['Username'];
            $request['pass'] = $post['Password'];
            $result = $this->Login_model->login($request);
            if($result['status'] == 200){
                $response['status'] = $result['status'];
                $response['message'] = $result['msg'];
                $response['token'] = $result['token'];
            }else{
                $response['status'] = $result['status'];
                $response['message'] = $result['msg'];
                $response['line'] = __LINE__;
                $response['function'] = __FUNCTION__;
                $response['controller'] = __CLASS__;
            }
        }else{
            $response['status'] = self::HTTP_BAD_REQUEST;
            $response['message'] = $this->form_validation->error_array();
            $response['line'] = __LINE__;
            $response['function'] = __FUNCTION__;
            $response['controller'] = __CLASS__;
        }
        $this->jsonOutput($response,$response['status']);
    }
}
