<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Base_Controller extends CI_Controller {
    //Configration Of Base_Controller
    public $debug = false;
    
    public $token_length = 32; //
    public $attempt_allowed = 10; //Change Variable As per Requirement
    
    
    //Hide Values Such As Password Email Id etc.
    private $hideBodyKey = [
        'Username','Password','CurrentPass','NewPass','confirm_NewPass'
    ];
    
    //=== ACL ===
    public $acl = true;
    
    //Role Id
    const SuperAdmin = 1;
    const Admin = 2;
    const Buyer = 3;
    const Seller = 4;
    //=== ACL ===
    
    
    
    const HTTP_CONTINUE = 100;
    const HTTP_SWITCHING_PROTOCOLS = 101;
    const HTTP_PROCESSING = 102;            // RFC2518

    // Success
    // The request has succeeded
    const HTTP_OK = 200;

    // The server successfully created a new resource
    const HTTP_CREATED = 201;
    const HTTP_ACCEPTED = 202;
    const HTTP_NON_AUTHORITATIVE_INFORMATION = 203;

    // The server successfully processed the request, though no content is returned
    const HTTP_NO_CONTENT = 204;
    const HTTP_RESET_CONTENT = 205;
    const HTTP_PARTIAL_CONTENT = 206;
    const HTTP_MULTI_STATUS = 207;          // RFC4918
    const HTTP_ALREADY_REPORTED = 208;      // RFC5842
    const HTTP_IM_USED = 226;               // RFC3229

    // Redirection
    const HTTP_MULTIPLE_CHOICES = 300;
    const HTTP_MOVED_PERMANENTLY = 301;
    const HTTP_FOUND = 302;
    const HTTP_SEE_OTHER = 303;

    // The resource has not been modified since the last request
    const HTTP_NOT_MODIFIED = 304;
    const HTTP_USE_PROXY = 305;
    const HTTP_RESERVED = 306;
    const HTTP_TEMPORARY_REDIRECT = 307;
    const HTTP_PERMANENTLY_REDIRECT = 308;  // RFC7238

    // Client Error

    // The request cannot be fulfilled due to multiple errors
    const HTTP_BAD_REQUEST = 400;

    // The user is unauthorized to access the requested resource
    const HTTP_UNAUTHORIZED = 401;
    const HTTP_PAYMENT_REQUIRED = 402;

    // The requested resource is unavailable at this present time
    const HTTP_FORBIDDEN = 403;

    // The requested resource could not be found
    // Note: This is sometimes used to mask if there was an UNAUTHORIZED (401) or
    // FORBIDDEN (403) error, for security reasons
    const HTTP_NOT_FOUND = 404;

    // The request method is not supported by the following resource
    const HTTP_METHOD_NOT_ALLOWED = 405;

    // The request was not acceptable
    const HTTP_NOT_ACCEPTABLE = 406;
    const HTTP_PROXY_AUTHENTICATION_REQUIRED = 407;
    const HTTP_REQUEST_TIMEOUT = 408;

    // The request could not be completed due to a conflict with the current state of the resource
    const HTTP_CONFLICT = 409;
    const HTTP_GONE = 410;
    const HTTP_LENGTH_REQUIRED = 411;
    const HTTP_PRECONDITION_FAILED = 412;
    const HTTP_REQUEST_ENTITY_TOO_LARGE = 413;
    const HTTP_REQUEST_URI_TOO_LONG = 414;
    const HTTP_UNSUPPORTED_MEDIA_TYPE = 415;
    const HTTP_REQUESTED_RANGE_NOT_SATISFIABLE = 416;
    const HTTP_EXPECTATION_FAILED = 417;
    const HTTP_I_AM_A_TEAPOT = 418;                                               // RFC2324
    const HTTP_UNPROCESSABLE_ENTITY = 422;                                        // RFC4918
    const HTTP_LOCKED = 423;                                                      // RFC4918
    const HTTP_FAILED_DEPENDENCY = 424;                                           // RFC4918
    const HTTP_RESERVED_FOR_WEBDAV_ADVANCED_COLLECTIONS_EXPIRED_PROPOSAL = 425;   // RFC2817
    const HTTP_UPGRADE_REQUIRED = 426;                                            // RFC2817
    const HTTP_PRECONDITION_REQUIRED = 428;                                       // RFC6585
    const HTTP_TOO_MANY_REQUESTS = 429;                                           // RFC6585
    const HTTP_REQUEST_HEADER_FIELDS_TOO_LARGE = 431;                             // RFC6585
    
    public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Kolkata');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url', 'download'));
        $this->RequestHandler();
    }
        
    public function getToken(){
        return $this->input->server('HTTP_TOKEN');
    }

    public function dd($data = null){
        if(is_array($data)){
            header("Content-Type: application/json");
            echo json_encode($data);
        }elseif(is_object($data)){
            var_dump($data);
        }elseif($data){
            echo $data;
        }
        die();
    }
    
    public function getUploadFilePath(){
        return FCPATH.'upload\\';
    }
    
    public function getCurrentTimeStemp(){
        return date("Y-m-d H:i:s");
    }
    
    public function getCurrentMillies(){
        return round(microtime(true) * 1000);
    }
    
    public function validateEnum($value,$table,$column){
        
    }
    
    public function validateDependentKeys($keys_array,$array_data){
        if(is_array($keys_array)){
            foreach ($keys_array as $key => $value) {
                foreach (explode(",",$value) as $k => $v) {
                    if(isset($array_data[$v]) && $array_data[$v]){
                    }else{
                        $response['status'] = self::HTTP_BAD_REQUEST;
                        $response['message'] = 'Dependent Keys Required ('.$value.')';
                        $response['line'] = __LINE__;
                        $response['function'] = __FUNCTION__;
                        $response['controller'] = __CLASS__;
                        $this->jsonOutput($response,$response['status']);
                    }
                }
            }
        }else{
            foreach (explode(",",$keys_array) as $k => $v) {
                if(isset($array_data[$v]) && $array_data[$v]){
                }else{
                    $response['status'] = self::HTTP_BAD_REQUEST;
                    $response['message'] = 'Dependent Keys Required ('.$keys_array.')';
                    $response['line'] = __LINE__;
                    $response['function'] = __FUNCTION__;
                    $response['controller'] = __CLASS__;
                    $this->jsonOutput($response,$response['status']);
                }
            }
        }
    }
    
    public function getPostInput(){
        return json_decode(file_get_contents('php://input'),true);
    }
    
    public function jsonOutput($data,$status){
        if(!$this->debug){
            if(isset($data['debug_message'])){
                unset($data['debug_message']);
            }
            if(isset($data['line'])){
                unset($data['line']);
            }
            if(isset($data['function'])){
                unset($data['function']);
            }
            if(isset($data['controller'])){
                unset($data['controller']);
            }
        }
        $this->output->set_status_header($status);
        header("Content-Type: application/json");
        print preg_replace("/null/","0",json_encode($data));
        die();
    }
    
    public function RandomString($length,$type = null,$forRole = null){
        if($type == "A"){
            $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        }else if($type == "N"){
            $characters = '0123456789';
        }else{
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        }
        $randstring = '';
        if($forRole == 1){
            $length = $length - 3;
        }else if($forRole == 2){
            $length = $length - 2;
        }else if($forRole == 3){
            $length = $length - 2;
        }else if($forRole == 4){
            $length = $length - 2;
        }
        for ($i = 0; $i < $length; $i++) {
            $randstring = $randstring.$characters[rand(0, strlen($characters)-1)];
        }
        if($forRole == 1){
            $randstring = $randstring. 'rSA';//For Super Admin
        }else if($forRole == 2){
            $randstring = $randstring. 'rA';//For Admin
        }else if($forRole == 3){
            $randstring = $randstring. 'rB';//For Buyer
        }else if($forRole == 4){
            $randstring = $randstring. 'rS';//For Seller
        }
        return $randstring;
    }
    
    public function DateDiff($start_date,$end_date,$returnType = null){
        $start_date = new DateTime($start_date);
        $end_date = new DateTime($end_date);
        if($start_date && $end_date){
            $diff = $start_date->diff($end_date);
            if($returnType == "y"){ return $diff->y; }
            elseif($returnType == "m"){ return $diff->m; }
            elseif($returnType == "d"){ return $diff->d; }
            elseif($returnType == "h"){ return $diff->h; }
            elseif($returnType == "i"){ return $diff->i; }
            elseif($returnType == "s"){ return $diff->s; }
            else{
                return array(   'y'=>$diff->y,  'm'=>$diff->m,  'd'=>$diff->d,  'h'=>$diff->h,  'i'=>$diff->i,
                                's'=>$diff->s,  'str' => $diff->y.' Year '.$diff->m.' Month '.$diff->d.' Day '.$diff->h.' Hours '.$diff->i.' Minutes '.$diff->s.' Seconds',
                );
            }
        }else{
            $msg;
            if(checkdate($start_date)){ $msg = 'Start Date'; }
            if(checkdate($end_date)){ ($msg) ? $msg.' And End Date' : $msg = 'End Date'; }
            $response['status'] = self::HTTP_BAD_REQUEST;
            $response['message'] = "Invalid ".$msg;
            $response['line'] = __LINE__;
            $response['function'] = __FUNCTION__;
            $response['controller'] = __CLASS__;
            $this->jsonOutput($response,$response['status']);
        }
    }
    
    public function RequestHandler(){
        $this->load->model('Base_Model');
        $blob = array();
        if($this->input->server('HTTP_ORIGIN')){ 
            $blob['HTTP_ORIGIN'] = $this->input->server('HTTP_ORIGIN'); 
        }
        if($this->input->server('HTTP_USER_AGENT')){ 
            $blob['HTTP_USER_AGENT'] = $this->input->server('HTTP_USER_AGENT'); 
            $data['os'] = $this->getOS($this->input->server('HTTP_USER_AGENT'));
            $data['browser'] = $this->getBrowser($this->input->server('HTTP_USER_AGENT'));
        }
        if($this->input->server('HTTP_TOKEN')){
            $blob['HTTP_TOKEN'] = $this->input->server('HTTP_TOKEN');
            $data['user_token'] = $this->input->server('HTTP_TOKEN');
            $this->load->model('UserAuth_tbl');
            if(strlen($this->input->server('HTTP_TOKEN')) == $this->token_length){
                $user_id = $this->UserAuth_tbl->getWhereQuery('user_id',['token' => $this->input->server('HTTP_TOKEN')]);
                if($user_id){
                    $data['user_id'] = $user_id[0]['user_id'];
                }
            }
        }
        if($this->input->server('CONTENT_TYPE')){
            $blob['CONTENT_TYPE'] = $this->input->server('CONTENT_TYPE'); 
        }
        if($this->input->server('REQUEST_SCHEME')){ 
            $blob['REQUEST_SCHEME'] = $this->input->server('REQUEST_SCHEME'); 
        }
        if($this->input->server('SERVER_PROTOCOL')){ 
            $blob['SERVER_PROTOCOL'] = $this->input->server('SERVER_PROTOCOL'); 
        }
        if($this->input->server('REQUEST_METHOD')){ 
            $blob['REQUEST_METHOD'] = $this->input->server('REQUEST_METHOD'); 
            $data['request_method'] = $this->input->server('REQUEST_METHOD');
        }
        if($this->input->server('QUERY_STRING')){ 
            $blob['QUERY_STRING'] = $this->input->server('QUERY_STRING'); 
        }
        if($this->input->server('REQUEST_URI')){ 
            $blob['REQUEST_URI'] = $this->input->server('REQUEST_URI'); 
            $data['request_uri'] = $this->input->server('REQUEST_URI'); 
        }
        if($this->input->server('REQUEST_URI')){ 
            $blob['REQUEST_URI'] = $this->input->server('REQUEST_URI'); 
            $data['request_uri'] = $this->input->server('REQUEST_URI'); 
        }
        if($this->input->server('SERVER_ADDR')){ 
            $data['server_addr'] = $this->input->server('SERVER_ADDR'); 
        }
        if($this->input->server('REMOTE_ADDR')){ 
            $data['remote_addr'] = $this->input->server('REMOTE_ADDR'); 
        }
        $body = $this->getPostInput();
        if($body){
            foreach ($this->hideBodyKey as $key) {
                if(isset($body[$key])){$body[$key] = "XXXXX";}
            }
            $data['body_parems'] = json_encode($body); 
        }
        $data['mac'] = $this->getMacAddress();
        $data['request_data'] = json_encode($blob);
        $this->Base_Model->saveRequest($data);
    }
    
    private function getMacAddress() { 
        ob_start(); // Turn on output buffering
        system('ipconfig /all'); //Execute external program to display output
        $mycom = ob_get_contents(); // Capture the output into a variable
        ob_clean(); // Clean (erase) the output buffer
        $findme = "Physical";
        $pmac = strpos($mycom, $findme); // Find the position of Physical text
        $mac = substr($mycom,($pmac+36),17); // Get Physical Address
        return $mac;
    }
    
    private function getOS($user_agent) { 
        $os_platform = "N/A";
        $os_array = array(
            '/windows nt 10/i'      =>  'Windows 10',
            '/windows nt 6.3/i'     =>  'Windows 8.1',
            '/windows nt 6.2/i'     =>  'Windows 8',
            '/windows nt 6.1/i'     =>  'Windows 7',
            '/windows nt 6.0/i'     =>  'Windows Vista',
            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
            '/windows nt 5.1/i'     =>  'Windows XP',
            '/windows xp/i'         =>  'Windows XP',
            '/windows nt 5.0/i'     =>  'Windows 2000',
            '/windows me/i'         =>  'Windows ME',
            '/win98/i'              =>  'Windows 98',
            '/win95/i'              =>  'Windows 95',
            '/win16/i'              =>  'Windows 3.11',
            '/macintosh|mac os x/i' =>  'Mac OS X',
            '/mac_powerpc/i'        =>  'Mac OS 9',
            '/linux/i'              =>  'Linux',
            '/ubuntu/i'             =>  'Ubuntu',
            '/iphone/i'             =>  'iPhone',
            '/ipod/i'               =>  'iPod',
            '/ipad/i'               =>  'iPad',
            '/android/i'            =>  'Android',
            '/blackberry/i'         =>  'BlackBerry',
            '/webos/i'              =>  'Mobile'
        );
        foreach ($os_array as $regex => $value) { 
            if (preg_match($regex, $user_agent)) {
                $os_platform = $value;
            }
        }   
        return $os_platform;
    }
    
    private function getBrowser($user_agent) { 
        $browser_platform = "N/A";
        $browser_array = array(
            '/msie/i'       =>  'Internet Explorer',
            '/firefox/i'    =>  'Firefox',
            '/safari/i'     =>  'Safari',
            '/chrome/i'     =>  'Chrome',
            '/edge/i'       =>  'Edge',
            '/opera/i'      =>  'Opera',
            '/netscape/i'   =>  'Netscape',
            '/maxthon/i'    =>  'Maxthon',
            '/konqueror/i'  =>  'Konqueror',
            '/mobile/i'     =>  'Handheld Browser'
        );
        foreach ($browser_array as $regex => $value) { 
            if (preg_match($regex, $user_agent)) {
                $browser_platform = $value;
            }
        }   
        return $browser_platform;
    }
    
}

class Guest extends Base_Controller{
    public function __construct() {
        parent::__construct();
    }
    
} 

class Auth extends Base_Controller{
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
    private $CurrentUserData = null;

    
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->ValidateUserToken();
        $this->is_Accessible($this->router->class,$this->router->method);
    }
    
    public function is_date($date){
        if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)){
            return true;
        }else{
            $this->form_validation->set_message('is_date', 
               'The %s is not valid date');
            return false;
        }
    }
    
    Private function ValidateUserToken(){
        $token = $this->getToken();
        if(isset($token) && strlen($token) == $this->token_length){
            $result = $this->Auth_model->validateUserToken($token);
            if($result['status'] == 200){
                $this->user_id = $result['user_id'];
                $this->role_id = $result['role_id'];
                $this->expiry = $result['expiry'];
                $this->expiry_millies = $result['expiry_millies'];
                $this->is_active = $result['is_active'];
                $this->is_deleted = $result['is_deleted'];
                $this->is_ban = $result['is_ban'];
                $this->is_email_verified = $result['is_email_verified'];
                $this->is_phone_verified = $result['is_phone_verified'];
                $this->is_admin_verified = $result['is_admin_verified'];
                unset($result['status']);
                $this->CurrentUserData = $result;
            }else{
                $response['status'] = $result['status'];
                $response['message'] = "Token Missmatch";
                $response['line'] = __LINE__;
                $response['function'] = __FUNCTION__;
                $response['controller'] = __CLASS__;
                $this->jsonOutput($response,$response['status']);
            }
        }else{
            $response['status'] = self::HTTP_BAD_REQUEST;
            $response['message'] = "Invalid Token";
            $response['line'] = __LINE__;
            $response['function'] = __FUNCTION__;
            $response['controller'] = __CLASS__;
            $this->jsonOutput($response,$response['status']);
        }
    }
    
    private function is_Accessible($class = null,$method = null) {
        if(!$this->acl){
            return;
        }
        $Controllers = array(
            'Buyer' => array(
                'addBuyer' => array(self::Buyer),
                'editBuyer' => array(self::Buyer),
            ),
            'Seller' => array(
                'addSeller' => array(self::Seller),
                'editSeller' => array(self::Seller),
            ),
            'Reset' => array(
                'resetPassword' => array(self::Seller,self::Buyer),
            ),
        );
        if(isset($Controllers[$class][$method])){
            foreach ($Controllers[$class][$method] as $role) {
                if($this->getUserRoleId() == $role){
                    return;
                }
            }
        }else{
            $response['status'] = self::HTTP_METHOD_NOT_ALLOWED;
            $response['message'] = "Access Controle Not Define";
            $response['line'] = __LINE__;
            $response['function'] = __FUNCTION__;
            $response['controller'] = __CLASS__;
            $this->jsonOutput($response,$response['status']);
        }
        $response['status'] = self::HTTP_METHOD_NOT_ALLOWED;
        $response['message'] = "You Are Not Allow To Access This Feature";
        $response['line'] = __LINE__;
        $response['function'] = __FUNCTION__;
        $response['controller'] = __CLASS__;
        $this->jsonOutput($response,$response['status']);
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
    
    public function getCurrentUserArray(){
        return $this->CurrentUserData;
    }
    
} 
