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
class Customer_class_m extends CI_Model {

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
     * 获取分组信息
     *
     * @access  public
     * @param   int
     * @param   int
     * @return  object
     */
    public function get_class($limit = 0, $offset = 0) {
        if ($limit) {
            $this->db->limit($limit);
        }
        if ($offset) {
            $this->db->offset($offset);
        }
        return $this->db->select('class_id,class_name,class_introduce')
                        ->get('zb_customer_class')
                        ->result();
    }

    // ------------------------------------------------------------------------

    /**
     * 获取分组总数
     *
     * @access  public
     * @return  int
     */
    public function get_classes_num() {
        return $this->db->count_all_results('zb_customer_class');
    }

    // ------------------------------------------------------------------------

    /**
     * 添加分组
     *
     * @access  public
     * @param   array
     * @return  bool
     */
    public function add_class($data) {
        $this->db->insert('zb_customer_class', $data);
        return $this->db->insert_id();
    }

    // ------------------------------------------------------------------------

    /**
     * 修改分组
     *
     * @access  public
     * @param   int
     * @param   array
     * @return  bool
     */
    public function edit_class($id, $data) {
        return $this->db->where('class_id', $id)->update('zb_customer_class', $data);
    }

    // ------------------------------------------------------------------------

    /**
     * 根据分组ID获取分组信息
     *
     * @access  public
     * @param   int
     * @return  object
     */
    public function get_class_by_id($id) {
        return $this->db->where('class_id', $id)->get('zb_customer_class')->row();
    }

    // ------------------------------------------------------------------------

    /**
     * 删除分组
     *
     * @access  public
     * @param   int
     * @return  bool
     */
    public function del_class($id) {
        return $this->db->where('class_id', $id)->delete('zb_customer_class');
    }

    // ------------------------------------------------------------------------

    /**
     * 获取分组下的客户数
     *
     * @access  public
     * @param   int
     * @return  bool
     */
    public function get_class_user_num($id) {
        return $this->db->where('class_id', $id)->count_all_results('zb_customer');
    }

    // ------------------------------------------------------------------------
}

/* End of file customer_class_m.php */
/* Location: ./application/models/customer_class_m.php */