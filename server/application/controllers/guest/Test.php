<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Test
 *
 * @author margosatree1
 */
class Test extends Guest {
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('Test_model');
        $this->load->library('bcrypt');
        $this->load->library('image');
    }
    
    public function rahul(){
        if ($this->bcrypt->check_password("Bhavik@123", '$2a$10$L2IYhGGQOJ6WSOeN.ew4F.favylh2wYorxPw8uM.L5H')){
            $this->clearFailAttempts($response[$this->primerykey]);
            return $response;
        }else{
            $this->updateFailAttempts($credentials['username']);
            return null;
        }
        
//        $this->dd((strtotime('+1 day')*1000) > $this->getCurrentMillies());
//        $post = $this->getPostInput();
//        $post['save_directory'] = $this->getUploadFilePath()."/product";
//        $this->image->uploadImage($post);
        
        
        
        
        
        
//        $this->dd(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM));
//        $plain_text = 'rrrrrrr';
//        $ciphertext = $this->encryption->encrypt($plain_text);
//        echo $ciphertext;
//        echo " <br>";
//        echo strlen($ciphertext);
//        // Outputs: This is a plain-text message!
//        echo $this->encryption->decrypt($ciphertext);
//        $this->dd();
//        echo " <br>";
//        $encryptSalt = $this->encrypt->encode("Bhavik", "Dasnadas");
//        echo $encryptSalt." ".  strlen($encryptSalt);
//        echo " <br>";
//        echo $this->encrypt->decode($encrypt);
//        echo " <br>";
//        echo $this->encrypt->decode($encryptSalt, "Dasnadas");
        $hash = $this->bcrypt->hash_password("Bhavik@123");
        echo $hash." ".  strlen($hash);
        echo " <br>";
        if ($this->bcrypt->check_password("Bhavik@123", $hash)){
            $this->dd('Match');
        }else{
            $this->dd(' Dose Note Match');
        }
//        $hash = $this->bcrypt->hash_password("Bhvaik");
//        echo $hash." ".  strlen($hash);
        $this->dd();
//
//        try {
//            $res = false;
//            if(!$res) throw new Exception('Errrrror', 369);
//        } catch (Exception $e) {
////            $this->dd($e);
//            log_message('error', sprintf('%s : %s : DB transaction failed. Error no: %s, Error msg:%s', __CLASS__, __FUNCTION__, $e->getCode(), $e->getMessage()));
//        }
        
//        $this->Test_model->register();
    }
    
    public function mail(){
        $post = $this->getPostInput();
        $status = $this->myemail->sendmail($post);
        if($status){
            echo 'Mail send';
        }else{
            echo 'Mail send fail';
        }
    }
    public function testSQL(){
//        $Post = $this->getPostInput();
//        $this->dd(round(microtime(true) * 1000));
//        $this->db->from('users_auth');
//        $this->db->where('user_id', 1);
//        $rows = $this->db->get()->result_array();
//        $output['status'] = self::HTTP_OK;
//        $output['msg'] = 'Sucess';
//        $output['data'] = $rows;
//        $output['u'] = $rows;
//        $this->jsonOutput($output);
        
        $password = 'hunter2';
        $hash = $this->bcrypt->hash_password($password);
        $this->dd($hash);
        if ($this->bcrypt->check_password($password, $hash)){
            $output['status'] = self::HTTP_OK;
            $output['msg'] = 'Validation Sucess';
        }else{
            $output['status'] = self::HTTP_BAD_REQUEST;
            $output['msg'] = 'Validation Error';
        }
        
        $this->jsonOutput($output);
    }
    
    public function getSQL(){
        $query = $this->db->get('test');
        $query->unbuffered_row('array');
        
        while ($row = $query->unbuffered_row()){
            echo $row->title;
            echo $row->name;
            echo $row->body;
        }
    }
}
