<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class UserRole_tbl extends Base_Model{
    
    public $table = 'user_role';
    public $primerykey = 'role_id';
    
    
    
    public function getRoleString(){
        $roles = $this->getWhereQuery('prifix_long','role_id > 2');
        $role_str = '';
        foreach ($roles as $role) {
            if($role['prifix_long']){
                $role_str .= $role['prifix_long'].",";
            }else{
                $response['status'] = self::HTTP_BAD_REQUEST;
                $response['message'] = 'invalid_input';
                $response['line'] = __LINE__;
                $response['function'] = __FUNCTION__;
                $response['controller'] = __CLASS__;
                $this->jsonOutput($response,$response['status']);
            }
        }
        return substr($role_str, 0, strlen($role_str) - 1);
    }
}
