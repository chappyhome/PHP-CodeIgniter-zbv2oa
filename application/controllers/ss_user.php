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
 * ZBV2OA 用户管理控制器
 * @author      Binarx
 */
class Ss_user extends Admin_Controller {

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
    public function view($role = 0) {
        //$offset 分页偏移
        $offset = $this->input->get('page', TRUE) ? $this->input->get('page', TRUE) : 0;
        $data['list'] = $this->user_m->get_users($role, 15, $offset);
        $data['role'] = $role;
        $data['roles'] = $this->user_m->get_roles();
        $data['total_rows'] = $this->user_m->get_users_num($role);

        //加载分页
//        $this->load->library('pagination');
//        $config['base_url'] = site_url('ss_user/view') . '?';
//        $config['per_page'] = 15;
//        $config['page_query_string'] = TRUE;
//        $config['query_string_segment'] = 'page';
//        $config['total_rows'] = $this->user_m->get_users_num($role);
//        $this->pagination->initialize($config);
//        $data['pagination'] = $this->pagination->create_links();
        $this->load->view('ss/ss_user_list_v',$data);
        //$this->_template('ss_user_list_v', $data);
    }

    // ------------------------------------------------------------------------

    /**
     * 添加员工用户表单生成/处理函数
     *
     * @access  public
     * @return  void
     */
    public function add_em_user($department_id = 0) {
        if ($data = $this->_get_form_data(1, 0)) {
            $this->user_m->add_user($data, $data['user_id']);
            $this->_message('用户添加成功!', 'ss_user/view', TRUE);
        } else {
            $data['roles'] = $this->user_m->get_roles();
            $data['list'] = $department_id ? $this->user_m->get_em_users($department_id, 0, 0, 1, 1) : 0;
            $data['departments'] = $this->user_m->get_departments();
            $data['department_id'] = $department_id;
            $this->_template('ss_user_add_v', $data);
        }
    }

    // ------------------------------------------------------------------------

    /**
     * 添加外部用户表单生成/处理函数
     *
     * @access  public
     * @return  void
     */
    public function add_user() {
        if ($data = $this->_get_form_data(0, 0)) {
            $this->user_m->add_user($data);
            $this->_message('用户添加成功!', 'ss_user/view', TRUE);
        } else {
            $data['roles'] = $this->user_m->get_roles();
            $this->_template('ss_user_add_v', $data);
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
        $data['user'] = $this->user_m->get_full_user_by_username($id, 'uid');
        if (!$data['user']) {
            $this->_message('不存在的用户', '', FALSE);
        }
        if ($data2 = $this->_get_form_data(0, 1)) {
            $this->user_m->edit_user($id, $data2);
            $this->_message('用户修改成功!', 'ss_user/view/', TRUE);
        } else {
            $data['roles'] = $this->user_m->get_roles();
            $this->_template('ss_user_edit_v', $data);
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
        $user = $this->user_m->get_full_user_by_username($id, 'uid');
        if (!$user) {
            $this->_message('不存在的用户!', '', FALSE);
        }
        if (isset($user->fullname)) {
            $this->_message('内部员工用户不能删除，可选择冻结用户!', '', FALSE);
        }
        $this->user_m->del_user($id);
        $this->_message('用户删除成功!', 'ss_user/view/', TRUE);
    }

    // ------------------------------------------------------------------------

    /**
     * 冻结用户
     *
     * @access  public
     * @param   int
     * @return  void
     */
    public function stop($id) {
        $user = $this->user_m->get_full_user_by_username($id, 'uid');
        if (!$user) {
            $this->_message('不存在的用户!', '', FALSE);
        }
        if ($user->is_admin == '1') {
            $this->user_m->stop_user($id);
            $this->_message('冻结用户成功，此用户将不能登陆系统!', 'ss_user/view/', TRUE);
        } else {
            $this->user_m->stop_user($id, 1);
            $this->_message('恢复用户成功!', 'ss_user/view/', TRUE);
        }
    }

    // ------------------------------------------------------------------------
    /**
     * 获取表单数据
     *
     * @access  private
     * @param   bool
     * @return  array
     */
    private function _get_form_data($is_em = 0, $is_edit = 0) {
        $this->load->library('form_validation');
        if ($is_em) {
            $this->form_validation->set_rules('user_id', '员工', 'trim|required|is_natural_no_zero');
        }
        $is_unique = !$is_edit ? '|is_unique[zb_user.user_name]' : '';
        $is_require = !$is_edit ? '|required' : '';
        $this->form_validation->set_rules('user_name', '用户名', 'trim|required|max_length[20]|min_length[4]' . $is_unique);
        $this->form_validation->set_rules('password', '密码', 'trim|max_length[16]|min_length[6]' . $is_require);
        $this->form_validation->set_rules('confirm_password', '确认密码', 'trim|max_length[16]|min_length[6]|matches[password]' . $is_require);
        $this->form_validation->set_rules('role_id', '用户组', 'trim|required|is_natural_no_zero');
        if ($this->form_validation->run() == FALSE) {
            return FALSE;
        } else {
            $data['user_id'] = $this->input->post('user_id', TRUE);
            $data['user_name'] = $this->input->post('user_name', TRUE);
            $data['password'] = $this->input->post('password', TRUE);
            $data['is_admin'] = '1';
            $data['role_id'] = $this->input->post('role_id', TRUE);
            return $data;
        }
    }

    // ------------------------------------------------------------------------
}

/* End of file user.php */
/* Location: ./admin/controllers/user.php */