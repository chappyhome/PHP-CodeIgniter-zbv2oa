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
    }

    // ------------------------------------------------------------------------

    /**
     * 我的申请
     *
     * @access  public
     * @return  void
     */
    public function apply_list() {
        $this->_template('default_v');
    }

    // ------------------------------------------------------------------------
    
    /**
     * 等待审批
     *
     * @access  public
     * @return  void
     */
    public function reply_list() {
        $this->_template('default_v');
    }

    // ------------------------------------------------------------------------
}

/* End of file mi_wf.php */
/* Location: ./admin/controllers/mi_wf.php */