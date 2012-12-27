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
 * ZBV2OA 个人中心工作流控制器
 * @author      Binarx
 */
class Mi_wf extends Admin_Controller {

    /**
     * 构造函数
     *
     * @access  public
     * @return  void
     */
    public function __construct() {
        parent::__construct();
        $this->_check_permit();
        $this->load->model(array('workflow_m'));
    }

    // ------------------------------------------------------------------------

    /**
     * 我的申请
     *
     * @access  public
     * @return  void
     */
    public function apply_list() {
        //$offset 分页偏移
        $offset = $this->input->get('page', TRUE) ? $this->input->get('page', TRUE) : 0;
        $is_all = $this->input->get('is_all', TRUE);
        $user_id = $this->_admin->user_id;
        $data['is_all'] = $is_all;
        $data['list'] = $this->workflow_m->get_process(15, $offset, $user_id, $is_all);
        foreach ($data['list'] as $key) {
            $executor_arr = explode(',', $key->executor);
            if ($executor_arr[0]) {
                foreach ($executor_arr as $v) {
                    $executor_name .= $this->user_m->get_employment_by_userid($v)->fullname . '';
                }
            } else {
                $executor_name = $this->user_m->get_employment_by_userid($key->executor);
            }
            echo $start_name = $this->user_m->get_employment_by_userid($key->start_user)->fullname;
        }
        //加载分页
        $this->load->library('pagination');
        $config['base_url'] = site_url('mi_wf/apply_list') . '?is_all=' . $is_all;
        $config['per_page'] = 15;
        $config['page_query_string'] = TRUE;
        $config['query_string_segment'] = 'page';
        $config['total_rows'] = $this->workflow_m->get_process_num($user_id, $is_all);
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $this->_template('mi_wf_apply_list_v', $data);
    }

    // ------------------------------------------------------------------------

    /**
     * 等待审批
     *
     * @access  public
     * @return  void
     */
    public function reply_list() {
        $this->_template('mi_wf_reply_list_v');
    }

    // ------------------------------------------------------------------------

    /**
     * 处理ajax请求
     *
     * @access  public
     * @return  void
     */
    public function ajax_apply_detail() {
        $customer_id = $this->input->get('customer_id');
        echo json_encode($this->customer_m->get_customer_by_id($customer_id));
    }

}

/* End of file mi_wf.php */
/* Location: ./admin/controllers/mi_wf.php */