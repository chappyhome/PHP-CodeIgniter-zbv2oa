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
        for ($i = 1; $i <= 3; $i++) {
            $fruit1[]['no'] = $i;
            $fruit1[]['string'] = $i . $i . $i;
        }
        print_r($fruit1);
    }

    function data() {
        echo date('Y-m-d H:i:s');
    }

    function cap() {
        $this->load->helper('captcha');
        $this->load->helper('string');

        $vals = array(
            'word' => random_string('alnum', 4),
            'img_width' => '80',
            'img_height' => '24',
            'img_path' => './captcha/',
            'img_url' => base_url().'captcha/',
            'expiration' => 120
        );

        $cap = create_captcha($vals);

        $data = array(
            'captcha_time' => $cap['time'],
            'ip_address' => $this->input->ip_address(),
            'word' => $cap['word']
        );

        $query = $this->db->insert_string('zb_captcha', $data);
        $this->db->query($query);

        echo '提交下面的验证码:';
        echo $cap['image'];
        echo '<input type="text" name="captcha" value="" />';
    }

}
