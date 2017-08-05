<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AipRequests_tbl extends Base_Model{
    //Do Not Declare Or Alter $table, $primerykey, $selcet it is use in Base_model
    public $table = 'aip_requests';
    public $primerykey = 'id';
    
    public function save($request){
        if(is_array($request)){
            if(isset($request[$this->primerykey]) && ($request[$this->primerykey] > 0 || $request[$this->primerykey])){
                $this->db->where($this->primerykey,$request[$this->primerykey]);
                $this->db->update($this->table, $request);
            }else{
                $this->db->insert($this->table, $request);
            }
        }else{
            $response['status'] = self::HTTP_BAD_REQUEST;
            $response['message'] = 'invalid_input';
            $response['line'] = __LINE__;
            $response['function'] = __FUNCTION__;
            $response['controller'] = __CLASS__;
            $this->jsonOutput($response,$response['status']);
        }
        if($this->db->affected_rows() > 0){
            if(is_array($request)){
                if($this->db->insert_id()){
                    $request[$this->primerykey] = $this->db->insert_id();
                    
                }
            }
            return $request;
        }else{
            return null;
        }
    }
    
}
