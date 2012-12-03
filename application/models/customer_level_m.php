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
 * ZBV2OA 客户分组操作模型
 * @author      Binarx
 */
class Customer_level_m extends CI_Model {

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
     * 获取级别信息
     *
     * @access  public
     * @param   int
     * @param   int
     * @return  object
     */
    public function get_level($limit = 0, $offset = 0) {
        if ($limit) {
            $this->db->limit($limit);
        }
        if ($offset) {
            $this->db->offset($offset);
        }
        return $this->db->select('level_id,level_name,level_post')
                        ->get('zb_customer_level')
                        ->result();
    }

    // ------------------------------------------------------------------------

    /**
     * 获取级别总数
     *
     * @access  public
     * @return  int
     */
    public function get_levels_num() {
        return $this->db->count_all_results('zb_customer_level');
    }

    // ------------------------------------------------------------------------

    /**
     * 添加级别
     *
     * @access  public
     * @param   array
     * @return  bool
     */
    public function add_level($data) {
        $this->db->insert('zb_customer_level', $data);
        return $this->db->insert_id();
    }

    // ------------------------------------------------------------------------

    /**
     * 修改级别
     *
     * @access  public
     * @param   int
     * @param   array
     * @return  bool
     */
    public function edit_level($id, $data) {
        return $this->db->where('level_id', $id)->update('zb_customer_level', $data);
    }

    // ------------------------------------------------------------------------

    /**
     * 根据级别ID获取级别信息
     *
     * @access  public
     * @param   int
     * @return  object
     */
    public function get_level_by_id($id) {
        return $this->db->where('level_id', $id)->get('zb_customer_level')->row();
    }

    // ------------------------------------------------------------------------

    /**
     * 删除级别
     *
     * @access  public
     * @param   int
     * @return  bool
     */
    public function del_level($id) {
        return $this->db->where('level_id', $id)->delete('zb_customer_level');
    }

    // ------------------------------------------------------------------------

    /**
     * 获取级别下的客户数
     *
     * @access  public
     * @param   int
     * @return  bool
     */
    public function get_level_user_num($id) {
        return $this->db->where('customer_id', $id)->count_all_results('zb_customer');
    }

    // ------------------------------------------------------------------------
}

/* End of file customer_level_m.php */
/* Location: ./application/models/customer_level_m.php */