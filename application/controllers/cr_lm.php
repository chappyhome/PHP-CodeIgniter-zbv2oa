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
 * ZBV2OA 客户级别控制器
 * @author      Binarx
 */
class Cr_lm extends Admin_Controller {

    /**
     * 构造函数
     *
     * @access  public
     * @return  void
     */
    public function __construct() {
        parent::__construct();
        $this->_check_permit();
        $this->load->model(array('customer_level_m'));
    }

// ------------------------------------------------------------------------

    /**
     * 客户级别默认页
     *
     * @access  public
     * @return  void
     */
    public function view() {
        //$offset 分页偏移
        $offset = $this->input->get('page', TRUE) ? $this->input->get('page', TRUE) : 0;
        $data['list'] = $this->customer_level_m->get_level(15, $offset);
        if (empty($data['list'])) {
            $this->_message('客户级别为空!', '', FALSE);
        }
        //加载分页
        $this->load->library('pagination');
        $config['base_url'] = site_url('cr_lm/view') . '?';
        $config['per_page'] = 15;
        $config['page_query_string'] = TRUE;
        $config['query_string_segment'] = 'page';
        $config['total_rows'] = $this->customer_level_m->get_levels_num();
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $this->_template('cr_lm_list_v', $data);
    }

// ------------------------------------------------------------------------

    /**
     * 增加客户级别
     *
     * @access  public
     * @return  void
     */
    public function add() {
        if ($this->_get_form_data(1)) {
            $data = $this->_get_form_data(1);
            $this->customer_level_m->add_level($data);
            $this->_message('级别添加成功!', 'cr_lm/view', TRUE);
        } else {
            $data['is_add'] = 1;
            $data['level'] = NULL;
            $this->_template('cr_lm_form_v', $data);
        }
    }

// ------------------------------------------------------------------------

    /**
     * 修改客户级别
     *
     * @access  public
     * @return  void
     */
    public function edit($id = 0) {
        $data['level'] = $this->customer_level_m->get_level_by_id($id);
        if (!$data['level']) {
            $this->_message('不存在的级别', '', FALSE);
        }
        if ($id == 1) {
            $this->_message('系统默认级别不能修改', 'cr_lm/view/', TRUE);
        }
        if ($this->_get_form_data(0)) {
            $this->customer_level_m->edit_level($id, $this->_get_form_data(0));
            $this->_message('级别修改成功!', 'cr_lm/view/', TRUE);
        } else {
            $data['is_add'] = 0;
            $this->_template('cr_lm_form_v', $data);
        }
    }

// ------------------------------------------------------------------------

    /**
     * 删除客户级别
     *
     * @access  public
     * @return  void
     */
    public function del($id = 0) {
        $level = $this->customer_level_m->get_level_by_id($id);
        if (!$level) {
            $this->_message('不存在的级别', '', FALSE);
        }
        if ($id == 1) {
            $this->_message('系统默认级别不能删除', 'cr_lm/view/', TRUE);
        }
        if ($this->customer_level_m->get_level_user_num($id) > 0) {
            $this->_message('该级别下有客户不允许删除!', '', FALSE);
        }
        $this->customer_level_m->del_level($id);
        $this->_message('级别删除成功!', 'cr_lm/view/', TRUE);
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
        $is_unique = $is_insert ? '|is_unique[zb_customer_level.level_name]' : '';
        $this->form_validation->set_rules('level_name', '级别名称', 'trim|required|max_length[50]' . $is_unique);
        $this->form_validation->set_rules('level_post', '级别介绍', 'trim|max_length[150]');
        if ($this->form_validation->run() == FALSE) {
            return FALSE;
        } else {
            $data['level_name'] = $this->input->post('level_name', TRUE);
            $data['level_post'] = $this->input->post('level_post', TRUE);
            return $data;
        }
    }

}

/* End of file cr_lm.php */
/* Location: ./application/controllers/cr_lm.php */