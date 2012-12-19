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
        $this->load->model(array('customer_m', 'customer_visit_m', 'customer_from_m'));
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
        $user_id = $this->_admin->user_id;
        $data['province'] = $this->customer_m->get_district(1);
        $data['province_now'] = $district_detail;
        $data['list'] = $this->customer_m->get_customers(15, $offset, $district_detail, $user_id, 'zb_customer_status.status_stage > 1');
        //加载分页
        $this->load->library('pagination');
        $config['base_url'] = site_url('cr_tel/my') . '?province=' . $district_detail;
        $config['per_page'] = 15;
        $config['page_query_string'] = TRUE;
        $config['query_string_segment'] = 'page';
        $config['total_rows'] = $this->customer_m->get_customers_num($district_detail, $user_id, 'zb_customer_status.status_stage > 1');
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $this->_template('cr_tel_my_list_v', $data);
    }

    // ------------------------------------------------------------------------

    /**
     * 客户资源
     *
     * @access  public
     * @return  void
     */
    public function resource() {
        //$offset 分页偏移
        $offset = $this->input->get('page', TRUE) ? $this->input->get('page', TRUE) : 0;
        $from_id = $this->input->get('from_id', TRUE);
        $user_id = $this->_admin->user_id;
        $data['from'] = $this->customer_from_m->get_from();
        $data['from_now'] = $this->input->get('from_id', TRUE);
        $data['list'] = $this->customer_m->get_customers(15, $offset, '', $user_id, 'zb_customer_status.status_stage=1', $from_id);
        //加载分页
        $this->load->library('pagination');
        $config['base_url'] = site_url('cr_tel/my') . '?from_id=' . $data['from_now'];
        $config['per_page'] = 15;
        $config['page_query_string'] = TRUE;
        $config['query_string_segment'] = 'page';
        $config['total_rows'] = $this->customer_m->get_customers_num('', $user_id, 'zb_customer_status.status_stage=1', $from_id);
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $this->_template('cr_tel_resource_list_v', $data);
    }

    // ------------------------------------------------------------------------

    /**
     * 回访客户（回访记 录列表 添加）
     *
     * @access  public
     * @return  void
     */
    public function visit($customer_id = 0) {
        $data['customer'] = $this->customer_m->get_customer_by_id($customer_id);
        if (!$data['customer']) {
            $this->_message('不存在的客户', '', FALSE);
        }
        if ($data_add = $this->_get_form_data()) {
            $data_add['customer_id'] = $customer_id;
            $data_add['user_id'] = $this->_admin->user_id;
            $data_add['user_detail'] = $this->_admin->fullname . ':' . $this->_admin->tel;
            $data_add['create_time'] = date('Y-m-d H:i:s');
            $this->customer_visit_m->add_visit_message($data_add);
            //更改客户状态
            if($data['customer']['status_id'] == 3) {
                $data_edit['status_id'] = 4;
                $this->customer_m->edit_customer($customer_id, $data_edit);
            }
            $this->_message('回访信息添加成功!', 'cr_tel/visit/'.$customer_id, TRUE);
        } else {
            //$offset 分页偏移
            $user_id = $this->_admin->user_id;
            $offset = $this->input->get('page', TRUE) ? $this->input->get('page', TRUE) : 0;
            $data['list'] = $this->customer_visit_m->get_visit(15, $offset, $user_id, $customer_id);
            //加载分页
            $this->load->library('pagination');
            $config['base_url'] = site_url('cr_tel/visit') . $customer_id;
            $config['per_page'] = 15;
            $config['page_query_string'] = TRUE;
            $config['query_string_segment'] = 'page';
            $config['total_rows'] = $this->customer_visit_m->get_visit_num($user_id, $customer_id);
            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();
            $this->_template('cr_tel_visit_v', $data);
        }
    }
    
    // ------------------------------------------------------------------------
    
    /**
     * 回访任务
     *
     * @access  public
     * @return  void
     */
    public function return_visit($customer_id = 0) {
        $data['customer'] = $this->customer_m->get_customer_by_id($customer_id);
        if (!$data['customer']) {
            $this->_message('不存在的客户', '', FALSE);
        }
        if ($data_add = $this->_get_form_data()) {
            $data_add['customer_id'] = $customer_id;
            $data_add['user_id'] = $this->_admin->user_id;
            $data_add['user_detail'] = $this->_admin->fullname . ':' . $this->_admin->tel;
            $data_add['create_time'] = date('Y-m-d H:i:s');
            $this->customer_visit_m->add_visit_message($data_add);
            //更改客户状态
            if($data['customer']['status_id'] == 3) {
                $data_edit['status_id'] = 4;
                $this->customer_m->edit_customer($customer_id, $data_edit);
            }
            $this->_message('回访信息添加成功!', 'cr_tel/visit/'.$customer_id, TRUE);
        } else {
            
            $this->_template('cr_tel_visit_v', $data);
        }
    }
    
    // ------------------------------------------------------------------------
    
    /**
     * 转移客户
     *
     * @access  public
     * @return  void
     */
    public function transfer($customer_id = 0) {
        $data['customer'] = $this->customer_m->get_customer_by_id($customer_id);
        if (!$data['customer']) {
            $this->_message('不存在的客户', '', FALSE);
        }
        if ($data_add = $this->_get_form_data()) {
            $data_add['customer_id'] = $customer_id;
            $data_add['user_id'] = $this->_admin->user_id;
            $data_add['user_detail'] = $this->_admin->fullname . ':' . $this->_admin->tel;
            $data_add['create_time'] = date('Y-m-d H:i:s');
            $this->customer_visit_m->add_visit_message($data_add);
            //更改客户状态
            if($data['customer']['status_id'] == 3) {
                $data_edit['status_id'] = 4;
                $this->customer_m->edit_customer($customer_id, $data_edit);
            }
            $this->_message('回访信息添加成功!', 'cr_tel/visit/'.$customer_id, TRUE);
        } else {
            
            $this->_template('cr_tel_visit_v', $data);
        }
    }
    
    // ------------------------------------------------------------------------

    /**
     * 删除指定回访记录
     *
     * @access  public
     * @return  void
     */
    public function del($customer_id = 0,$visit_id = 0) {
        $data = $this->customer_visit_m->get_visit_message_by_id($visit_id);
        if (!$data) {
            $this->_message('不存在的回访记录', '', FALSE);
        }
        $this->customer_visit_m->del_visit_message($visit_id);
        $this->_message('记录删除成功!', 'cr_tel/visit/'.$customer_id, TRUE);
    }
    
    // ------------------------------------------------------------------------

    /**
     * 获取post提交数据
     *
     * @access  public
     * @return  void
     */
    public function _get_form_data() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('visit_message', '回访记录', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            return FALSE;
        } else {
            $data['visit_message'] = $this->input->post('visit_message', TRUE);
            return $data;
        }
    }

    // ------------------------------------------------------------------------

    public function ajax() {
        $customer_id = $this->input->get('customer_id');
        echo json_encode($this->customer_m->get_customer_by_id($customer_id));
    }

}

/* End of file cr_tel.php */
/* Location: ./admin/controllers/cr_tel.php */