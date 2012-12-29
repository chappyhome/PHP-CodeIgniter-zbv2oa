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
class _System extends Admin_Controller {

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
    public function leftmenu($menu_id = 1) {
        $this->acl->show_left_menus($menu_id);
    }

    /**
     * 信息处理
     *
     * @access  public
     * @return  void
     */
    public function info($code) {
        if ($code == '403') {
            echo '<script type="text/javascript">alertMsg.error("您的权限不足，不能操作此栏目！",{okCall:function(){  
                    if ($.pdialog) $.pdialog.checkTimeout();  
                    if (navTab) navTab.checkTimeout();  
                    // 关闭当前Tab  
                    navTab.closeCurrentTab();
                }});</script>';
        }
        if ($code == '001') {
            echo '<script type="text/javascript">alertMsg.error("权限或菜单文件丢失！",{okCall:function(){  
                    if ($.pdialog) $.pdialog.checkTimeout();  
                    if (navTab) navTab.checkTimeout();  
                    // 关闭当前Tab  
                    navTab.closeCurrentTab();
                }});</script>';
            
        }
    }

    // ------------------------------------------------------------------------
}

/* End of file ss.php */
/* Location: ./admin/controllers/ss.php */