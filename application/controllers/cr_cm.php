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
        $this->load->model(array());
    }

// ------------------------------------------------------------------------

    /**
     * 客服关系默认页
     *
     * @access  public
     * @return  void
     */
    public function my() {
        $this->_template('default_v');
    }

// ------------------------------------------------------------------------
}

/* End of file cr_cm.php */
/* Location: ./admin/controllers/cr_cm.php */