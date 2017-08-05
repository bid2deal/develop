<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Auth_model extends Base_Model{
    public function __construct(){
        parent::__construct();
        $this->load->model('UserAuth_tbl');
    }
    
    public function validateUserToken($token){
        $result = $this->UserAuth_tbl->getWhereQuery(null,['token' => $token]);
        if($result){
            $result = $result[0];
            $response['user_id'] = $result['user_id'];
            $response['role_id'] = $result['role_id'];
            $response['is_active'] = $result['is_active'];
            $response['expiry'] = $result['expiry'];
            $response['expiry_millies'] = $result['expiry_millies'];
            $response['is_deleted'] = $result['is_deleted'];
            $response['is_email_verified'] = $result['is_email_verified'];
            $response['is_phone_verified'] = $result['is_phone_verified'];
            $response['is_admin_verified'] = $result['is_admin_verified'];
            $response['is_ban'] = $result['is_ban'];
        }
        if($response){
            if(date($response['expiry_millies']) > $this->getCurrentMillies()){
                if($this->DateDiff(date($response['expiry']),$this->getCurrentTimeStemp(),"i") < 10){
                    $this->UserAuth_tbl->addExpiryTime($token);
                }
                $response['status'] = Self::HTTP_OK;
            }else{
                $response['status'] = Self::HTTP_UNAUTHORIZED;
                $response['message'] = "Token Expired";
            }
        }else{
            $response['status'] = self::HTTP_BAD_REQUEST; 
            $response['message'] = "Invalid Username Or Password";
        }
        return $response;
    }
}
