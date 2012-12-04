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
 * ZBV2OA 客户关系控制器
 * @author      Binarx
 */
class Cr extends Admin_Controller {

    /**
     * 构造函数
     *
     * @access  public
     * @return  void
     */
    public function __construct() {
        parent::__construct();
        $this->_check_permit();
        $this->load->model(array('customer_m', 'customer_status_m', 'customer_from_m'));
    }

    // ------------------------------------------------------------------------

    /**
     * 客服关系默认页
     *
     * @access  public
     * @return  void
     */
    public function my() {
        $this->_template('default_v');
    }

    // ------------------------------------------------------------------------

    /**
     * 增加未分配客户
     *
     * @access  public
     * @return  void
     */
    public function add_0_customer() {
        if ($this->_get_form_data(1)) {
            $data = $this->_get_form_data(1);
            $this->customer_status_m->add_status($data);
            $this->_message('状态添加成功!', 'cr_sm/view', TRUE);
        } else {
            $data['is_add'] = 1;
            $data['status'] = $this->customer_status_m->get_status_by_stage($stage = 0);
            $this->_message_if_null($data['status'], '客户状态为空，请先添加客户状态', 'cr_sm/view/');
            $data['from'] = $this->customer_from_m->get_from();
            $this->_template('cr_customer_add_v', $data);
        }
    }

    // ------------------------------------------------------------------------

    /**
     * 增加跟进中客户
     *
     * @access  public
     * @return  void
     */
    public function add_1_customer() {
        if ($this->_get_form_data(1)) {
            $data = $this->_get_form_data(1);
            $this->customer_status_m->add_status($data);
            $this->_message('状态添加成功!', 'cr_sm/view', TRUE);
        } else {
            $data['is_add'] = 1;
            $data['status'] = NULL;
            $data['status_stage'] = 0;
            $this->_template('cr_sm_form_v', $data);
        }
    }

    // ------------------------------------------------------------------------

    /**
     * 增加有效客户
     *
     * @access  public
     * @return  void
     */
    public function add_2_customer() {
        if ($this->_get_form_data(1)) {
            $data = $this->_get_form_data(1);
            $this->customer_status_m->add_status($data);
            $this->_message('状态添加成功!', 'cr_sm/view', TRUE);
        } else {
            $data['is_add'] = 1;
            $data['status'] = NULL;
            $data['status_stage'] = 0;
            $this->_template('cr_sm_form_v', $data);
        }
    }

    // ------------------------------------------------------------------------

    /**
     * 获取post提交数据
     *
     * @access  public
     * @return  void
     */
    public function _get_form_data($is_insert = 0) {
        $this->load->library('form_validation');
        $is_unique = $is_insert ? '|is_unique[zb_customer_status.status_name]' : '';
        $this->form_validation->set_rules('status_stage', '所属状态', 'trim|required|is_natural');
        $this->form_validation->set_rules('status_name', '状态名称', 'trim|required|max_length[50]' . $is_unique);
        $this->form_validation->set_rules('status_post', '状态介绍', 'trim|max_length[150]');
        if ($this->form_validation->run() == FALSE) {
            return FALSE;
        } else {
            $data['status_stage'] = $this->input->post('status_stage', TRUE);
            $data['status_name'] = $this->input->post('status_name', TRUE);
            $data['status_post'] = $this->input->post('status_post', TRUE);
            return $data;
        }
    }

    // ------------------------------------------------------------------------    
}

/* End of file cr.php */
/* Location: ./admin/controllers/cr.php */