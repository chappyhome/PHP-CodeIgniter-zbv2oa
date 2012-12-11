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
 * ZBV2OA 电话销售控制器
 * @author      Binarx
 */
class Cr_tel extends Admin_Controller {

    /**
     * 构造函数
     *
     * @access  public
     * @return  void
     */
    public function __construct() {
        parent::__construct();
        $this->_check_permit();
        $this->load->model(array('customer_m'));
    }

    // ------------------------------------------------------------------------

    /**
     * 客服关系默认页
     *
     * @access  public
     * @return  void
     */
    public function my() {
        //$offset 分页偏移
        $offset = $this->input->get('page', TRUE) ? $this->input->get('page', TRUE) : 0;
        $district_detail = $this->input->get('province', TRUE);
        $data['province'] = $this->customer_m->get_district(1);
        $data['province_now'] = $district_detail;
        $data['list'] = $this->customer_m->get_customers(15, $offset, $district_detail);
        //加载分页
        $this->load->library('pagination');
        $config['base_url'] = site_url('cr_tel/my') . '?province=' . $district_detail;
        $config['per_page'] = 15;
        $config['page_query_string'] = TRUE;
        $config['query_string_segment'] = 'page';
        $config['total_rows'] = $this->customer_m->get_customers_num($district_detail);
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $this->_template('cr_tel_my_list_v', $data);
    }

    // ------------------------------------------------------------------------

    public function ajax() {
        $customer_id = $this->input->get('customer_id');
        echo json_encode($this->customer_m->get_customer_by_id($customer_id));
    }

}

/* End of file cr_tel.php */
/* Location: ./admin/controllers/cr_tel.php */