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
 * ZBV2OA 部门操作模型
 * @author      Binarx
 */
class Department_m extends CI_Model {

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
     * 获取部门信息
     *
     * @access  public
     * @param   int
     * @param   int
     * @return  object
     */
    public function get_department($limit = 0, $offset = 0) {
        if ($limit) {
            $this->db->limit($limit);
        }
        if ($offset) {
            $this->db->offset($offset);
        }
        return $this->db->select('department_id,department_name,post')
                        ->get('zb_department')
                        ->result();
    }

    // ------------------------------------------------------------------------

    /**
     * 获取部门总数
     *
     * @access  public
     * @return  int
     */
    public function get_departments_num() {
        return $this->db->count_all_results('zb_department');
    }

    // ------------------------------------------------------------------------

    /**
     * 添加部门
     *
     * @access  public
     * @param   array
     * @return  bool
     */
    public function add_department($data) {
        $this->db->insert('zb_department', $data);
        return $this->db->insert_id();
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
    public function edit_department($id, $data) {
        return $this->db->where('department_id', $id)->update('zb_department', $data);
    }

    // ------------------------------------------------------------------------

    /**
     * 根据部门ID获取部门信息
     *
     * @access  public
     * @param   int
     * @return  object
     */
    public function get_department_by_id($id) {
        return $this->db->where('department_id', $id)->get('zb_department')->row();
    }

    // ------------------------------------------------------------------------

    /**
     * 删除部门
     *
     * @access  public
     * @param   int
     * @return  bool
     */
    public function del_department($id) {
        return $this->db->where('department_id', $id)->delete('zb_department');
    }

    // ------------------------------------------------------------------------
    
    /**
     * 获取部门下的用户数
     *
     * @access  public
     * @param   int
     * @return  bool
     */
    public function get_department_user_num($id) {
        return $this->db->where('department_id', $id)->count_all_results('zb_user');
    }

    // ------------------------------------------------------------------------
}

/* End of file user_mdl.php */
/* Location: ./shared/models/user_mdl.php */