<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * ZBV2OA
 *
 * 一款基于CodeIgniter框架的开源轻型办公系统.
 *
 * @package     ZBV2OA
 * @author      Binarx
 * @copyright   Copyright (c) 2012, Binarx.
 * @link        http://www.zbv2.com
 * @since       Version 1.0
 */
// ------------------------------------------------------------------------

/**
 * ZBV2OA 用户登录/退出控制器
 * @author      Binarx
 */
class Index extends CI_Controller {

    /**
     * 构造函数
     *
     * @access  public
     * @return  void
     */
    function __construct() {
        parent::__construct();
        $this->load->model(array('user_m'));
        $this->load->library('form_validation');
    }

    // ------------------------------------------------------------------------
    /**
     * 默认入口
     *
     * @access  public
     * @return  void
     */
    function index() {
        if ($this->session->userdata('user_id')) {
            redirect('/ss/home');
        } else {
            $data['cookie_username'] = $this->input->cookie('zbv2_username');
            $this->load->view('system/login_v', $data);
        }
    }
    
    function test() {
        $this->load->view('system/test');
        
    }

    // ------------------------------------------------------------------------

    /**
     * 生成验证码
     *
     * @access  public
     * @return  void
     */
    function verfication_code() {
        $this->load->helper('captcha');
        $this->load->helper('string');
        $vals = array(
            'word' => random_string('alnum', 4),
            'img_width' => 75,
            'img_height' => 24,
            'img_path' => './public/captcha/',
            'img_url' => base_url() . 'public/captcha/',
            'expiration' => 300
        );
        $cap = create_captcha($vals);
        $data = array(
            'captcha_time' => $cap['time'],
            'ip_address' => $this->input->ip_address(),
            'word' => strtolower($cap['word'])
        );
        $query = $this->db->insert_string('zb_captcha', $data);
        $this->db->query($query);
        header("Cache-Control: no-cache, must-revalidate");
        header("Content-type:image/jpeg");
        readfile($cap['src']);
    }

    // ------------------------------------------------------------------------

    /**
     * 验证验证码
     *
     * @access  public
     * @return  void
     */
    function check_verfication_code($code, $ip) {
        $expiration = time() - 300; // 5分钟限制
        $this->db->query("DELETE FROM zb_captcha WHERE captcha_time < " . $expiration);
        // 然后再看是否有验证码存在:
        $sql = "SELECT COUNT(*) AS count FROM zb_captcha WHERE word = '$code' AND ip_address = '$ip' AND captcha_time > '$expiration'";
        $query = $this->db->query($sql);
        $row = $query->row();
        if ($row->count == 0) {
            return 0;
        } else {
            return 1;
        }
    }

    // ------------------------------------------------------------------------

    /**
     * 退出
     *
     * @access  public
     * @return  void
     */
    function quit() {
        $this->session->sess_destroy();
        redirect('/');
    }

    // ------------------------------------------------------------------------
    /**
     * 登录检测
     *
     * @access  public
     * @return  void
     */
    function checklogin() {
        $this->form_validation->set_rules('username', '用户名', 'trim|required');
        $this->form_validation->set_rules('password', '密码', 'required|min_length[6]');
        $this->form_validation->set_rules('code', '验证码', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $username = $this->input->post('username',TRUE);
            $user = $this->user_m->get_full_user_by_username($username);
            $code = strtolower($this->input->post('code',TRUE));
            $ip = $this->input->ip_address();
            $is_code = $this->check_verfication_code($code, $ip);
            $password = sha1($this->input->post('password',TRUE) . $user->salt);
            if ($is_code) {
                if ($user) {
                    if ($user->password == $password) {
                        if ($user->is_leave == 0 && $user->is_admin == 1) {
                            $cookie_username = array(
                                'name' => 'username',
                                'value' => $username,
                                'expire' => '2592000',
                                'prefix' => 'zbv2_'
                            );
                            $this->input->set_cookie($cookie_username);
                            $this->session->set_userdata('user_id', $user->user_id);
                            redirect('/ss/home');
                        } else {
                            $this->session->set_flashdata('error', "此账号已冻结或者员工已离职,请联系管理员!");
                        }
                    } else {
                        $this->session->set_flashdata('error', "密码不正确!");
                    }
                } else {
                    $this->session->set_flashdata('error', "不存在的用户!");
                }
            } else {
                $this->session->set_flashdata('error', "验证码错误!");
            }
            redirect('/');
        }
    }

}

/* End of file index.php */
/* Location: ./application/controllers/index.php */