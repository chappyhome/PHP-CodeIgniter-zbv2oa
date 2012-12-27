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
        $this->load->model(array('customer_m', 'customer_visit_m', 'customer_from_m',
            'customer_remind_m', 'customer_transfer_m', 'workflow_m'));
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
            if ($data['customer']['status_id'] == 3) {
                $data_edit['status_id'] = 4;
                $this->customer_m->edit_customer($customer_id, $data_edit);
            }
            $this->_message('回访信息添加成功!', 'cr_tel/visit/' . $customer_id, TRUE);
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
     * 设置回访提醒
     *
     * @access  public
     * @return  void
     */
    public function add_remind($customer_id = 0) {
        $data['customer'] = $this->customer_m->get_customer_by_id($customer_id);
        if (!$data['customer']) {
            $this->_message('不存在的客户', '', FALSE);
        }
        $this->load->library('form_validation');
        $this->form_validation->set_rules('remind_content', '回访记录', 'trim|required');
        $this->form_validation->set_rules('remind_date', '提醒时间', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $this->_template('cr_tel_remind_add_v', $data);
        } else {
            $data_add['customer_id'] = $customer_id;
            $data_add['user_id'] = $this->_admin->user_id;
            $data_add['remind_content'] = $this->input->post('remind_content', TRUE);
            $data_add['remind_date'] = $this->input->post('remind_date', TRUE);
            $data_add['create_time'] = date('Y-m-d H:i:s');
            $this->customer_remind_m->add_remind_content($data_add);
            $this->_message('回访提醒添加成功!', 'cr_tel/my/', TRUE);
        }
    }

    // ------------------------------------------------------------------------

    /**
     * 回访提醒列表
     *
     * @access  public
     * @return  void
     */
    public function remind_list() {
        //$offset 分页偏移
        $offset = $this->input->get('page', TRUE) ? $this->input->get('page', TRUE) : 0;
        $is_all = $this->input->get('is_all', TRUE);
        $user_id = $this->_admin->user_id;
        $data['is_all'] = $is_all;
        $data['list'] = $this->customer_remind_m->get_remind(15, $offset, $user_id, $is_all);
        //加载分页
        $this->load->library('pagination');
        $config['base_url'] = site_url('cr_tel/return_visit_list') . '?is_all=' . $is_all;
        $config['per_page'] = 15;
        $config['page_query_string'] = TRUE;
        $config['query_string_segment'] = 'page';
        $config['total_rows'] = $this->customer_remind_m->get_remind_num($user_id, $is_all);
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $this->_template('cr_tel_remind_list_v', $data);
    }

    // ------------------------------------------------------------------------

    /**
     * 删除指定回访提醒
     *
     * @access  public
     * @return  void
     */
    public function del_remind($remind_id = 0) {
        $data = $this->customer_remind_m->get_remind_by_id($remind_id);
        if (!$data) {
            $this->_message('不存在的回访记录', '', FALSE);
        }
        $this->customer_remind_m->del_remind($remind_id);
        $this->_message('记录删除成功!', 'cr_tel/remind_list/', TRUE);
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
        if ($data['customer']['user_id'] != $this->_admin->user_id) {
            $this->_message($data['customer']['customer_name'] . " 不是您的客户，无权操作", '', FALSE);
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('new_user', '新负责人', 'trim|required');
        $this->form_validation->set_rules('transfer_message', '备注', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            //得到可以分配客户的账号列表;29为 客户资源 权限
            $data['user_list'] = $this->user_m->get_users_by_role('%,29,%');
            $data['start_time'] = date('Y-m-d H:i:s');
            $this->_template('cr_tel_transfer_add_v', $data);
        } else {
            //添加业务表
            $old_user_detail = explode(':', $data['customer']['user_detail']);
            $new_user_detail = explode(':', $this->input->post('new_user', TRUE));
            $data_add_transfer['customer_id'] = $data['customer']['customer_id'];
            $data_add_transfer['customer_name'] = $data['customer']['customer_name'];
            $data_add_transfer['old_user_id'] = $data['customer']['user_id'];
            $data_add_transfer['old_user_name'] = $old_user_detail[0];
            $data_add_transfer['new_user_id'] = $new_user_detail[0];
            $data_add_transfer['new_user_name'] = $new_user_detail[1];
            $data_add_transfer['transfer_message'] = $this->input->post('transfer_message', TRUE);
            $transfer_id = $this->customer_transfer_m->add_transfer($data_add_transfer);
            //添加进程表
            $data_add_process['defination_id'] = 1; //流程表的ID
            $data_add_process['process_desc'] = '申请客户 ' . $data_add_transfer['customer_name'] . ' 的负责人由' .
                    $data_add_transfer['old_user_name'] . '转为' . $data_add_transfer['new_user_name'];
            $data_add_process['context'] = $transfer_id; //客户转移表的ID
            $data_add_process['current_node_index'] = 1; //当前节点1
            $data_add_process['start_time'] = date('Y-m-d H:i:s');
            $data_add_process['state'] = 1; //进行中
            $data_add_process['start_user'] = $this->_admin->user_id;
            $process_id = $this->workflow_m->add_process($data_add_process);
            //添加线程
            $data_add_thread['process_id'] = $process_id;
            $data_add_thread['process_desc'] = $data_add_process['process_desc'];
            $data_add_thread['node_id'] = 1;
            $node_detail = $this->workflow_m->get_node_by_id($data_add_thread['node_id']);
            $data_add_thread['node_name'] = $node_detail->node_name;
            $data_add_thread['executor'] = $this->_admin->user_id;
            $data_add_thread['start_time'] = $data_add_thread['receive_time'] = $this->input->post('strat_time', TRUE);
            $data_add_thread['finish_time'] = date('Y-m-d H:i:s');
            $data_add_thread['max_time'] = $node_detail->max_date;
            $data_add_thread['state'] = 2;//已处理
            $this->workflow_m->add_thread($data_add_thread);
            //添加下一线程
            $data_add_next_thread['process_id'] = $process_id;
            $data_add_next_thread['process_desc'] = $data_add_process['process_desc'];
            $data_add_next_thread['node_id'] = 2;
            $node_next_detail = $this->workflow_m->get_node_by_id($data_add_next_thread['node_id']);
            $data_add_next_thread['node_name'] = $node_next_detail->node_name;
            $data_add_next_thread['start_time'] = $data_add_thread['finish_time'];
            $data_add_next_thread['max_time'] = $node_next_detail->max_date;
            $data_add_next_thread['state'] = 0;//未接收
            $this->workflow_m->add_thread($data_add_next_thread);
            $this->_message('客户 ' . $data_add_transfer['customer_name'] . ' 的负责人转为' . $data_add_transfer['new_user_name'].'的申请已提交', 'cr_tel/my/', TRUE);
        }
    }

    // ------------------------------------------------------------------------

    /**
     * 删除指定回访记录
     *
     * @access  public
     * @return  void
     */
    public function del_visit($customer_id = 0, $visit_id = 0) {
        $data = $this->customer_visit_m->get_visit_message_by_id($visit_id);
        if (!$data) {
            $this->_message('不存在的回访记录', '', FALSE);
        }
        $this->customer_visit_m->del_visit_message($visit_id);
        $this->_message('记录删除成功!', 'cr_tel/visit/' . $customer_id, TRUE);
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
    
    /**
     * 处理ajax请求
     *
     * @access  public
     * @return  void
     */
    public function ajax() {
        $customer_id = $this->input->get('customer_id');
        echo json_encode($this->customer_m->get_customer_by_id($customer_id));
    }

}

/* End of file cr_tel.php */
/* Location: ./admin/controllers/cr_tel.php */