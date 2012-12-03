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
 * ZBV2OA 客户状态控制器
 * @author      Binarx
 */
class Cr_sm extends Admin_Controller {

    /**
     * 构造函数
     *
     * @access  public
     * @return  void
     */
    public function __construct() {
        parent::__construct();
        $this->_check_permit();
        $this->load->model(array('customer_status_m'));
    }

// ------------------------------------------------------------------------

    /**
     * 客户状态默认页
     *
     * @access  public
     * @return  void
     */
    public function view() {
        //$offset 分页偏移
        $offset = $this->input->get('page', TRUE) ? $this->input->get('page', TRUE) : 0;
        $data['list'] = $this->customer_status_m->get_status(15, $offset);
        if (empty($data['list'])) {
            $this->_message('客户状态为空!', '', FALSE);
        }
        //加载分页
        $this->load->library('pagination');
        $config['base_url'] = site_url('cr_sm/view') . '?';
        $config['per_page'] = 15;
        $config['page_query_string'] = TRUE;
        $config['query_string_segment'] = 'page';
        $config['total_rows'] = $this->customer_status_m->get_statuses_num();
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $this->_template('cr_sm_list_v', $data);
    }

// ------------------------------------------------------------------------

    /**
     * 增加客户状态
     *
     * @access  public
     * @return  void
     */
    public function add() {
        if ($this->_get_form_data(1)) {
            $data = $this->_get_form_data(1);
            $this->customer_status_m->add_status($data);
            $this->_message('状态添加成功!', 'cr_sm/view', TRUE);
        } else {
            $data['is_add'] = 1;
            $data['status'] = NULL;
            $this->_template('cr_sm_form_v', $data);
        }
    }

// ------------------------------------------------------------------------

    /**
     * 修改客户状态
     *
     * @access  public
     * @return  void
     */
    public function edit($id = 0) {
        $data['status'] = $this->customer_status_m->get_status_by_id($id);
        if (!$data['status']) {
            $this->_message('不存在的状态', '', FALSE);
        }
        if ($id == 1) {
            $this->_message('系统默认状态不能修改', 'cr_sm/view/', TRUE);
        }
        if ($this->_get_form_data(0)) {
            $this->customer_status_m->edit_status($id, $this->_get_form_data(0));
            $this->_message('状态修改成功!', 'cr_sm/view/', TRUE);
        } else {
            $data['is_add'] = 0;
            $this->_template('cr_sm_form_v', $data);
        }
    }

// ------------------------------------------------------------------------

    /**
     * 删除客户状态
     *
     * @access  public
     * @return  void
     */
    public function del($id = 0) {
        $status = $this->customer_status_m->get_status_by_id($id);
        if (!$status) {
            $this->_message('不存在的状态', '', FALSE);
        }
        if ($id == 1) {
            $this->_message('系统默认状态不能删除', 'cr_sm/view/', TRUE);
        }
        if ($this->customer_status_m->get_status_user_num($id) > 0) {
            $this->_message('该状态下有客户不允许删除!', '', FALSE);
        }
        $this->customer_status_m->del_status($id);
        $this->_message('状态删除成功!', 'cr_sm/view/', TRUE);
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
        $this->form_validation->set_rules('status_name', '状态名称', 'trim|required|max_length[50]' . $is_unique);
        $this->form_validation->set_rules('status_post', '状态介绍', 'trim|max_length[150]');
        if ($this->form_validation->run() == FALSE) {
            return FALSE;
        } else {
            $data['status_name'] = $this->input->post('status_name', TRUE);
            $data['status_post'] = $this->input->post('status_post', TRUE);
            return $data;
        }
    }

}

/* End of file cr_sm.php */
/* Location: ./application/controllers/cr_sm.php */