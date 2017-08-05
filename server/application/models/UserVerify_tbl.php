<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class UserVerify_tbl extends Base_Model{
    
    public $table = 'user_verify';
    public $primerykey = 'id';
    public $select = 'id,guest_id,token,email,email_otp,phone,phone_otp,prifix,expiry_millies,created_date';
    
    public function verifyAttempt($request){
        $user_exists = $this->getWhereQuery(null, $request);
        if($user_exists){
            $user_exists = $user_exists[0];
            if($user_exists['expiry_millies'] > $this->getCurrentMillies()){
                return $user_exists;
            }else{
                $response['status'] = self::HTTP_BAD_REQUEST;
                $response['message'] = 'Transection Fail';
                $response['debug_message'] = 'Activation Time Expier, Please Try Again';
            }
        }else{
            $response['status'] = self::HTTP_BAD_REQUEST;
            $response['message'] = 'Transection Fail';
            $response['debug_message'] = 'Invalid OTP';
        }
        $this->jsonOutput($response,$response['status']);
    }
}
