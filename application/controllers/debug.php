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
 * ZBV2OA DEBUG控制器
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
    }
    // ------------------------------------------------------------------------
    
    /**
     * 入口函数
     * @param string $from_url
     * @param string $message_url
     * @return void 
     */
    public function index($from_url = '',$message_url = '') {
        $from = urldecode($from_url);
        $message = urldecode($message_url);
        $this->_debug($from, $message);
    }
}
