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
            $data['cookie_password'] = $this->input->cookie('zbv2_password');
            $data['isremeber'] = $data['cookie_password'] ? 1 : 0;
            $this->load->view('login_v', $data);
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
        $this->form_validation->set_rules('isremeber', 'cookie判断', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $username = $this->input->post('username');
            $user = $this->user_m->get_full_user_by_username($username); 
            $remeber = (BOOL) $this->input->post('remeber');
            $isremeber = (BOOL) $this->input->post('isremeber');
            $password = ($isremeber&&$username==$this->input->cookie('zbv2_username'))?$this->input->post('password'):sha1($this->input->post('password').$user->salt);
            if ($user) {
                if ($user->password == $password) {
                    if ($user->is_leave == 0&&$user->is_admin == 1) {
                        if ($remeber == 1) {
                            $cookie_username = array(
                                'name' => 'username',
                                'value' => $username,
                                'expire' => '2592000',
                                'prefix' => 'zbv2_'
                            );
                            $cookie_password = array(
                                'name' => 'password',
                                'value' => $password,
                                'expire' => '2592000',
                                'prefix' => 'zbv2_'
                            );
                            $this->input->set_cookie($cookie_username);
                            $this->input->set_cookie($cookie_password);
                        }
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
            redirect('/');
        }
    }

}

/* End of file index.php */
/* Location: ./application/controllers/index.php */