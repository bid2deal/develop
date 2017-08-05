<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class UserAuthVirtual_tbl extends Base_Model{
    
    public $table = 'user_auth_virtual';
    public $primerykey = 'guest_id';
    public $select = 'guest_id,role_id,email,phone,username,pass';
}
