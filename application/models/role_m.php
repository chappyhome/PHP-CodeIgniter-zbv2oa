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
 * ZBV2OA 用户组操作模型
 *
 * @package     ZBV2OA
 * @author      Binarx
 */
class Role_m extends CI_Model {

    /**
     * 构造函数
     *
     * @access  public
     * @return  void
     */
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('file');
    }

    // ------------------------------------------------------------------------

    /**
     * 获取出所有用户组
     *
     * @access  public
     * @return  object
     */
    public function get_roles($limit = 0, $offset = 0) {
        if ($limit) {
            $this->db->limit($limit);
        }
        if ($offset) {
            $this->db->offset($offset);
        }
        return $this->db->get('zb_role')->result();
    }

    // ------------------------------------------------------------------------

    /**
     * 获取用户组数
     *
     * @access  public
     * @param   int
     * @return  int
     */
    public function get_roles_num() {
        return $this->db->count_all_results('zb_role');
    }

    // ------------------------------------------------------------------------

    /**
     * 根据用户组ID获取用户信息
     *
     * @access  public
     * @param   int
     * @return  object
     */
    public function get_role_by_id($id) {
        return $this->db->where('role_id', $id)->get('zb_role')->row();
    }

    // ------------------------------------------------------------------------

    /**
     * 根据用户组名称获取用户组信息
     *
     * @access  public
     * @param   string
     * @return  object
     */
    public function get_role_by_name($name) {
        return $this->db->where('role_name', $name)->get('zb_role')->row();
    }

    // ------------------------------------------------------------------------

    /**
     * 获取权限表单的数据
     *
     * @access  public
     * @return  array
     */
    public function get_form_rights($str = '') {
        if ($str) {
            $this->db->like('right_class', $str);
        }
        $array = $this->db->select('right_id,right_name')
                          ->get('zb_right')
                          ->result();
        $data = array();
        foreach ($array as $key) {
            $data[$key->right_id] = $key->right_name;
        }
        return $data;
    }

    // ------------------------------------------------------------------------

    /**
     * 添加用户组
     *
     * @access  public
     * @param   array
     * @return  int
     */
    public function add_role($data) {
        $this->db->insert('zb_role', $data);
        return $this->db->insert_id();
    }

    // ------------------------------------------------------------------------

    /**
     * 修改用户组
     *
     * @access  public
     * @param   int
     * @param   array
     * @return  bool
     */
    public function edit_role($id, $data) {
        return $this->db->where('role_id', $id)->update('zb_role', $data);
    }

    // ------------------------------------------------------------------------

    /**
     * 获取用户组下用户数目
     *
     * @access  public
     * @param   int
     * @return  int
     */
    public function get_role_user_num($id) {
        return $this->db->where('role_id', $id)->count_all_results('zb_user');
    }

    // ------------------------------------------------------------------------

    /**
     * 删除用户组
     *
     * @access  public
     * @param   int
     * @return  void
     */
    public function del_role($id) {
        $this->db->where('role_id', $id)->delete('zb_role');
        delete_files('./application/date/role_' . $id . '.php');
    }

    // ------------------------------------------------------------------------
}

/* End of file role_mdl.php */
/* Location: ./shared/models/role_mdl.php */