<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Base_Model extends CI_Model{
    
    private $user_id = null;
    private $role_id = null;
    private $expiry = null;
    private $expiry_millies = null;
    private $is_deleted = null;
    private $is_active = null;
    private $is_ban = null;
    private $is_email_verified = null;
    private $is_phone_verified = null;
    private $is_admin_verified = null;
    
    function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->model('AipRequests_tbl');
    }
    
    public function initCurrentUser($data){
        $this->user_id = $data['user_id'];
        $this->role_id = $data['role_id'];
        $this->expiry = $data['expiry'];
        $this->expiry_millies = $data['expiry_millies'];
        $this->is_active = $data['is_active'];
        $this->is_deleted = $data['is_deleted'];
        $this->is_ban = $data['is_ban'];
        $this->is_email_verified = $data['is_email_verified'];
        $this->is_phone_verified = $data['is_phone_verified'];
        $this->is_admin_verified = $data['is_admin_verified'];
    }
    
    public function getWhereQuery($select = null,$where_array = null,$or_where_array = null){
        if($select){
            $this->db->select($select);
        }else{
            $this->db->select($this->select);
        }
        if($where_array){
            $this->db->where($where_array);
        }
        if($or_where_array){
            $this->db->group_start();
            $this->db->or_where($or_where_array);
            $this->db->group_end();
        }
        $this->db->from($this->table);
        return $this->db->get()->result_array();
    }
    
    public function updateWhereQuery($where_array = null,$or_where_array = null,$request){
        if($where_array == null && $or_where_array == null){
            $response['status'] = self::HTTP_BAD_REQUEST;
            $response['message'] = 'invalid_input';
            $response['line'] = __LINE__;
            $response['function'] = __FUNCTION__;
            $response['controller'] = __CLASS__;
            $this->jsonOutput($response,$response['status']);
        }
        $this->db->trans_start();
        if($where_array){
            $this->db->where($where_array);
        }
        if($or_where_array){
            $this->db->group_start();
            $this->db->or_where($or_where_array);
            $this->db->group_end();
        }
        $this->db->update($this->table, $request);
        $this->db->trans_complete();
        if($this->db->trans_status()){
            if($this->db->affected_rows() > 0){
                return $request;
            }else{
            }
            return $request;
        }else{
            return null;
        }
        
    }
    
    public function save($request){
        $this->db->trans_start();
//        $this->dd($request);
        if(is_array($request)){
            if(isset($request['callfrom']) && $request['callfrom'] == "update" && isset($request[$this->primerykey]) && ($request[$this->primerykey] > 0 )){
                unset($request['callfrom']);
                $this->db->where($this->primerykey,$request[$this->primerykey]);
                $this->db->update($this->table, $request);
            }else{
                $this->db->insert($this->table, $request);
                $this->db->select_max($this->primerykey);
                $this->db->from($this->table);
                $temp = $this->db->get()->result_array()[0];
                $request[$this->primerykey] = $temp[$this->primerykey];
            }
        }else{
            $response['status'] = self::HTTP_BAD_REQUEST;
            $response['message'] = 'invalid_input';
            $response['line'] = __LINE__;
            $response['function'] = __FUNCTION__;
            $response['controller'] = __CLASS__;
            $this->jsonOutput($response,$response['status']);
        }
        $this->db->trans_complete();
        if($this->db->trans_status()){
            if($this->db->affected_rows() > 0){
                if(is_array($request)){
                    if($this->db->insert_id()){
                        $request[$this->primerykey] = $this->db->insert_id();
                    }
                }
            }else{
            }
            return $request;
        }else{
            return null;
        }
        
    }
    
    public function delete($where_array = null,$or_where_array = null){
        if($where_array == null && $or_where_array == null){
            $response['status'] = self::HTTP_BAD_REQUEST;
            $response['message'] = 'invalid_input';
            $response['line'] = __LINE__;
            $response['function'] = __FUNCTION__;
            $response['controller'] = __CLASS__;
            $this->jsonOutput($response,$response['status']);
        }
        $this->db->trans_start();
        if($where_array){
            $this->db->where($where_array);
        }
        if($or_where_array){
            $this->db->group_start();
            $this->db->or_where($or_where_array);
            $this->db->group_end();
        }
        $this->db->delete($this->table);
        $this->db->trans_complete();
        if($this->db->trans_status()){
            if($this->db->affected_rows() > 0){
                return true;
            }else{
            }
            return true;
        }else{
            return null;
        }
    }
    
    public function saveRequest($data = null){
//        $this->dd($data);
        if(isset($data['request_data']) && $data['request_data'] != null){
            $result = $this->AipRequests_tbl->save($data);
            if(!$result){
//                $data['timestemp'] = date('Y/m/d H:i:s');
//                log_message('info', 'Request Hit Not Saved for data \n'.json_encode($data));
                log_message('error', sprintf('%s : %s : DB transaction failed. Error no: %s, Error msg:%s, Last query: %s', __CLASS__, __FUNCTION__, $e->getCode(), $e->getMessage(), print_r($this->AipRequests_tbl->last_query(), TRUE)));
            }
            return;
        }
        
    }
    
    public function getUserId(){
        return $this->user_id;
    }
    
    public function getUserRoleId(){
        return $this->role_id;
    }
    
    public function getUserExpiry(){
        return $this->expiry;
    }
    
    public function getUserExpiryMillies(){
        return $this->expiry_millies;
    }
    
    public function getUserIsDeleted(){
        return $this->is_deleted;
    }
    
    public function getUserIsEmailVerified(){
        return $this->is_email_verified;
    }
    
    public function getUserIsPhoneVerified(){
        return $this->is_phone_verified;
    }
    
    public function getUserIsAdminVerified(){
        return $this->is_admin_verified;
    }
    
    public function getUserIsBan(){
        return $this->is_ban;
    }
    
    public function getUserIsActive(){
        return $this->is_active;
    }
    
    public function setUserData($data){
        $this->user_id = $data['user_id'];
        $this->role_id = $data['role_id'];
        $this->expiry = $data['expiry'];
        $this->expiry_millies = $data['expiry_millies'];
        $this->is_active = $data['is_active'];
        $this->is_deleted = $data['is_deleted'];
        $this->is_ban = $data['is_ban'];
        $this->is_email_verified = $data['is_email_verified'];
        $this->is_phone_verified = $data['is_phone_verified'];
        $this->is_admin_verified = $data['is_admin_verified'];
    }
}