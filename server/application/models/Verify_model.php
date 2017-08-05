<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Verify_model extends Base_Model{
    function __construct(){
        parent::__construct();
        $this->load->model('SellerMaster_tbl');
        $this->load->model('BuyerMaster_tbl');
        $this->load->model('UserAuthVirtual_tbl');
        $this->load->model('UserVerify_tbl');
        $this->load->model('UserAuth_tbl');
        $this->load->model('UserRole_tbl');
        $this->load->library('myemail');
        $this->load->library('bcrypt');
    }
    
    public function verifyUser($request){
        $verify_status = $this->UserVerify_tbl->verifyAttempt($request);
        if($verify_status){
            //Geting User Data
            $where_arry['email'] = $verify_status['email'];
            $where_arry['phone'] = $verify_status['phone'];
            $vartual_status = $this->UserAuthVirtual_tbl->getWhereQuery(null,$where_arry);
            if($vartual_status){
                $vartual_status = $vartual_status[0];
                $guest_id = $vartual_status['guest_id'];
                $vartual_status['is_email_verified'] = 1;
                $vartual_status['is_phone_verified'] = 1;
                $vartual_status['is_admin_verified'] = 0;
                $vartual_status['is_active'] = 1;
                $vartual_status['is_deleted'] = 0;
                $vartual_status['is_ban'] = 0;
                unset($vartual_status['guest_id']);         //Unset Key User ID
                $this->db->trans_start();
                $user_status = $this->UserAuth_tbl->save($vartual_status);
                if($user_status){
                    if($this->UserVerify_tbl->delete(['guest_id' => $guest_id]) && $this->UserAuthVirtual_tbl->delete(['guest_id' => $guest_id])){
                        if($user_status['role_id'] == 3){
                            if($this->BuyerMaster_tbl->save(['user_id' => $user_status['user_id']]) && $this->db->trans_complete()){
                                if($this->db->trans_status()){
                                    $this->db->trans_commit();
                                    $response['status'] = self::HTTP_OK;
                                    $response['message'] = 'User Verified Successfully';
                                }else{
                                    $this->db->trans_rollback();
                                    $response['status'] = self::HTTP_BAD_REQUEST;
                                    $response['message'] = 'Transection Fail';
                                    $response['debug_message'] = 'Some Database Error';
                                }
                            }else{
                                $this->db->trans_rollback();
                                $response['status'] = self::HTTP_BAD_REQUEST;
                                $response['message'] = 'Transection Fail';
                                $response['debug_message'] = 'Entry Not Deleted From SellerMaster_tbl';
                            }
                        }else if($user_status['role_id'] == 4){
                            if($this->SellerMaster_tbl->save(['user_id' => $user_status['user_id']]) && $this->db->trans_complete()){
                                if($this->db->trans_status()){
                                    $this->db->trans_commit();
                                    $response['status'] = self::HTTP_OK;
                                    $response['message'] = 'User Verified Successfully';
                                }else{
                                    $this->db->trans_rollback();
                                    $response['status'] = self::HTTP_BAD_REQUEST;
                                    $response['message'] = 'Transection Fail';
                                    $response['debug_message'] = 'Some Database Error';
                                }
                            }else{
                                $this->db->trans_rollback();
                                $response['status'] = self::HTTP_BAD_REQUEST;
                                $response['message'] = 'Transection Fail';
                                $response['debug_message'] = 'Entry Not Deleted From SellerMaster_tbl';
                            }
                        }
                    }else{
                        $this->db->trans_rollback();
                        $response['status'] = self::HTTP_BAD_REQUEST;
                        $response['message'] = 'Transection Fail';
                        $response['debug_message'] = 'Entry Not Deleted From UserVerify_tbl';
                    }
                }else{
                    $this->db->trans_rollback();
                    $response['status'] = self::HTTP_BAD_REQUEST;
                    $response['message'] = 'Transection Fail';
                    $response['debug_message'] = 'Entry Not Saved In UserAuth_tbl';
                }
            }else{
                $response['status'] = self::HTTP_BAD_REQUEST;
                $response['message'] = 'Transection Fail';
                $response['debug_message'] = 'Data Not Found In UserAuthVirtual_tbl';
            }
        }else{
            $response['status'] = self::HTTP_BAD_REQUEST;
            $response['message'] = 'Activation Time Expier, Please Try Again';
        }
        $this->jsonOutput($response,$response['status']);
    }
    
    public function verifyForgotEmail($request){
        $verify_status = $this->UserVerify_tbl->verifyAttempt($request);
        if($verify_status){
            $Password = $this->RandomString(16);
            $hash_Password = $this->bcrypt->hash_password($Password);
            if($this->UserAuth_tbl->updateWhereQuery(['email' => $verify_status['email']],null,['pass' => $hash_Password])){
                $email_array = [
                    'to' => $verify_status['email'],
                    'message' => 'Your Temp Password Is <b>'.$Password.'</b> For Ecommerce,<br>Please Change It',
                    'subject' => 'Password Changed SuccessFully',
                ];
                if($this->myemail->sendmail($email_array)){
                    if($this->UserVerify_tbl->delete(['token' => $request['token']])){
                        $response['status'] = self::HTTP_OK;
                        $response['message'] = 'Password Changed Please Check Email';
                    }else{
                        $response['status'] = self::HTTP_FORBIDDEN;
                        $response['message'] = 'Transection Fail';
                        $response['debug_message'] = 'Delete Entry Fail In UserVerify_tbl';
                    }
                }else{
                    $response['status'] = self::HTTP_FORBIDDEN;
                    $response['message'] = 'Transection Fail';
                    $response['debug_message'] = 'Email Sending Fail';
                }
            }else{
                $this->db->trans_rollback();
                $response['status'] = self::HTTP_FORBIDDEN;
                $response['message'] = 'Transection Fail';
                $response['debug_message'] = 'UserAuthVirtual_request Fail';
            }
        }else{
            $response['status'] = self::HTTP_BAD_REQUEST;
            $response['message'] = 'Activation Time Expier';
        }
        $this->jsonOutput($response,$response['status']);
    }
}
