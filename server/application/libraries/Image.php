<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Image extends Base_Model{
    private $image_mime_list = 'JPG,JPEG,PNG,jpg,jpeg,png';
    public function __construct(){
        parent::__construct();
        $this->load->helper('file');
        $this->load->helper('url');
        $this->config->item('base_url');
    }
    public function uploadImage($image_request){
        $this->form_validation->set_rules('base64', 'Base64', 'trim|required|valid_base64');
        $this->form_validation->set_rules('mime', 'Mime', 'trim|required|in_list['.$this->image_mime_list.']');
        $this->form_validation->set_rules('save_directory', 'Save Directory', 'trim|required');
        $this->form_validation->set_data($image_request);
        if ($this->form_validation->run()) {
            if (is_dir($image_request['save_directory'])) {
                if($image_request['save_directory'])
                $filename = $this->RandomString(64).'.'.$image_request['mime'];
                $image_date = base64_decode($image_request['base64']);
                file_put_contents($image_request['save_directory']. $filename, $image_date);
                if(file_exists($image_request['save_directory']. $filename)){
                    return $filename;
                }else{
                    return null;
                }
            }else{
                $response['status'] = self::HTTP_BAD_REQUEST;
                $response['message'] = 'Transection Fail';
                $response['debug_message'] = 'Save Directory Not Exist';
             }
        }else{
            $response['status'] = self::HTTP_BAD_REQUEST;
            $response['message'] = 'Transection Fail';
            $response['debug_message'] = 'Error While Uploading Image';
            $response['errors'] = $this->form_validation->error_array();
        }
        $this->jsonOutput($response,$response['status']);
    }
}