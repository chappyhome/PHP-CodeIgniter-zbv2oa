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
 * ZBV2OA 客户回访记录模型
 * @author      Binarx
 */
class Customer_visit_m extends CI_Model {

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
     * 根据指定信息获取回访记录信息
     *
     * @access  public
     * @param   int
     * @param   int
     * @param   string
     * @return  object
     */
    public function get_visit($limit = 0, $offset = 0, $user_id = 0, $customer_id = 0) {
        if ($user_id) {
            $this->db->where('zb_customer_visit.user_id', $user_id);
        }
        if ($customer_id) {
            $this->db->where('zb_customer_visit.customer_id', $customer_id);
        }
        if ($limit) {
            $this->db->limit($limit);
        }
        if ($offset) {
            $this->db->offset($offset);
        }
        return $this->db->select('visit_id,zb_customer_visit.user_detail,visit_message,zb_customer_visit.create_time,customer_name,tel,address,from_detail,channel,brand,intention,company')
                        ->join('zb_customer', 'zb_customer_visit.customer_id = zb_customer.customer_id')
                        ->order_by('zb_customer_visit.create_time','DESC')
                        ->get('zb_customer_visit')
                        ->result();
    }

    // ------------------------------------------------------------------------

    /**
     * 获取指定回访记录总数
     *
     * @access  public
     * @return  int
     */
    public function get_visit_num($user_id = 0, $customer_id = 0) {
        if ($user_id) {
            $this->db->where('zb_customer_visit.user_id', $user_id);
        }
        if ($customer_id) {
            $this->db->where('zb_customer_visit.customer_id', $customer_id);
        }
        return $this->db->count_all_results('zb_customer_visit');
    }

    // ------------------------------------------------------------------------

    /**
     * 根据ID获取指定回访记录
     *
     * @access  public
     * @return  int
     */
    public function get_visit_message_by_id($visit_message_id = 0) {
        return $this->db->where('visit_id', $visit_message_id)
                        ->get('zb_customer_visit')
                        ->row();
    }

    // ------------------------------------------------------------------------

    /**
     * 添加回访记录
     *
     * @access  public
     * @param   array
     * @return  bool
     */
    public function add_visit_message($data) {
        $this->db->insert('zb_customer_visit', $data);
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
     public function del_visit_message($id) {
        return $this->db->where('visit_id', $id)->delete('zb_customer_visit');
     }

    // ------------------------------------------------------------------------

    /**
     * 删除指定客户的回访记录
     *
     * @access  public
     * @param   int
     * @return  bool
     */
     public function del_visit_message_by_customer($id) {
        return $this->db->where('customer_id', $id)->delete('zb_customer_visit');
     }
    
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