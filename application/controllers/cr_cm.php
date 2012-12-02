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
 * ZBV2OA 客户资料来源控制器
 * @author      Binarx
 */
class Cr_cm extends Admin_Controller {

    /**
     * 构造函数
     *
     * @access  public
     * @return  void
     */
    public function __construct() {
        parent::__construct();
        $this->_check_permit();
        $this->load->model(array('customer_from_m'));
    }

// ------------------------------------------------------------------------

    /**
     * 客户来源默认页
     *
     * @access  public
     * @return  void
     */
    public function view() {
        //$offset 分页偏移
        $offset = $this->input->get('page', TRUE) ? $this->input->get('page', TRUE) : 0;
        $data['list'] = $this->customer_from_m->get_from(15, $offset);
        if(empty($data['list'])){
            $this->_message('客户来源列表为空!', 'cr_cm/add', TRUE);
        }
        //加载分页
        $this->load->library('pagination');
        $config['base_url'] = site_url('cr_cm/view') . '?';
        $config['per_page'] = 15;
        $config['page_query_string'] = TRUE;
        $config['query_string_segment'] = 'page';
        $config['total_rows'] = $this->customer_from_m->get_froms_num();
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $this->_template('cr_cm_list_v',$data);
    }

// ------------------------------------------------------------------------

    /**
     * 增加客户来源
     *
     * @access  public
     * @return  void
     */
    public function add($department_id = 0) {
        if ($this->_get_form_data(1)) {
            $data = $this->_get_form_data(1);
            $this->customer_from_m->add_from($data);
            $this->_message('来源添加成功!', 'cr_cm/view', TRUE);
        } else {
            $data['list'] = $department_id ? $this->user_m->get_em_users($department_id, 0, 0, 0, 1) : 0;
            $data['departments'] = $this->user_m->get_departments();
            $data['department_id'] = $department_id;
            $this->_template('cr_cm_add_v',$data);
        }
    }
// ------------------------------------------------------------------------

    /**
     * 修改客户来源
     *
     * @access  public
     * @return  void
     */
    public function edit($id = 0) {
        $data['from'] = $this->customer_from_m->get_from_by_id($id);
        if (!$data['from']) {
            $this->_message('不存在的来源', '', FALSE);
        }
        if ($this->_get_form_data(0)) {
            $this->customer_from_m->edit_from($id, $this->_get_form_data(0));
            $this->_message('来源修改成功!', 'cr_cm/view/', TRUE);
        } else {
            $this->_template('cr_cm_edit_v', $data);
        }
    }
// ------------------------------------------------------------------------

    /**
     * 删除客户来源
     *
     * @access  public
     * @return  void
     */
    public function del($id = 0) {
        $class = $this->customer_class_m->get_class_by_id($id);
        if (!$class) {
            $this->_message('不存在的分组', '', FALSE);
        }
        if ($this->customer_class_m->get_class_user_num($id) > 0) {
            $this->_message('该分组下有客户不允许删除!', '', FALSE);
        }
        $this->customer_class_m->del_class($id);
        $this->_message('分组删除成功!', 'cr_gm/view/', TRUE);
    }
// ------------------------------------------------------------------------

    /**
     * 获取表单POST
     *
     * @access  public
     * @return  void
     */
    public function _get_form_data($is_insert = 0) {
        $this->load->library('form_validation');
        $is_unique = $is_insert ? '|is_unique[zb_customer_from.from_name]' : '';
        $this->form_validation->set_rules('from_name', '来源名称', 'trim|required|max_length[30]' . $is_unique);
        $this->form_validation->set_rules('user_id', '关联用户', 'trim|numeric');
        $this->form_validation->set_rules('rate', '业务点数', 'trim|numeric');
        if ($this->form_validation->run() == FALSE) {
            return FALSE;
        } else {
            $data['from_name'] = $this->input->post('from_name', TRUE);
            $data['rate'] = $this->input->post('rate', TRUE);
            $data['user_id'] = $this->input->post('user_id', TRUE);
            return $data;
        }
    }

}

/* End of file cr_cm.php */
/* Location: ./application/controllers/cr_cm.php */