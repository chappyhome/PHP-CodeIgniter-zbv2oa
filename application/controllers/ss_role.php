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
 * ZBV 用户组管理控制器
 * @author      Binarx
 */
class Ss_role extends Admin_Controller {

    /**
     * 构造函数
     *
     * @access  public
     * @return  void
     */
    public function __construct() {
        parent::__construct();
        $this->_check_permit();
        $this->load->model(array('role_m', 'cache_m'));
    }

    // ------------------------------------------------------------------------

    /**
     * 默认入口
     *
     * @access  public
     * @return  void
     */
    public function view() {
        $this->input->post('numPerPage', TRUE) != "" ? $data['numPerPage'] = $this->input->post('numPerPage', TRUE) : $data['numPerPage'] = 10;
        $this->input->post('pageNum', TRUE) != "" ? $data['pageNum'] = $this->input->post('pageNum', TRUE) : $data['pageNum'] = 1;
        $offset = ($data['pageNum'] - 1) * $data['numPerPage'];
        $data['list'] = $this->role_m->get_roles($data['numPerPage'], $offset);
        $data['total_rows'] = $this->role_m->get_roles_num();
        $this->load->view('ss/ss_role_list_v', $data);
    }

    // ------------------------------------------------------------------------

    /**
     * 添加用户组表单生成/处理函数
     *
     * @access  public
     * @return  void
     */
    public function add() {
        if ($this->_get_form_data(1)) {
            $role_id = $this->role_m->add_role($this->_get_form_data(1));
            $this->cache_m->_update_role_cache($role_id);
            $this->cache_m->_update_menu_cache($role_id);
            $this->_message('用户组添加成功!', 'ss_role/view', TRUE);
        } else {
            $data['right_ss'] = $this->role_m->get_form_rights('ss');
            $data['right_em'] = $this->role_m->get_form_rights('em');
            $data['right_cr'] = $this->role_m->get_form_rights('cr');
            $data['right_mi'] = $this->role_m->get_form_rights('mi');
            $this->load->view('ss/ss_role_add_v', $data);
        }
    }

    // ------------------------------------------------------------------------

    /**
     * 修改用户组表单生成/处理函数
     *
     * @access  public
     * @param   int
     * @return  void
     */
    public function edit($id = 0) {
        $data = $this->role_m->get_form_rights();
        $data['role'] = $this->role_m->get_role_by_id($id);
        if (!$data['role']) {
            $this->_message('不存在的用户组', '', FALSE);
        }
        if ($this->_get_form_data(0)) {
            $this->role_m->edit_role($id, $this->_get_form_data(0));
            $this->cache_m->_update_role_cache($id);
            $this->cache_m->_update_menu_cache($id);
            $this->_message('用户组修改成功!', 'ss_role/edit/' . $id, TRUE);
        } else {
            $this->_template('ss_role_edit_v', $data);
        }
    }

    // ------------------------------------------------------------------------

    /**
     * 删除用户组
     *
     * @access  public
     * @param   int
     * @return  void
     */
    public function del($id = 0) {
        $role = $this->role_m->get_role_by_id($id);
        if (!$role) {
            $this->_message('不存在的用户组', '', FALSE);
        }
        if ($this->role_m->get_role_user_num($id) > 0) {
            $this->_message('该用户组下有用户不允许删除!', '', FALSE);
        }
        $this->role_m->del_role($id);
        $this->_message('用户组删除成功!', '', FALSE);
    }

    // ------------------------------------------------------------------------

    /**
     * 获取表单数据
     *
     * @access  private
     * @param   int
     * @return  array
     */
    private function _get_form_data($is_insert = 0) {
        $this->load->library('form_validation');
        $is_unique = $is_insert ? '|is_unique[zb_role.role_name]' : '';
        $this->form_validation->set_rules('name', '用户组名称', 'trim|required|min_length[4]|max_length[20]' . $is_unique);
        if ($this->form_validation->run() == FALSE) {
            return FALSE;
        } else {
            $data['role_name'] = $this->input->post('name', TRUE);
            $data['rights'] = $this->_array_to_string($this->input->post('right', TRUE));
            return $data;
        }
    }

    // ------------------------------------------------------------------------

    /**
     * 数组转换成字符串
     *
     * @access  private
     * @param   array
     * @return  string
     */
    private function _array_to_string($array) {
        if ($array AND is_array($array)) {
            return implode(',', $array);
        } else {
            return '0';
        }
    }

    // ------------------------------------------------------------------------
}

/* End of file role.php */
/* Location: ./controllers/role.php */