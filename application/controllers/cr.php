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
 * ZBV2OA 客户关系控制器
 * @author      Binarx
 */
class Cr extends Admin_Controller {

    /**
     * 构造函数
     *
     * @access  public
     * @return  void
     */
    public function __construct() {
        parent::__construct();
        $this->_check_permit();
        $this->load->model(array('customer_m', 'customer_status_m', 'customer_from_m',
            'district_m', 'customer_class_m', 'customer_level_m'));
        $this->load->library('form_validation');
    }

    // ------------------------------------------------------------------------

    /**
     * 增加客户视图
     *
     * @access  public
     * @return  void
     */
    public function add_customer() {
        $data['is_add'] = 1;
        $data['status_0'] = $this->customer_status_m->get_status_by_stage($stage = 0);
        $data['status_1'] = $this->customer_status_m->get_status_by_stage($stage = 1);
        $data['status_2'] = $this->customer_status_m->get_status_by_stage($stage = 2);
        $this->_message_if_null($data['status_0'], '客户状态为空，请先添加客户状态', 'cr_sm/view/');
        $data['from'] = $this->customer_from_m->get_from();
        $this->_message_if_null($data['from'], '客户来源为空，请先添加客户来源', 'cr_fm/view/');
        $data['em_user'] = $this->user_m->get_em_users();
        $this->_message_if_null($data['em_user'], '员工列表为空，请先添加员工', 'em/view/');
        $data['class'] = $this->customer_class_m->get_class();
        $this->_message_if_null($data['class'], '客户分类为空，请先添加分类', 'cr_gm/view/');
        $data['level'] = $this->customer_level_m->get_level();
        $this->_message_if_null($data['level'], '客户级别为空，请先添加级别', 'cr_lm/view/');
        $data['province'] = $this->customer_m->get_district(1);
        $this->_template('cr_customer_add_v', $data);
    }

    // ------------------------------------------------------------------------
    /**
     * 地区AJAX
     *
     * @access  public
     * @return  void
     */
    public function ajax($is_address = 0) {
        $address = $is_address ? '_address' : '';
        $city = $this->input->get('city');
        $province = $this->input->get('province');
        if ($province) {
            $data['city'] = $this->customer_m->get_district(2, $province);
            echo "<span class='_city$address'>";
            echo "<select onchange='queryArea$address(this.options[this.selectedIndex].value)'
                name='city_id$address' style='width:auto' class='normal'>\n";
            echo "<option selected='selected' value=''>请选择城市</option>";
            foreach ($data['city'] as $key) {
                echo "<option value='$key->id:$key->name'>$key->name</option>\n";
            }
            echo "</select>\n";
            echo "</span>";
        }
        if ($city) {
            $data['area'] = $this->customer_m->get_district(3, $city);
            echo "<span class='_area$address'>";
            echo "<select name='area_id$address' style='width:auto' class='normal'>\n";
            echo "<option selected='selected' value=''>请选择地区</option>";
            foreach ($data['area'] as $key) {
                echo "<option value='$key->id:$key->name'>$key->name</option>\n";
            }
            echo "</select>\n";
            echo "</span>";
        }
    }

    // ------------------------------------------------------------------------

    /**
     * 增加未分配客户
     *
     * @access  public
     * @return  void
     */
    public function add_0_customer() {
        if ($data = $this->_get_form_data(0)) {
            $this->customer_m->add_customer($data);
            $this->_message('客户添加成功!', 'cr/add_customer', TRUE);
        } else {
            $this->add_customer();
        }
    }

    // ------------------------------------------------------------------------

    /**
     * 增加跟进中客户
     *
     * @access  public
     * @return  void
     */
    public function add_1_customer() {
        if ($data = $this->_get_form_data(1)) {
            $this->customer_m->add_customer($data);
            $this->_message('客户添加成功!', 'cr/add_customer', TRUE);
        } else {
            $this->add_customer();
        }
    }

    // ------------------------------------------------------------------------

    /**
     * 增加有效客户
     *
     * @access  public
     * @return  void
     */
    public function add_2_customer() {
        if ($data = $this->_get_form_data(2)) {
            $this->customer_m->add_customer($data);
            $this->_message('客户添加成功!', 'cr/add_customer', TRUE);
        } else {
            $this->add_customer();
        }
    }

    // ------------------------------------------------------------------------

    /**
     * 分配客户
     *
     * @access  public
     * @return  void
     */
    public function allot_customer() {
        if ($data = $this->_get_form_data(2)) {
            $this->customer_m->add_customer($data);
            $this->_message('客户添加成功!', 'cr/add_customer', TRUE);
        } else {
            $this->add_customer();
        }
    }

    // ------------------------------------------------------------------------

    /**
     * 获取post提交数据
     *
     * @access  public
     * @return  void
     */
    public function _get_form_data($add = 0) {
        $required_gj = $required_yx = $required_province = $required_city = $required_area = $required_tg = '';
        if ($add >= 1) {
            $required_gj = '|required';
        }
        if ($add == 2) {
            $required_yx = '|required';
        }
        $this->load->library('form_validation');
        $this->form_validation->set_rules('from_id', '客户来源', 'trim|required|is_natural');
        $this->form_validation->set_rules('from_detail', '客户来源详细', 'trim');
        $this->form_validation->set_rules('status_id', '客户状态', 'trim|required|is_natural');
        $this->form_validation->set_rules('customer_name', '客户姓名', 'trim|required');
        $this->form_validation->set_rules('tel', '客户电话', 'trim|required|is_natural');
        $this->form_validation->set_rules('fax', '客户传真', 'trim');
        $this->form_validation->set_rules('channel', '客户渠道', 'trim');
        $this->form_validation->set_rules('brand', '代理品牌', 'trim');
        $this->form_validation->set_rules('company', '客户公司或行业', 'trim');
        $this->form_validation->set_rules('intention', '客户意向或备注', 'trim');
        $this->form_validation->set_rules('address', '客户所在地具体位置', 'trim');
        $this->form_validation->set_rules('province_id_address', '客户所在地省份', 'trim' . $required_gj);
        $this->form_validation->set_rules('city_id_address', '客户所在地城市', 'trim' . $required_gj);
        $this->form_validation->set_rules('area_id_address', '客户所在地县区', 'trim' . $required_gj);
        $this->form_validation->set_rules('user_id', '负责人', 'trim|is_natural' . $required_gj);
        $this->form_validation->set_rules('class_id', '客户分组', 'trim|is_natural' . $required_yx);
        $this->form_validation->set_rules('level_id', '客户级别', 'trim|is_natural' . $required_yx);
        $this->form_validation->set_rules('district_level', '代理级别', 'trim|is_natural' . $required_yx);
        $district_level = $this->input->post('district_level', TRUE);
        if ($district_level == 1) {
            $required_province = '|required';
        }
        if ($district_level == 2 || $district_level == 3) {
            $required_city = '|required';
        }
        if ($district_level == 4) {
            $required_area = '|required';
        }
        if ($district_level == 5) {
            $required_tg = '|required';
        }
        $this->form_validation->set_rules('province_id', '省份', 'trim' . $required_province);
        $this->form_validation->set_rules('city_id', '城市', 'trim' . $required_city);
        $this->form_validation->set_rules('area_id', '县区', 'trim' . $required_area);
        $this->form_validation->set_rules('group_buy', '团购单位', 'trim' . $required_tg);
        if ($this->form_validation->run() == FALSE) {
            return FALSE;
        } else {
            $data['from_id'] = $this->input->post('from_id', TRUE);
            $data['from_detail'] = $this->input->post('from_detail', TRUE);
            $data['status_id'] = $this->input->post('status_id', TRUE);
            $data['customer_name'] = $this->input->post('customer_name', TRUE);
            $data['tel'] = $this->input->post('tel', TRUE);
            $data['fax'] = $this->input->post('fax', TRUE);
            $province_address = explode(':', $this->input->post('province_id_address', TRUE));
            $city_address = explode(':', $this->input->post('city_id_address', TRUE));
            $area_address = explode(':', $this->input->post('area_id_address', TRUE));
            $data['address'] = $province_address[1].$city_address[1].$area_address[1].$this->input->post('address', TRUE);
            $data['channel'] = $this->input->post('channel', TRUE);
            $data['brand'] = $this->input->post('brand', TRUE);
            $data['company'] = $this->input->post('company', TRUE);
            $data['intention'] = $this->input->post('intention', TRUE);
            $data['user_id'] = $this->input->post('user_id', TRUE);
            $data['user_detail'] = $data['user_id'] ?
                    $this->user_m->get_employment_by_userid($data['user_id'])->fullname .
                    ':' . $this->user_m->get_employment_by_userid($data['user_id'])->tel : '';
            $data['class_id'] = $this->input->post('class_id', TRUE);
            $data['level_id'] = $this->input->post('level_id', TRUE);
            $data['district_level'] = $this->input->post('district_level', TRUE);
            $province = explode(':', $this->input->post('province_id', TRUE));
            $city = explode(':', $this->input->post('city_id', TRUE));
            $area = explode(':', $this->input->post('area_id', TRUE));
            switch ($data['district_level']) {
                case 1:
                    $data['district_id'] = $province[0];
                    $data['district_detail'] = $province[1];
                    break;
                case 2:
                    $data['district_id'] = $city[0];
                    $data['district_detail'] = $province[1] . $city[1];
                    break;
                case 3:
                    $data['district_id'] = $city[0];
                    $data['district_detail'] = $province[1] . $city[1];
                    break;
                case 4:
                    $data['district_id'] = $area[0];
                    $data['district_detail'] = $province[1] . $city[1] . $area[1];
                    break;
                case 5:
                    $data['district_id'] = 0;
                    $data['district_detail'] = $this->input->post('group_buy', TRUE);
                    break;
            }
            $data['entry_user'] = $this->_admin->fullname . ':' . $this->_admin->user_id;
            $data['create_time'] = date('Y-m-d H:i:s');
            return $data;
            var_dump($data);
        }
    }

    // ------------------------------------------------------------------------    
}

/* End of file cr.php */
/* Location: ./admin/controllers/cr.php */