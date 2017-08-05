<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Seller_model extends Base_Model{
    function __construct(){
        parent::__construct();
        $this->load->model('SellerMaster_tbl');
        $this->load->library('image');
    }
    
    public function updateSeller($request){
        $image_array['save_directory'] = $this->getUploadFilePath().'seller_doc/';
        if(isset($request['company_registration_doc'])){
            $image_array['base64'] = $request['company_registration_doc'];
            $image_array['mime'] = $request['company_registration_doc_mime'];
            $image_status = $this->image->uploadImage($image_array);
            if(!$image_status){
                $response['status'] = self::HTTP_BAD_REQUEST;
                $response['message'] = 'Transection Fail';
                $response['debug_message'] = 'Saved Image Not Exist';
                $this->jsonOutput($response,$response['status']);
            }else{
                $request['company_registration_doc'] = $image_status;
                unset($request['company_registration_doc_mime']);
            }
        }
        if(isset($request['gst_registration_doc'])){
            $image_array['base64'] = $request['gst_registration_doc'];
            $image_array['mime'] = $request['gst_registration_doc_mime'];
            $image_status = $this->image->uploadImage($image_array);
            if(!$image_status){
                $response['status'] = self::HTTP_BAD_REQUEST;
                $response['message'] = 'Transection Fail';
                $response['debug_message'] = 'Saved Image Not Exist';
                $this->jsonOutput($response,$response['status']);
            }else{
                $request['gst_registration_doc'] = $image_status;
                unset($request['gst_registration_doc_mime']);
            }
        }
        if(isset($request['license_doc'])){
            $image_array['base64'] = $request['license_doc'];
            $image_array['mime'] = $request['license_doc_mime'];
            $image_status = $this->image->uploadImage($image_array);
            if(!$image_status){
                $response['status'] = self::HTTP_BAD_REQUEST;
                $response['message'] = 'Transection Fail';
                $response['debug_message'] = 'Saved Image Not Exist';
                $this->jsonOutput($response,$response['status']);
            }else{
                $request['license_doc'] = $image_status;
                unset($request['license_doc_mime']);
            }
        }
        if($this->SellerMaster_tbl->save($request)){
            $response['status'] = self::HTTP_OK;
            $response['message'] = 'Seller Saved Successfully';
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
