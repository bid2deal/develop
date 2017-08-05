<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Reset_model extends Base_Model{
    function __construct(){
        parent::__construct();
        $this->load->model('UserVerify_tbl');
        $this->load->model('UserAuth_tbl');
        $this->load->model('UserRole_tbl');
        $this->load->library('myemail');
        $this->load->library('bcrypt');
    }
    
    public function changePassword($request){
        $UserData = $this->UserAuth_tbl->getWhereQuery(null,['user_id' => $this->getUserId()]);
        if($UserData){
            $UserData = $UserData[0];
            if ($this->bcrypt->check_password($request['current_pass'], $UserData['pass'])){
                $password = $this->bcrypt->hash_password($request['new_pass']);
                if($this->UserAuth_tbl->updateWhereQuery(['user_id' => $this->getUserId()],null,['pass' => $password])){
                    $response['status'] = self::HTTP_OK;
                    $response['message'] = 'Password Changed Successfully';
                }else{
                    $response['status'] = self::HTTP_FORBIDDEN;
                    $response['message'] = 'Transection Fail';
                    $response['debug_message'] = 'Password Change Fail In UserAuth_tbl';
                }
            }else{
                $response['status'] = self::HTTP_BAD_REQUEST; 
                $response['message'] = "Invalid Password";
            }
            $this->jsonOutput($response,$response['status']);
        }
    }
    
}
