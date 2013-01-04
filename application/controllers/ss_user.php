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
    public function view() {
        $this->input->post('role', TRUE) != "" ? $data['role'] = $this->input->post('role') : $data['role'] = 0;
        $this->input->post('numPerPage', TRUE) != "" ? $data['numPerPage'] = $this->input->post('numPerPage', TRUE) : $data['numPerPage'] = 10;
        $this->input->post('pageNum', TRUE) != "" ? $data['pageNum'] = $this->input->post('pageNum', TRUE) : $data['pageNum'] = 1;
        $offset = ($data['pageNum'] - 1) * $data['numPerPage'];
        $data['list'] = $this->user_m->get_users($data['role'], $data['numPerPage'], $offset);
        $data['roles'] = $this->user_m->get_roles();
        $data['total_rows'] = $this->user_m->get_users_num($data['role']);
        $this->load->view('ss/ss_user_list_v', $data);
    }

    // ------------------------------------------------------------------------

    /**
     * 添加员工用户表单生成/处理函数
     *
     * @access  public
     * @return  void
     */
    public function add_em_user($operate = '') {
        if ($operate == 'department') {
            $data['departments'] = $this->user_m->get_em_departments();
            exit(json_encode($data['departments']));
        }
        if ($operate == 'user') {
            $this->input->get('department_id') != "" ? $department_id = $this->input->get('department_id') : 0;
            $data['user'] = $department_id ? $this->user_m->get_em_users($department_id, 0, 0, 1, 1) : 0;
            exit(json_encode($data['user']));
        }
        if ($operate == 'role') {
            $data['roles'] = $this->user_m->get_roles();
            exit(json_encode($data['roles']));
        }
        if ($operate == 'submit') {
            if ($data = $this->_get_form_data(1, 0)) {
                $this->user_m->add_user($data, $data['user_id']);
                echo $this->_json(200, '操作成功!', 'ss_user_view', '', 'closeCurrent');
            } else {
                echo $this->_json(300, "后台数据验证错误（检查用户名是否已经存在）!");
            }
        } else {
            $this->load->view('ss/ss_user_em_add_v');
        }
    }

    // ------------------------------------------------------------------------

    /**
     * 添加外部用户表单生成/处理函数
     *
     * @access  public
     * @return  void
     */
    public function add_user($operate = '') {
        if ($operate == 'role') {
            $data['roles'] = $this->user_m->get_roles();
            exit(json_encode($data['roles']));
        }
        if ($operate == 'submit') {
            if ($data = $this->_get_form_data(0, 0)) {
                $this->user_m->add_user($data);
                echo $this->_json(200, '操作成功!', 'ss_user_view', '', 'closeCurrent');
            } else {
                echo $this->_json(300, "后台数据验证错误（检查用户名是否已经存在）!");
            }
        } else {
            $this->load->view('ss/ss_user_add_v');
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
        if ($operate == 'submit') {
            $user_id = $this->input->get('id');
            if ($user_id == '') {
                exit($this->_json(300, "不存在的用户!"));
            }
            if ($data_update = $this->_get_form_data(0, 1)) {
                $this->user_m->edit_user($user_id, $data_update);
                echo $this->_json(200, '操作成功!', 'ss_user_view', '', 'closeCurrent');
            } else {
                echo $this->_json(300, "后台数据验证错误（检查用户名是否已经存在）!");
            }
        } else {
            $data['user'] = $this->user_m->get_full_user_by_username($operate, 'uid');
            if (!$data['user']) {
                exit($this->_json(300, "不存在的用户!"));
            }
            $data['roles'] = $this->user_m->get_roles();
            $this->load->view('ss/ss_user_edit_v', $data);
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
    public function del($id = 0) {
        $user = $this->user_m->get_full_user_by_username($id, 'uid');
        if (!$user) {
            exit($this->_json(300, "不存在的用户!"));
        }
        if (isset($user->fullname)) {
            exit($this->_json(300, "内部员工用户不能直接删除，可选择冻结用户!"));
        }
        $this->user_m->del_user($id);
        echo $this->_json(200, '删除用户成功!', 'ss_user_view');
    }

    // ------------------------------------------------------------------------

    /**
     * 冻结用户
     *
     * @access  public
     * @param   int
     * @return  void
     */
    public function stop($id = 0) {
        $user = $this->user_m->get_full_user_by_username($id, 'uid');
        if (!$user) {
            exit($this->_json(300, "不存在的用户!"));
        }
        if ($user->is_admin == '1') {
            $this->user_m->stop_user($id);
            echo $this->_json(200, '冻结用户成功，此用户将不能登陆系统!', 'ss_user_view');
        } else {
            $this->user_m->stop_user($id, 1);
            echo $this->_json(200, '恢复用户成功!', 'ss_user_view');
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
        $this->form_validation->set_error_delimiters('', '');
        if ($is_em) {
            $this->form_validation->set_rules('user_id', '员工', 'trim|is_natural_no_zero');
        }
        $is_unique = !$is_edit ? '|is_unique[zb_user.user_name]' : '';
        $is_require = !$is_edit ? '|required' : '';
        $this->form_validation->set_rules('user_name_add', '用户名', 'trim|required|max_length[20]|min_length[4]' . $is_unique);
        $this->form_validation->set_rules('password', '密码', 'trim|max_length[16]|min_length[6]' . $is_require);
        $this->form_validation->set_rules('password_ok', '确认密码', 'trim|max_length[16]|min_length[6]|matches[password]' . $is_require);
        $this->form_validation->set_rules('role_id', '用户组', 'trim|is_natural_no_zero');
        if ($this->form_validation->run() == FALSE) {
            return FALSE;
        } else {
            if ($is_em) {
                $data['user_id'] = $this->input->post('user_id');
            }
            $data['user_name'] = $this->input->post('user_name_add', TRUE);
            $data['password'] = $this->input->post('password', TRUE);
            $data['is_admin'] = '1';
            $data['role_id'] = $this->input->post('role_id');
            return $data;
        }
    }

    // ------------------------------------------------------------------------
}

/* End of file user.php */
/* Location: ./admin/controllers/user.php */