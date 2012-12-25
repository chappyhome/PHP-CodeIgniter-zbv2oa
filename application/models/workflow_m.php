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
 * ZBV2OA 工作流操作模型
 *
 * @package     ZBV2OA
 * @author      Binarx
 */
class Workflow_m extends CI_Model {

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
     * 获取出所有用户组
     *
     * @access  public
     * @return  object
     */
//    public function get_roles() {
//        return $this->db->get('zb_role')->result();
//    }

    // ------------------------------------------------------------------------

    /**
     * 根据节点ID获取节点信息
     *
     * @access  public
     * @param   int
     * @return  object
     */
    public function get_node_by_id($node_id) {
        return $this->db->where('node_id', $node_id)->get('zb_workflow_node')->row();
    }

    // ------------------------------------------------------------------------

    /**
     * 根据用户组名称获取用户组信息
     *
     * @access  public
     * @param   string
     * @return  object
     */
//    public function get_role_by_name($name) {
//        return $this->db->where('role_name', $name)->get('zb_role')->row();
//    }

    // ------------------------------------------------------------------------

    /**
     * 获取权限表单的数据
     *
     * @access  public
     * @return  array
     */
//    public function get_form_rights() {
//        $array = $this->db->select('right_id,right_name')->get('zb_right')->result();
//        $data = array();
//        foreach ($array as $key) {
//            $data['rights'][$key->right_id] = $key->right_name;
//        }
//        return $data;
//    }

    // ------------------------------------------------------------------------

    /**
     * 添加流程执行进程
     *
     * @access  public
     * @param   array
     * @return  int
     */
    public function add_process($data) {
        $this->db->insert('zb_workflow_process', $data);
        return $this->db->insert_id();
    }

    // ------------------------------------------------------------------------
    
    /**
     * 添加流程执行线程
     *
     * @access  public
     * @param   array
     * @return  int
     */
    public function add_thread($data) {
        $this->db->insert('zb_workflow_thread', $data);
        return $this->db->insert_id();
    }

    // ------------------------------------------------------------------------
    
    /**
     * 添加工作流定义
     *
     * @access  public
     * @param   array
     * @return  int
     */
    public function add_defination($data) {
        $this->db->insert('zb_workflow_defination', $data);
        return $this->db->insert_id();
    }

    // ------------------------------------------------------------------------
    
    /**
     * 添加流程节点
     *
     * @access  public
     * @param   array
     * @return  int
     */
    public function add_node($data) {
        $this->db->insert('zb_workflow_node', $data);
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
//    public function edit_role($id, $data) {
//        return $this->db->where('role_id', $id)->update('zb_role', $data);
//    }

    // ------------------------------------------------------------------------

    /**
     * 获取用户组下用户数目
     *
     * @access  public
     * @param   int
     * @return  int
     */
//    public function get_role_user_num($id) {
//        return $this->db->where('role_id', $id)->count_all_results('zb_user');
//    }

    // ------------------------------------------------------------------------

    /**
     * 删除用户组
     *
     * @access  public
     * @param   int
     * @return  void
     */
//    public function del_role($id) {
//        $this->db->where('role_id', $id)->delete('zb_role');
//        delete_files('./application/date/role_' . $id . '.php');
//    }

    // ------------------------------------------------------------------------
}

/* End of file role_mdl.php */
/* Location: ./shared/models/role_mdl.php */