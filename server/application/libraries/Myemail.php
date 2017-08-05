<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Myemail extends Base_Model{
    private $myemail = 'myecommercial@gmail.com';
    private $mypass = 'Eco@2020';
    public function __construct($params = array()){
        parent::__construct();
//        $this->CI =& get_instance();
//        $this->CI->load->helper('file');
//        $this->CI->load->helper('url');
//        $this->CI->config->item('base_url');
        $this->load->helper('file');
        $this->load->helper('url');
        $this->config->item('base_url');
    }
    public function validate($data){
        $this->form_validation->set_rules('to', 'to', 'trim|required|valid_emails');
        $this->form_validation->set_rules('cc', 'cc', 'trim|valid_emails');
        $this->form_validation->set_rules('bcc', 'bcc', 'trim|valid_emails');
        $this->form_validation->set_rules('message', 'message', 'trim|required');
        $this->form_validation->set_rules('subject', 'subject', 'trim');
        $this->form_validation->set_rules('attachments', 'attachments', 'trim');
        $this->form_validation->set_data($data);
        
        if ($this->form_validation->run() == FALSE) {
            $response['status'] = self::ERR_VALIDATION_FAILED;
            $response['message'] = 'Transection Fail';
            $response['errors'] = $this->form_validation->error_array();
            $response['line'] = __LINE__;
            $response['function'] = __FUNCTION__;
            $response['controller'] = __CLASS__;
            $this->jsonOtput($response,$response['status']);
        }else{
            return 1;
        }
    }
    
    public function config(){
        $config = array(        
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_port' => 465,
            'smtp_user' => $this->myemail,
            'smtp_pass' => $this->mypass,
            'smtp_timeout' => '4',
            'mailtype'  => 'html', 
            'charset'   => 'iso-8859-1'
        );
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
    }
    
    public function sendmail($request){
        $validation = $this->validate($request);
        if($validation){
            $this->config();
            return $this->send($request);
        }
    }
    
    public function send($request){
        $this->email->from($this->myemail,'Admin');
        $this->email->to($request['to']);
        $this->email->subject(isset($request['subject']) ? $request['subject'] : ''); 
        if(isset($request['cc']) && $request['cc']){
            $this->email->cc($request['cc']); // replace it with CC 
        }
        if(isset($request['bcc']) && $request['bcc']){
            $this->email->bcc($request['bcc']); // replace it with BCC 
        }
        if(isset($data['attachments'])){
            if(is_array($var)){
                foreach ($request['attachments'] as $att) {
                    $this->email->attach($att);
                }
            }else{
                $this->email->attach($request['attachments']);
            }
        }
        $body = $request['message'];
        $this->email->message($body);
        if($this->email->send()){
            return true;
        }else{
            return false;
        }
    }
    
    
    
//    public function sendEmail($data){
//        $Req_Status = $this->ValidateRequest($data);
//        if($Req_Status){
//            $Init_Status = $this->initEmail(isset($data['Sender_ID'])?$data['Sender_ID']:'Bhavikgovindia@gmail.com',
//                                            isset($data['Sender_Pass'])?$data['Sender_Pass']:'Dasnadas@45',
//                                            isset($data['Sender_Name'])?$data['Sender_Name']:'Bhavik S. Govindia');
//            if($Init_Status != null){
//                $Email_Status = $this->sendmail($data);
//                if($Email_Status){
////                    $data['Sender_ID'] = $Init_Status['Sender_ID'];
////                    $data['Sender_Pass'] = $Init_Status['Sender_Pass'];
////                    $data['Sender_Name'] = $Init_Status['Sender_Name'];
////                    $this->saveEmailLog($data);
//                    return 1;
//                }else{
//                    return 0;
//                }
//            }   
//        }
//    }
    
    
//    function saveEmailLog($RData){
//        $str = $RData['Reciver_ID'].',';
//        $data = $RData;
//        unset($data['Sender_Pass']);
//        unset($data['Attachment']);
//        unset($data['Message']);
//        $this->CI->db->trans_start();
//        while($str != ""){
//            $R_ID = substr($str,0,strpos($str,","));
//            $str = str_replace($R_ID.',',"",$str);
//            $data['Reciver_ID'] = $R_ID;
//            $this->CI->db->insert('log_email', $data);
//        }
//        $this->CI->db->trans_complete();
////        if($this->CI->db->trans_status() == true){
////            $Data = array('status' => 200, 'msg' => 'Email log Saved Successfully');
////            $this->jsonOtput($Data);
////        }else{
////            $Data = array('status' => 400, 'msg' => 'Email log Update Fail');
////            $this->jsonOtput($Data);
////        }
//    }
    
}