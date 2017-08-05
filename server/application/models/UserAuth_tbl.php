<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class UserAuth_tbl extends Base_Model{
    
    public function __construct() {
        parent::__construct();
        $this->load->library('bcrypt');
    }
    
    public $table = 'user_auth';
    public $primerykey = 'user_id';
    public $select = 'user_id,role_id,email,phone,username,pass,token,expiry,expiry_millies,is_email_verified,is_phone_verified'
            . ',is_admin_verified,is_active,is_ban,fail_attempt,is_deleted';
    
    public function LoginAttempt($credentials){
        $where_array = [
            'is_deleted' => 0
        ];
        $or_where_array = [
            'email' => $credentials['username'],
            'phone' => $credentials['username']
        ];
        $response = $this->getWhereQuery(null, $where_array, $or_where_array);
        if($response){
            $response = $response[0];
            if ($this->bcrypt->check_password($credentials['pass'], $response['pass'])){
                $this->clearFailAttempts($response[$this->primerykey]);
                return $response;
            }else{
                $this->updateFailAttempts($credentials['username']);
                return null;
            }
        }else{
            return null;
        }
        
        
    }
    
    public function updateUserToken($user_data){
        $update_data[$this->primerykey] = $user_data['user_id'];
        $update_data['token'] = $this->RandomString(32,null,$user_data['role_id']);
        $update_data['expiry'] = date('Y-m-d H:i:s',strtotime('+3 hour'));
        $update_data['expiry_millies'] = strtotime('+3 hour')*1000;
        $update_data['callfrom'] = "update";
        return $this->save($update_data);
    }
    
    private function banUser($user_id){
        $update_data[$this->primerykey] = $user_id;
        $update_data['is_ban'] = 1;
        $update_data['callfrom'] = "update";
        $this->save($update_data);
        $response['status'] = self::HTTP_UNAUTHORIZED;
        $response['message'] = 'Too Many Attempts, You Account Has Been Ban Please Contact Admin';
        $response['line'] = __LINE__;
        $response['function'] = __FUNCTION__;
        $response['controller'] = __CLASS__;
        $this->jsonOutput($response, $response['status']);
    }
    
    private function getFailAttempts($username){
        $this->db->from($this->table);
        $this->db->where('email',$username);
        $this->db->or_where('phone',$username);
        return $this->db->get()->result_array();
    }
    
    private function updateFailAttempts($username){
        $result = $this->getFailAttempts($username)[0];
        if($result['fail_attempt'] < $this->attempt_allowed){
            $update_data[$this->primerykey] = $result['user_id'];
            $update_data['fail_attempt'] = $result['fail_attempt'] + 1;
            $update_data['callfrom'] = "update";
            $this->save($update_data);
        }else{
           $this->banUser($result['user_id']);
        }
    }
    
    private function clearFailAttempts($user_id){
        $update_data[$this->primerykey] = $user_id;
        $update_data['fail_attempt'] = 0;
        $update_data['callfrom'] = "update";
        $this->save($update_data);
    }
    
    public function addExpiryTime($token){
        $this->updateWhereQuery(['token' => $token],null,['expiry' => date('Y-m-d H:i:s',strtotime('+10 min'))]);
        return true;
    }
}
