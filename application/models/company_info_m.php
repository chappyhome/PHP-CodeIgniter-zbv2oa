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
 * ZBV2OA 企业信息操作模型
 * @author      Binarx
 */
class Company_info_m extends CI_Model {

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

    /**
     * 添加企业信息 安装时使用
     *
     * @access  public
     * @param   array
     * @return  bool
     */
//    public function add_class($data) {
//        $this->db->insert('zb_customer_class', $data);
//        return $this->db->insert_id();
//    }

    // ------------------------------------------------------------------------

    /**
     * 修改分组
     *
     * @access  public
     * @param   int
     * @param   array
     * @return  bool
     */
    public function edit_info($id, $data) {
        return $this->db->where('company_id', $id)->update('zb_company_info', $data);
    }

    // ------------------------------------------------------------------------

    /**
     * 根据分组ID获取分组信息
     *
     * @access  public
     * @param   int
     * @return  object
     */
    public function get_info_by_id($id) {
        return $this->db->where('company_id', $id)->get('zb_company_info')->row();
    }

    // ------------------------------------------------------------------------
}

/* End of file company_info_m.php */
/* Location: ./application/models/company_info_m.php */