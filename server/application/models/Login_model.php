<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Login_model extends Base_Model{
    public function __construct(){
        parent::__construct();
        $this->load->model('UserAuth_tbl');
    }
    
    public function login($request){
        $user_data = $this->UserAuth_tbl->LoginAttempt($request);
        if($user_data){
            if($user_data['is_ban'] == 1){
                $response['status'] = self::HTTP_UNAUTHORIZED;
                $response['message'] = 'You Account Has Been Ban Please Contact Admin';
            }elseif(($user_data['is_email_verified'] == 0 || $user_data['is_phone_verified'] == 0) && $user_data['is_active'] == 0){
                $response['status'] = self::HTTP_BAD_REQUEST; 
                $response['message'] = "Please Activate Your Account Useing Email & Phone OTP";
//            }elseif($user_data['is_admin_verified'] == 0){
//                $response['status'] = self::HTTP_BAD_REQUEST; 
//                $response['message'] = "Your Account is In Activation Process, Please Try After Some Time";
            }elseif($user_data['is_active'] == 0){
                $response['status'] = self::HTTP_BAD_REQUEST; 
                $response['message'] = "Your Account Has Been Deactivate Please Contact Admin";
            }else{
                $user_auth = $this->UserAuth_tbl->updateUserToken($user_data);
                if(strlen($user_auth['token']) == 32){
                    $data['UserId'] = $user_data['user_id'];
                    $data['RoleId'] = $user_data['role_id'];
                    $data['Token'] = $user_auth['token'];
                    $data['Email'] = $user_data['email'];
                    $data['Phone'] = $user_data['phone'];
                    $data['Username'] = $user_data['username'];
                    $data['Expiry'] = $user_data['expiry'];
                    $data['ExpiryMillies'] = $user_data['expiry_millies'];
                    $data['AdminVerified'] = $user_data['is_admin_verified'];
                    $response['status'] = self::HTTP_OK; 
                    $response['message'] = "success"; 
                    $response['data'] = $data;
                }else{
                    $response['status'] = self::HTTP_BAD_REQUEST; 
                    $response['message'] = "Token Gen Fail";
                }
            }
        }else{
            $response['status'] = self::HTTP_BAD_REQUEST; 
            $response['message'] = "Invalid Username Or Password";
        }
        $this->jsonOutput($response, $response['status']);
    }
}
