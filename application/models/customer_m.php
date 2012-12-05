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
 * ZBV2OA 客户操作模型
 * @author      Binarx
 */
class Customer_m extends CI_Model {

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
     * 获取客户信息
     *
     * @access  public
     * @param   int
     * @param   int
     * @return  object
     */
    public function get_status($limit = 0, $offset = 0) {
//        if ($limit) {
//            $this->db->limit($limit);
//        }
//        if ($offset) {
//            $this->db->offset($offset);
//        }
//        return $this->db->select('status_id,status_stage,status_name,status_post')
//                        ->get('zb_customer_status')
//                        ->result();
    }

    // ------------------------------------------------------------------------

    /**
     * 获取客户总数
     *
     * @access  public
     * @return  int
     */
    public function get_statuses_num() {
//        return $this->db->count_all_results('zb_customer_status');
    }

    // ------------------------------------------------------------------------

    /**
     * 添加状态
     *
     * @access  public
     * @param   array
     * @return  bool
     */
    public function add_status($data) {
//        $this->db->insert('zb_customer_status', $data);
//        return $this->db->insert_id();
    }

    // ------------------------------------------------------------------------

    /**
     * 修改状态
     *
     * @access  public
     * @param   int
     * @param   array
     * @return  bool
     */
    public function edit_status($id, $data) {
//        return $this->db->where('status_id', $id)->update('zb_customer_status', $data);
    }

    // ------------------------------------------------------------------------

    /**
     * 根据状态ID获取状态信息
     *
     * @access  public
     * @param   int
     * @return  object
     */
    public function get_status_by_id($id) {
//        return $this->db->where('status_id', $id)->get('zb_customer_status')->row();
    }

    // ------------------------------------------------------------------------

    /**
     * 删除状态
     *
     * @access  public
     * @param   int
     * @return  bool
     */
    public function del_status($id) {
//        return $this->db->where('status_id', $id)->delete('zb_customer_status');
    }

    // ------------------------------------------------------------------------

    /**
     * 获取状态下的客户数
     *
     * @access  public
     * @param   int
     * @return  bool
     */
    public function get_status_user_num($id) {
//        return $this->db->where('customer_id', $id)->count_all_results('zb_customer');
    }

    // ------------------------------------------------------------------------

    /**
     * 获取地区数据
     *
     * @access  public
     * @param   int
     * @return  bool
     */
    public function get_district($level = 0, $id = 0) {
        if ($id) {
            $this->db->where('upid', $id);
        }
        return $this->db->where('level', $level)
                        ->get('zb_district')
                        ->result();
    }

    // ------------------------------------------------------------------------
}

/* End of file customer_status_m.php */
/* Location: ./application/models/customer_status_m.php */