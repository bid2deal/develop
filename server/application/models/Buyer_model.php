<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Buyer_model extends Base_Model{
    function __construct(){
        parent::__construct();
        $this->load->model('BuyerMaster_tbl');
        $this->load->library('image');
    }
    
    public function updateBuyer($request){
        $buyer_status = $this->BuyerMaster_tbl->save($request);
        if($buyer_status){
            $response['status'] = self::HTTP_OK;
            $response['message'] = 'Buyer Saved Successfully';
        }else{
            $response['status'] = self::HTTP_BAD_REQUEST;
            $response['message'] = 'Transection Fail';
            $response['line'] = __LINE__;
            $response['function'] = __FUNCTION__;
            $response['controller'] = __CLASS__;
        }
        $this->jsonOutput($response,$response['status']);
    }
}
