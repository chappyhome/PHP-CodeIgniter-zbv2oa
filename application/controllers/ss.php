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
 * ZBV2OA 系统相关控制器
 * @author      Binarx
 */
class Ss extends Admin_Controller {

    /**
     * 构造函数
     *
     * @access  public
     * @return  void
     */
    public function __construct() {
        parent::__construct();
        $this->_check_permit();
        $this->load->model('cache_m');
    }

// ------------------------------------------------------------------------

    /**
     * 后台默认首页
     *
     * @access  public
     * @return  void
     */
    public function home() {
        $this->_template('default_v');
    }

// ------------------------------------------------------------------------

    /**
     * 用户修改密码表单页入口
     *
     * @access  public
     * @return  void
     */
    public function password() {
        $this->_password_post();
    }

// ------------------------------------------------------------------------

    /**
     * 用户修改密码表单页呈现/处理函数 
     *
     * @access  public
     * @return  void
     */
    public function _password_post() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('old_pass', "旧密码", 'required');
        $this->form_validation->set_rules('new_pass', "新密码", 'required|min_length[6]|max_length[16]|match[new_pass_confirm]');
        $this->form_validation->set_rules('new_pass_confirm', "确认新密码", 'required|min_length[6]|max_length[16]');
        if ($this->form_validation->run() == FALSE) {
            $this->_template('sys_password');
        } else {
            $old_pass = sha1(trim($this->input->post('old_pass', TRUE)) . $this->_admin->salt);
            $stored = $this->user_mdl->get_user_by_uid($this->session->userdata('uid'));
            if ($stored AND $old_pass == $stored->password) {
                $this->user_mdl->update_user_password();
                $this->_message("密码更新成功!", '', TRUE);
            } else {
                $this->_message("密码验证失败!", '', TRUE);
            }
        }
    }

// ------------------------------------------------------------------------
}

/* End of file ss.php */
/* Location: ./admin/controllers/ss.php */