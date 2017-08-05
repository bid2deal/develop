<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Register_model extends Base_Model{
    function __construct(){
        parent::__construct();
        $this->load->model('UserAuthVirtual_tbl');
        $this->load->model('UserVerify_tbl');
        $this->load->model('UserAuth_tbl');
        $this->load->model('UserRole_tbl');
        $this->load->model('SellerMaster_tbl');
        $this->load->library('myemail');
        $this->load->library('bcrypt');
        $this->load->database();
    }
    
    public function register($request){
        
        //Generate Token, OTP For Verifying User
        $email_token = $this->RandomString(32);
        $email_otp = $this->RandomString(8,"N",null);
        $phone_otp = $this->RandomString(8,"N",null);
        
        //Sending Email To Registering User 
        $email_array = [
            'to' => $request['email'],
            'message' => 'Thank You <b>'.$request['username'].'</b> For Register WIth Us,<br>'
//                        .'Your Token OTP Is <b>'.$email_token.'</b><br>'
                        .'Your Phone OTP Is <b>'.$phone_otp.'</b><br>'
                        .'Your Email OTP Is <b>'.$email_otp.'</b>.',
            'subject' => 'Activation For Ecommerce',
        ];
        $email_status = $this->myemail->sendmail($email_array);
        if($email_status){
            //Check Data Exist Or Not, If Email & Phone Exists We Simply Update Table Data By guest_id
            $where_array['email'] = $request['email'];
            $where_array['phone'] = $request['phone'];
            $email_phone_exists = $this->UserAuthVirtual_tbl->getWhereQuery('guest_id',$where_array);
            if($email_phone_exists){
                $UserAuthVirtual_request['guest_id'] = $email_phone_exists[0]['guest_id'];
                $UserAuthVirtual_request['callfrom'] = "update";
            }
            $user_role_id = $this->UserRole_tbl->getWhereQuery('role_id',['role' => $request['role_id']])[0]['role_id'];
            $UserAuthVirtual_request['role_id'] = $user_role_id;
            $UserAuthVirtual_request['email'] = $request['email'];
            $UserAuthVirtual_request['phone'] = $request['phone'];
            $UserAuthVirtual_request['username'] = $request['username'];
            $UserAuthVirtual_request['pass'] = $this->bcrypt->hash_password($request['pass']);
//            $UserAuthVirtual_request['pass'] = $request['pass'];
//            $this->dd($UserAuthVirtual_request);
            $UserAuthVirtual_tbl = $this->UserAuthVirtual_tbl->save($UserAuthVirtual_request);
            if($UserAuthVirtual_tbl){
                //Reusing $where_array for Checking Data Exist Or Not in UserVerify_tbl
                //If Email & Phone Exists We Simply Update Table Data By guest_id
                $email_phone_exists = $this->UserVerify_tbl->getWhereQuery(null,$where_array);
                if($email_phone_exists){
                    $email_phone_exists = $email_phone_exists[0];
                    $UserVerify_request['id'] = $email_phone_exists['id'];
                    $UserVerify_request['callfrom'] = "update";
                }else{
                    $UserVerify_request['guest_id'] = $UserAuthVirtual_tbl['guest_id'];
                    $UserVerify_request['email'] = $request['email'];
                    $UserVerify_request['phone'] = $request['phone'];
                }
                $UserVerify_request['token'] = $email_token;
                $UserVerify_request['email_otp'] = $email_otp;
                $UserVerify_request['phone_otp'] = $phone_otp;
                $UserVerify_request['prifix'] = 1;//1 Means Request Made For Registreation By User
                $UserVerify_request['expiry_millies'] = strtotime('+1 day')*1000;
                $this->db->trans_start();
                $UserVerify_status = $this->UserVerify_tbl->save($UserVerify_request);
                $this->db->trans_complete();
                if($UserVerify_status && $this->db->trans_status()){
                    $this->db->trans_commit();
                    $response['status'] = self::HTTP_OK;
                    $response['message'] = 'Success';
                    $response['verify_token'] = $email_token;
                }else{
                    $this->db->trans_rollback();
                    $response['status'] = self::HTTP_BAD_REQUEST;
                    $response['message'] = 'Transection Fail';
                    $response['debug_message'] = 'UserVerify_request Fail';
                }
            }else{
                $this->db->trans_rollback();
                $response['status'] = self::HTTP_FORBIDDEN;
                $response['message'] = 'Transection Fail';
                $response['debug_message'] = 'UserAuthVirtual_request Fail';
            }
        }else{
            $response['status'] = self::HTTP_FORBIDDEN;
            $response['message'] = 'Transection Fail';
            $response['debug_message'] = 'Email Sending Fail';
        }
        $this->jsonOutput($response,$response['status']);
    }
}
