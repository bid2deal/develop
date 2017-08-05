<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Forgot_model extends Base_Model{
    function __construct(){
        parent::__construct();
        
        $this->load->model('Forgot_model');
//        $this->load->model('BuyerMaster_tbl');
//        $this->load->model('UserAuthVirtual_tbl');
        $this->load->model('UserVerify_tbl');
        $this->load->model('UserAuth_tbl');
//        $this->load->model('UserRole_tbl');
        $this->load->library('myemail');
    }
    
    public function forgotEmail($request){
        $email_exists = $this->UserAuth_tbl->getWhereQuery(null,$request);
        if($email_exists){
            $token = $this->RandomString(32);
            $email_otp = $this->RandomString(8, "N");
            $email_array = [
                'to' => $request['email'],
                'message' => 'Your Email OTP Is <b>'.$email_otp.'</b>.',
                'subject' => 'Forgot Password Request For Ecommerce',
            ];
            $email_status = $this->myemail->sendmail($email_array);
            if($email_status){
                $UserVerify_request['token'] = $token;
                $UserVerify_request['email'] = $request['email'];
                $UserVerify_request['email_otp'] = $email_otp;
                $UserVerify_request['prifix'] = 2;
                $UserVerify_request['expiry_millies'] = strtotime('+3 hour')*1000;
                if($this->UserVerify_tbl->save($UserVerify_request)){
                    $response['status'] = self::HTTP_OK;
                    $response['message'] = 'OTP Sent Please Check Email';
                    $response['verify_token'] = $token;
                }else{
                    $response['status'] = self::HTTP_BAD_REQUEST;
                    $response['message'] = 'Transection Fail';
                    $response['debug_message'] = 'Some Database Error';
                }
            }else{
                $response['status'] = self::HTTP_FORBIDDEN;
                $response['message'] = 'Transection Fail';
                $response['debug_message'] = 'Email Sending Fail';
            }
        }else{
            $response['status'] = self::HTTP_BAD_REQUEST;
            $response['message'] = 'Invalid Email';
            $response['debug_message'] = 'Email Not Found In UserVerify_tbl';
        }
        $this->jsonOutput($response,$response['status']);
    }
}
