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
 * ZBV2OA 企业人员管理控制器
 * @author      Binarx
 */
class Em extends Admin_Controller {

    /**
     * 构造函数
     *
     * @access  public
     * @return  void
     */
    public function __construct() {
        parent::__construct();
        $this->_check_permit();
    }

    // ------------------------------------------------------------------------

    /**
     * 默认入口
     *
     * @access  public
     * @param   int
     * @return  void
     */
    public function view($department_id = 0) {
        //$offset 分页偏移
        $offset = $this->input->get('page', TRUE) ? $this->input->get('page', TRUE) : 0;
        $data['list'] = $this->user_m->get_em_users($department_id, 15, $offset, 0);
        $data['department_id'] = $department_id;
        $data['departments'] = $this->user_m->get_departments();
        //加载分页
        $this->load->library('pagination');
        $config['base_url'] = site_url('em/view') . '?';
        $config['per_page'] = 15;
        $config['page_query_string'] = TRUE;
        $config['query_string_segment'] = 'page';
        $config['total_rows'] = $this->user_m->get_em_users_num($department_id);
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $this->_template('em_employment_list_v', $data);
    }

    // ------------------------------------------------------------------------

    /**
     * 添加员工表单生成/处理函数
     *
     * @access  public
     * @return  void
     */
    public function add() {
        if ($this->_get_form_data()) {
            $this->user_m->add_employment($this->_get_form_data());
            $this->_message('添加员工成功!', 'em/view', TRUE);
        } else {
            $data['departments'] = $this->user_m->get_departments();
            $this->_template('em_employment_add_v', $data);
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
        $data['employment'] = $this->user_m->get_employment_by_userid($id);
        if (!$data['employment']) {
            $this->_message('不存在的员工', '', FALSE);
        }
        if ($this->_get_form_data()) {
            $this->user_m->edit_employment($id, $this->_get_form_data());
            $this->_message('用户修改成功!', 'em/view/', TRUE);
        } else {
            $data['departments'] = $this->user_m->get_departments();
            $this->_template('em_employment_edit_v', $data);
        }
    }

    // ------------------------------------------------------------------------

    /**
     * 删除员工
     *
     * @access  public
     * @param   int
     * @return  void
     */
    public function del($id) {
        $data['employment'] = $this->user_m->get_employment_by_userid($id);
        if (!$data['employment']) {
            $this->_message('不存在的员工', '', FALSE);
        }
        if (!$data['employment']->is_leave) {
            $this->_message('员工未离职不能删除', 'em/view', TRUE);
        }
        $this->user_m->del_employment($id);
        $this->_message('员工信息删除成功!', '', FALSE);
    }

    // ------------------------------------------------------------------------

    /**
     * 获取表单数据
     *
     * @access  private
     * @param   bool
     * @return  array
     */
    private function _get_form_data() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('fullname', '姓名', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('email', '邮箱', 'trim|required|max_length[40]|valid_email');
        $this->form_validation->set_rules('tel', '手机号码', 'trim|required|exact_length[11]|numeric');
        $this->form_validation->set_rules('emergency_tel', '紧急联系人电话', 'trim|required|exact_length[11]|numeric');
        $this->form_validation->set_rules('address', '现居地址', 'trim|required|max_length[50]');
        $this->form_validation->set_rules('id_cart', '身份证号', 'trim|required|exact_length[18]|alpha_numeric');
        $this->form_validation->set_rules('entry_time', '入职时间', 'trim|required');
        $this->form_validation->set_rules('leave_time', '离职时间', 'trim');
        $this->form_validation->set_rules('department_id', '部门', 'trim|required|numeric');
        $this->form_validation->set_rules('post', '职位', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            return FALSE;
        } else {
            $data['fullname'] = $this->input->post('fullname', TRUE);
            $data['email'] = $this->input->post('email', TRUE);
            $data['tel'] = $this->input->post('tel', TRUE);
            $data['emergency_tel'] = $this->input->post('emergency_tel', TRUE);
            $data['address'] = $this->input->post('address', TRUE);
            $data['id_cart'] = $this->input->post('id_cart', TRUE);
            $data['entry_time'] = $this->input->post('entry_time', TRUE);
            $data['leave_time'] = $this->input->post('leave_time', TRUE);
            $data['department_id'] = $this->input->post('department_id', TRUE);
            $data['post'] = $this->input->post('post', TRUE);
            if ($data['leave_time'] != '' && $data['leave_time'] != '0000-00-00' && $data['leave_time'] < date('Y-m-d')) {
                $data['is_leave'] = 1;
            } else {
                $data['is_leave'] = 0;
            }
            return $data;
        }
    }

    // ------------------------------------------------------------------------
}

/* End of file user.php */
/* Location: ./admin/controllers/user.php */