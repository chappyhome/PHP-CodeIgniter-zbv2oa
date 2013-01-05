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
     * 用户列表
     *
     * @access  public
     * @param   int
     * @return  void
     */
    public function view() {
        $this->input->post('department_id', TRUE) != "" ? $data['department_id'] = $this->input->post('department_id') : $data['department_id'] = 0;
        $this->input->post('numPerPage', TRUE) != "" ? $data['numPerPage'] = $this->input->post('numPerPage', TRUE) : $data['numPerPage'] = 10;
        $this->input->post('pageNum', TRUE) != "" ? $data['pageNum'] = $this->input->post('pageNum', TRUE) : $data['pageNum'] = 1;
        $offset = ($data['pageNum'] - 1) * $data['numPerPage'];
        $data['list'] = $this->user_m->get_em_users($data['department_id'], $data['numPerPage'], $offset, 0, 0);
        $data['departments'] = $this->user_m->get_departments();
        $data['total_rows'] = $this->user_m->get_em_users_num($data['department_id']);
        $this->load->view('em/em_employment_list_v', $data);
    }

    // ------------------------------------------------------------------------

    /**
     * 添加员工表单生成/处理函数
     *
     * @access  public
     * @return  void
     */
    public function add($operate = '') {
        if ($operate == 'department') {
            $data['departments'] = $this->user_m->get_departments();
            exit(json_encode($data['departments']));
        }
        if ($operate == 'submit') {
            if ($this->_get_form_data()) {
                $this->user_m->add_employment($this->_get_form_data());
                echo $this->_json(200, '添加成功!', 'em_add', '', 'closeCurrent');
            } else {
                echo $this->_json(300, "后台数据验证错误!");
            }
        } else {
            $this->load->view('em/em_employment_add_v');
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
    public function edit($operate = '') {
        if ($operate == 'department') {
            $data['departments'] = $this->user_m->get_departments();
            exit(json_encode($data['departments']));
        }
        if ($operate == 'submit') {
            $employment_id = $this->input->get('id');
            $data['em'] = $this->user_m->get_full_user_by_username($employment_id, 'uid');
            if ($employment_id == ''||!$data['em']) {
                exit($this->_json(300, "不存在的员工!"));
            }
            if ($data_update = $this->_get_form_data()) {
                $this->user_m->edit_employment($employment_id, $data_update);
                echo $this->_json(200, '员工信息修改成功!', 'em_view', '', 'closeCurrent');
            } else {
                echo $this->_json(300, "后台数据验证错误!");
            }
        } else {
            $data['em'] = $this->user_m->get_full_user_by_username($operate, 'uid');
            if (!$data['em']) {
                exit($this->_json(300, "不存在的员工!"));
            }else{
                $this->load->view('em/em_employment_edit_v',$data);
            }
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
        $this->form_validation->set_rules('sex', '性别', 'trim|required|max_length[10]');
        $this->form_validation->set_rules('nation', '民族', 'trim|required|max_length[30]');
        $this->form_validation->set_rules('marriage', '婚否', 'trim|required|max_length[10]');
        $this->form_validation->set_rules('education', '教育', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('school', '学校', 'trim|required|max_length[50]');
        $this->form_validation->set_rules('major', '专业', 'trim|required|max_length[50]');
        $this->form_validation->set_rules('id_cart', '身份证号', 'trim|required|exact_length[18]|alpha_numeric');
        $this->form_validation->set_rules('address_cart', '身份证地址', 'trim|required|max_length[50]');
        $this->form_validation->set_rules('tel', '手机号码', 'trim|required');
        $this->form_validation->set_rules('email', '邮箱', 'trim|required|max_length[40]|valid_email');
        $this->form_validation->set_rules('emergency_name', '紧急联系人姓名', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('emergency_tel', '紧急联系人电话', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('address', '现居地址', 'trim|required|max_length[50]');
        $this->form_validation->set_rules('level', '级别', 'trim|required|max_length[50]');
        $this->form_validation->set_rules('department_id', '部门', 'trim|required|numeric');
        $this->form_validation->set_rules('post', '职位', 'trim|required|max_length[40]');
        $this->form_validation->set_rules('entry_time', '入职时间', 'trim|required');
        $this->form_validation->set_rules('formal_time', '转正时间', 'trim');
        $this->form_validation->set_rules('ss_start_time', '社保开始时间', 'trim');
        $this->form_validation->set_rules('ss_end_time', '社保结束时间', 'trim');
        $this->form_validation->set_rules('leave_time', '离职时间', 'trim');
        if ($this->form_validation->run() == FALSE) {
            return FALSE;
        } else {
            $data['fullname'] = $this->input->post('fullname', TRUE);
            $data['sex'] = $this->input->post('sex', TRUE);
            $data['nation'] = $this->input->post('nation', TRUE);
            $data['marriage'] = $this->input->post('marriage', TRUE);
            $data['education'] = $this->input->post('education', TRUE);
            $data['school'] = $this->input->post('school', TRUE);
            $data['major'] = $this->input->post('major', TRUE);
            $data['id_cart'] = $this->input->post('id_cart', TRUE);
            $data['address_cart'] = $this->input->post('address_cart', TRUE);
            $data['tel'] = $this->input->post('tel', TRUE);
            $data['email'] = $this->input->post('email', TRUE);
            $data['emergency_name'] = $this->input->post('emergency_name', TRUE);
            $data['emergency_tel'] = $this->input->post('emergency_tel', TRUE);
            $data['address'] = $this->input->post('address', TRUE);
            $data['level'] = $this->input->post('level', TRUE);
            $data['department_id'] = $this->input->post('department_id', TRUE);
            $data['post'] = $this->input->post('post', TRUE);
            $data['entry_time'] = $this->input->post('entry_time', TRUE);
            $data['formal_time'] = $this->input->post('formal_time', TRUE);
            $data['ss_start_time'] = $this->input->post('ss_start_time', TRUE);
            $data['ss_end_time'] = $this->input->post('ss_end_time', TRUE);
            $data['leave_time'] = $this->input->post('leave_time', TRUE);
            $data['is_leave'] = $data['leave_time']?1:0;
            $data['is_formal'] = $data['formal_time']?1:0;
            return $data;
        }
    }

    // ------------------------------------------------------------------------
}

/* End of file user.php */
/* Location: ./admin/controllers/user.php */