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
 * ZBV2OA 客户来源操作模型
 * @author      Binarx
 */
class Customer_from_m extends CI_Model {

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
     * 获取全部分页来源信息
     *
     * @access  public
     * @param   int
     * @param   int
     * @return  object
     */
    public function get_from($limit = 0, $offset = 0) {
        if ($limit) {
            $this->db->limit($limit);
        }
        if ($offset) {
            $this->db->offset($offset);
        }
        return $this->db->select('from_id,from_name,rate')
                        ->get('zb_customer_from')
                        ->result();
    }

    // ------------------------------------------------------------------------

    /**
     * 获取来源总数
     *
     * @access  public
     * @return  int
     */
    public function get_froms_num() {
        return $this->db->count_all_results('zb_customer_from');
    }

    // ------------------------------------------------------------------------

    /**
     * 添加来源
     *
     * @access  public
     * @param   array
     * @return  bool
     */
    public function add_from($data) {
        $this->db->insert('zb_customer_from', $data);
        return $this->db->insert_id();
    }

    // ------------------------------------------------------------------------

    /**
     * 修改来源
     *
     * @access  public
     * @param   int
     * @param   array
     * @return  bool
     */
    public function edit_from($id, $data) {
        return $this->db->where('class_id', $id)->update('zb_customer_from', $data);
    }

    // ------------------------------------------------------------------------

    /**
     * 根据来源ID获取来源信息
     *
     * @access  public
     * @param   int
     * @return  object
     */
    public function get_from_by_id($id) {
        return $this->db->where('class_id', $id)->get('zb_customer_from')->row();
    }

    // ------------------------------------------------------------------------

    /**
     * 删除来源
     *
     * @access  public
     * @param   int
     * @return  bool
     */
    public function del_from($id) {
        return $this->db->where('class_id', $id)->delete('zb_customer_from');
    }

    // ------------------------------------------------------------------------

    /**
     * 获取来源下的客户数
     *
     * @access  public
     * @param   int
     * @return  bool
     */
    public function get_from_user_num($id) {
        return $this->db->where('from_id', $id)->count_all_results('zb_customer');
    }

    // ------------------------------------------------------------------------
}

/* End of file customer_from_m.php */
/* Location: ./application/models/customer_from_m.php */