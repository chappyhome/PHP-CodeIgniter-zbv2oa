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
 * ZBV2OA 用户操作模型
 * @author      Binarx
 */
class User_m extends CI_Model {

    /**
     * 构造函数
     *
     * @access  public
     * @return  void
     */
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // ------------------------------------------------------------------------

    /**
     * 根据用户名或者用户UID称获取该用户完整的信息
     *
     * @access  public
     * @param   mixed
     * @return  object
     */
    public function get_full_user_by_username($username = '', $type = 'username') {
        if ($type == 'uid') {
            $this->db->where('zb_user.user_id', $username);
        } else {
            $this->db->where('zb_user.user_name', $username);
        }
        return $this->db->select("zb_user.user_id, zb_user.user_name, zb_user.tel, zb_user.password,zb_user.fullname,
           zb_user.salt, zb_role.role_id, zb_role.role_name, zb_user.is_admin, zb_user.is_leave")
                        ->join('zb_role', 'zb_role.role_id = zb_user.role_id','left')
                        ->get('zb_user')
                        ->row();
    }

    // ------------------------------------------------------------------------

    /**
     * 根据ID获取该员工信息
     *
     * @access  public
     * @param   int
     * @return  object
     */
    public function get_employment_by_userid($user_id = 0) {
        return $this->db->select("user_id, fullname, tel, emergency_tel, email,
           address, id_cart, entry_time, leave_time, department_id, post, is_leave")
                        ->where('user_id', $user_id)
                        ->get('zb_user')
                        ->row();
    }

    // ------------------------------------------------------------------------

    /**
     * 用户自己密码
     *
     * @access  public
     * @return  bool

      public function update_user_password() {
      $data['password'] = $this->input->post('new_pass', TRUE);
      $data['salt'] = substr(sha1(time()), -10);
      $data['password'] = sha1($data['password'] . $data['salt']);
      return $this->db->where('uid', $this->session->userdata('uid'))->update($this->db->dbprefix('admins'), $data);
      } */
    // ------------------------------------------------------------------------

    /**
     * 获取用户组列表
     *
     * @access  public
     * @return  object
     */
    public function get_roles() {
        return $this->db->select('role_id, role_name')->get('zb_role')->result_array();
    }

    // ------------------------------------------------------------------------

    /**
     * 获取部门列表
     *
     * @access  public
     * @return  object
     */
    public function get_departments() {
        return $this->db->select('department_id, department_name')->get('zb_department')->result();
    }

    // ------------------------------------------------------------------------

    /**
     * 获取有未添加账号的员工所在的部门
     *
     * @access  public
     * @return  object
     */
    public function get_em_departments() {
        return $this->db->select('zb_department.department_id, zb_department.department_name')
                        ->where('zb_user.is_admin', '0')
                        ->group_by('zb_user.department_id')
                        ->join('zb_department', 'zb_department.department_id=zb_user.department_id')
                        ->get('zb_user')
                        ->result_array();
    }

    // ------------------------------------------------------------------------

    /**
     * 获取用户数
     *
     * @access  public
     * @param   int
     * @return  int
     */
    public function get_users_num($role_id = 0) {
        if ($role_id) {
            $this->db->where('role_id', $role_id);
        }
        return $this->db->where('zb_user.is_admin !=', 0)->count_all_results('zb_user');
    }

    // ------------------------------------------------------------------------

    /**
     * 获取员工数
     *
     * @access  public
     * @param   int
     * @return  int
     */
    public function get_em_users_num($department_id = 0) {
        if ($department_id) {
            $this->db->where('department_id', $department_id);
        }
        return $this->db->where('fullname !=', 'NULL')->count_all_results('zb_user');
    }

    // ------------------------------------------------------------------------
    /**
     * 获取用户权限组下所有用户
     *
     * @access  public
     * @param   int
     * @param   int
     * @param   int
     * @return  object
     */
    public function get_users($role_id = 0, $limit = 0, $offset = 0) {
        if ($role_id) {
            $this->db->where('zb_user.role_id', $role_id);
        }
        if ($limit) {
            $this->db->limit($limit);
        }
        if ($offset) {
            $this->db->offset($offset);
        }
        return $this->db->where('zb_user.is_admin !=', 0)
                        ->join('zb_role', 'zb_role.role_id = zb_user.role_id')
                        ->get('zb_user')
                        ->result();
    }

    // ------------------------------------------------------------------------
    /**
     * 获取某些特定权限下所有用户
     *
     * @access  public
     * @param   int
     * @param   int
     * @param   int
     * @return  object
     */
    public function get_users_by_role($role_str = '') {
        return $this->db->select('user_id,fullname')
                        ->where('zb_user.is_admin =', 1)
                        ->join('zb_role', "zb_role.role_id = zb_user.role_id and zb_role.rights like '$role_str'")
                        ->get('zb_user')
                        ->result();
    }

    // ------------------------------------------------------------------------

    /**
     * 获取部门下指定用户
     *
     * @access  public
     * @param   int
     * @param   int
     * @param   int
     * @return  object
     */
    public function get_em_users($department_id = 0, $limit = 0, $offset = 0, $is_not_admin = 0, $is_not_leave = 0) {
        if ($department_id) {
            $this->db->where('zb_user.department_id', $department_id);
        }
        if ($limit) {
            $this->db->limit($limit);
        }
        if ($offset) {
            $this->db->offset($offset);
        }
        if ($is_not_admin) {
            $this->db->where('is_admin', 0);
        }
        if ($is_not_leave) {
            $this->db->where('is_leave', 0);
        }
        return $this->db->where('fullname !=', 'NULL')
                        ->join('zb_department', 'zb_user.department_id=zb_department.department_id')
                        ->get('zb_user')
                        ->result();
    }

    // ------------------------------------------------------------------------

    /**
     * 添加员工
     *
     * @access  public
     * @param   array
     * @return  bool
     */
    public function add_employment($data) {
        return $this->db->insert('zb_user', $data);
    }

    // ------------------------------------------------------------------------

    /**
     * 修改员工
     *
     * @access  public
     * @param   array
     * @return  bool
     */
    public function edit_employment($id, $data) {
        return $this->db->where('user_id', $id)->update('zb_user', $data);
    }

    // ------------------------------------------------------------------------

    /**
     * 删除员工
     *
     * @access  public
     * @param   array
     * @return  bool
     */
    public function del_employment($id) {
        return $this->db->where('user_id', $id)->delete('zb_user');
    }

    // ------------------------------------------------------------------------
    /**
     * 添加用户
     *
     * @access  public
     * @param   array
     * @return  bool
     */
    public function add_user($data, $user_id = 0) {
        $data['salt'] = substr(sha1(time()), -10);
        $data['password'] = sha1($data['password'] . $data['salt']);
        if ($user_id) {
            return $this->db->where('user_id', $user_id)
                            ->where('is_admin', '0')
                            ->update('zb_user', $data);
        } else {
            return $this->db->insert('zb_user', $data);
        }
    }

    // ------------------------------------------------------------------------

    /**
     * 修改用户
     *
     * @access  public
     * @param   int
     * @param   array
     * @return  bool
     */
    public function edit_user($id, $data) {
        if (isset($data['password'])) {
            $data['salt'] = substr(sha1(time()), -10);
            $data['password'] = sha1($data['password'] . $data['salt']);
        }
        return $this->db->where('user_id', $id)->update('zb_user', $data);
    }

    // ------------------------------------------------------------------------

    /**
     * 冻结用户
     *
     * @access  public
     * @param   int
     * @return  bool
     */
    public function stop_user($id, $restart = 0) {
        $data['is_admin'] = $restart ? '1' : '2';
        return $this->db->where('user_id', $id)->update('zb_user', $data);
    }

    // ------------------------------------------------------------------------

    /**
     * 删除用户
     *
     * @access  public
     * @param   uid
     * @return  bool
     */
    public function del_user($id) {
        return $this->db->where('user_id', $id)->delete('zb_user');
    }

    // ------------------------------------------------------------------------
}

/* End of file user_mdl.php */
/* Location: ./shared/models/user_mdl.php */