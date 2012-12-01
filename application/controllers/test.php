<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Test extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('cache_m');
        $this->load->helper('file');
    }

    function index($user_id = 1) {
        $this->cache_m->update_role_cache($user_id);
    }

    function acl() {
        $this->load->library('acl');
        var_dump($this->acl->_menus);
//        $this->acl->_current_level_1();
    }

    function json() {
        $arr = read_file("./application/date/menu_1.php");
        var_dump(json_decode($arr, TRUE));
    }

    function arr() {
        $fruit1 = array();
        for($i=1;$i<=3;$i++){
            $fruit1[]['no'] = $i;
            $fruit1[]['string'] = $i.$i.$i;
        }
        print_r($fruit1);
    }

    function data(){
        $data2 = "2012-09-14";
        $data1 = date('Y-m-d');
        echo $data1<$data2?1:0;
    }

}
