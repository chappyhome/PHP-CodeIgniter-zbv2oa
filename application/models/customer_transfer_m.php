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
 * ZBV2OA 客户转移模型
 * @author      Binarx
 */
class Customer_transfer_m extends CI_Model {

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
     * 根据指定信息获取回访提醒信息
     *
     * @access  public
     * @param   int
     * @param   int
     * @param   string
     * @return  object
     */
//    public function get_remind($limit = 0, $offset = 0, $user_id = 0, $is_all = 0) {
//        if ($user_id) {
//            $this->db->where('zb_customer_remind.user_id', $user_id);
//        }
//        if (!$is_all) {
//            $this->db->where('remind_date <=',date('Ymd'));
//        }
//        if ($limit) {
//            $this->db->limit($limit);
//        }
//        if ($offset) {
//            $this->db->offset($offset);
//        }
//        return $this->db->select('zb_customer_remind.customer_id,remind_id,customer_name,address,tel,remind_content,remind_date,zb_customer_remind.create_time')
//                        ->join('zb_customer', 'zb_customer_remind.customer_id = zb_customer.customer_id')
//                        ->get('zb_customer_remind')
//                        ->result();
//    }

    // ------------------------------------------------------------------------

    /**
     * 获取指定回访提醒总数
     *
     * @access  public
     * @return  int
     */
//    public function get_remind_num($user_id = 0, $is_all = 0) {
//        if ($user_id) {
//            $this->db->where('zb_customer_remind.user_id', $user_id);
//        }
//        if (!$is_all) {
//            $this->db->where('remind_date >=',date('Ymd'));
//        }
//        return $this->db->count_all_results('zb_customer_remind');
//    }

    // ------------------------------------------------------------------------
    
    /**
     * 根据ID获取指定回访提醒
     *
     * @access  public
     * @return  int
     */
//    public function get_remind_by_id($remind_id = 0) {
//        return $this->db->where('remind_id', $remind_id)
//                        ->get('zb_customer_remind')
//                        ->row();
//    }

    // ------------------------------------------------------------------------

    /**
     * 添加回访提醒
     *
     * @access  public
     * @param   array
     * @return  bool
     */
    public function add_transfer($data) {
        $this->db->insert('zb_customer_transfer', $data);
        return $this->db->insert_id();
    }
    
    // ------------------------------------------------------------------------

    /**
     * 删除指定ID回访记录
     *
     * @access  public
     * @param   int
     * @return  bool
     */
//     public function del_remind($id) {
//        return $this->db->where('remind_id', $id)->delete('zb_customer_remind');
//     }

    // ------------------------------------------------------------------------

    /**
     * 删除指定客户的回访记录
     *
     * @access  public
     * @param   int
     * @return  bool
     */
//     public function del_visit_message_by_customer($id) {
//        return $this->db->where('customer_id', $id)->delete('zb_customer_visit');
//     }
    
    // ------------------------------------------------------------------------

    /**
     * 获取状态下的客户数
     *
     * @access  public
     * @param   int
     * @return  bool
     */
    // public function get_status_user_num($id) {
//        return $this->db->where('customer_id', $id)->count_all_results('zb_customer');
    // }
    // ------------------------------------------------------------------------

}

/* End of file customer_transfer_m.php */
/* Location: ./application/models/customer_transfer_m.php */