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
define('SYS_VERSION', "v1.0");

/**
 * ZBV2OA 后台控制器基类
 * @author      Binarx
 */
abstract class Admin_Controller extends CI_Controller {

    /**
     * _admin
     * 保存当前登录用户的信息
     *
     * @var object
     * @access  public
     * */
    public $_admin = NULL;

    /**
     * 构造函数
     *
     * @access  public
     * @return  void
     */
    public function __construct() {
        parent::__construct();
        $this->load->model(array('user_m'));
        $this->_check_login();
        $this->load->library('acl');
    }

    // ------------------------------------------------------------------------

    /**
     * 检查用户是否登录
     *
     * @access  protected
     * @return  void
     */
    protected function _check_login() {
        if (!$this->session->userdata('user_id')) {
            redirect('/');
        } else {
            $this->_admin = $this->user_m->get_full_user_by_username($this->session->userdata('user_id'), 'uid');
            if ($this->_admin->is_admin != 1) {
                $this->session->set_flashdata('error', "此帐号已被冻结,请联系管理员!");
                redirect('/');
            }
        }
    }

    // ------------------------------------------------------------------------

    /**
     * 加载视图
     *
     * @access  protected
     * @param   string
     * @param   array
     * @return  void
     */
    protected function _template($template, $data = array()) {
        $data['tpl'] = $template;
        $this->load->view('entry_v', $data);
    }

    // ------------------------------------------------------------------------

    /**
     * 检查权限
     *
     * @access  protected
     * @param   string
     * @return  void
     */
    protected function _check_permit() {
        if (!$this->acl->permit()) {
            $this->_message('对不起，你没有访问这里的权限！', '', FALSE);
        }
    }

    // ------------------------------------------------------------------------

    /**
     * 信息提示
     *
     * @access  public
     * @param string $msg 显示信息
     * @param string $goto 跳转网址（带http则直接跳转，否则site_url($goto)）
     * @param   bool
     * @param   string
     * @return  void
     */
    public function _message($msg, $goto = '', $auto = TRUE) {
        if ($goto == '') {
            $goto = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : site_url();
        } else {
            $goto = strpos($goto, 'http') !== false ? $goto : site_url($goto);
        }
        $this->_template('_message_v', array('msg' => $msg, 'goto' => $goto, 'auto' => $auto));
        echo $this->output->get_output();
        exit();
    }

    // ------------------------------------------------------------------------

    /**
     * BUG反馈
     * @access public
     * @param string $from 问题模块
     * @param string $message 错误信息
     * @return void 
     */
    public function _debug($from = '', $message = '') {
        $data['from'] = $from;
        $data['message'] = $message;
        $this->load->view('debug_v', $data);
    }

    // ------------------------------------------------------------------------
}

/* End of file Dili_Controller.php */
/* Location: ./admin/core/Dili_Controller.php */
	