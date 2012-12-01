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
 * ZBV2OA 企业部门管理控制器
 * @author      Binarx
 */
class Em_dm extends Admin_Controller {

    /**
     * 构造函数
     *
     * @access  public
     * @return  void
     */
    public function __construct() {
        parent::__construct();
        $this->_check_permit();
        $this->load->model(array('department_m'));
    }

    // ------------------------------------------------------------------------
    /**
     * 默认入口
     *
     * @access  public
     * @param   int
     * @return  void
     */
    public function view() {
        //$offset 分页偏移
        $offset = $this->input->get('page', TRUE) ? $this->input->get('page', TRUE) : 0;
        $data['list'] = $this->department_m->get_department(3, $offset);
        //加载分页
        $this->load->library('pagination');
        $config['base_url'] = site_url('em_dm/view') . '?';
        $config['per_page'] = 3;
        $config['page_query_string'] = TRUE;
        $config['query_string_segment'] = 'page';
        $config['total_rows'] = $this->department_m->get_departments_num();
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $this->_template('em_department_list_v', $data);
    }

    // ------------------------------------------------------------------------

    /**
     * 添加用户表单生成/处理函数
     *
     * @access  public
     * @return  void
     */
    public function add() {
        if ($this->_get_form_data(1)) {
            $data = $this->_get_form_data(1);
            $this->department_m->add_department($data);
            $this->_message('部门添加成功!', 'em_dm/view', TRUE);
        } else {
            $this->_template('em_department_add_v');
        }
    }

    // ------------------------------------------------------------------------

    /**
     * 修改用户表单生成/处理函数
     *
     * @access  public
     * @param   int
     * @return  void
     */
    public function edit($id = 0) {
        $data['department'] = $this->department_m->get_department_by_id($id);
        if (!$data['department']) {
            $this->_message('不存在的部门', '', FALSE);
        }
        if ($this->_get_form_data(0)) {
            $this->department_m->edit_department($id, $this->_get_form_data(0));
            $this->_message('部门修改成功!', 'em_dm/view/', TRUE);
        } else {
            $this->_template('em_department_edit_v', $data);
        }
    }

    // ------------------------------------------------------------------------

    /**
     * 删除用户
     *
     * @access  public
     * @param   int
     * @return  void
     */
    public function del($id) {
        $data['department'] = $this->department_m->get_department_by_id($id);
        if (!$data['department']) {
            $this->_message('不存在的部门', '', FALSE);
        }
        if ($this->department_m->get_department_user_num($id) > 0) {
            $this->_message('该部门下有用户不允许删除!', '', FALSE);
        }
        $this->department_m->del_department($id);
        $this->_message('部门删除成功!', 'em_dm/view/', TRUE);
    }

    // ------------------------------------------------------------------------

    /**
     * 获取表单数据
     *
     * @access  private
     * @param   bool
     * @return  array
     */
    private function _get_form_data($is_insert = 0) {
        $this->load->library('form_validation');
        $is_unique = $is_insert ? '|is_unique[zb_department.department_name]' : '';
        $this->form_validation->set_rules('department_name', '部门名称', 'trim|required|max_length[20]' . $is_unique);
        $this->form_validation->set_rules('post', '部门标语', 'trim|max_length[100]');
        if ($this->form_validation->run() == FALSE) {
            return FALSE;
        } else {
            $data['department_name'] = $this->input->post('department_name', TRUE);
            $data['post'] = $this->input->post('post', TRUE);
            return $data;
        }
    }

    // ------------------------------------------------------------------------
}

/* End of file user.php */
/* Location: ./admin/controllers/user.php */