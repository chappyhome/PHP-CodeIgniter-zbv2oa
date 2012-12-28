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
 * ZBV2OA 菜单相关
 * @author      Binarx
 */
class _Menu extends Admin_Controller {

    /**
     * 构造函数
     *
     * @access  public
     * @return  void
     */
    public function __construct() {
        parent::__construct();
        //$this->_check_permit();
    }

    // ------------------------------------------------------------------------

    /**
     * 左侧菜单输出
     *
     * @access  public
     * @return  void
     */
    public function left($menu_id = 1) {
        $this->acl->show_left_menus($menu_id);
    }


}

/* End of file ss.php */
/* Location: ./admin/controllers/ss.php */