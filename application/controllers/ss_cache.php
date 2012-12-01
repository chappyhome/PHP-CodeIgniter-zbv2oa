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
 * ZBV2OA 缓存相关控制器
 * @author      Binarx
 */
class Ss_cache extends Admin_Controller {

    /**
     * 构造函数
     *
     * @access  public
     * @return  void
     */
    public function __construct() {
        parent::__construct();
        $this->_check_permit();
        $this->load->model('cache_m');
    }

// ------------------------------------------------------------------------

    /**
     * 更新缓存处理函数 
     *
     * @access  private
     * @return  void
     */
    public function cache() {
        if ($this->_cache_post()) {
            $array = $this->_cache_post();
            foreach ($array as $v) {
                $method = 'update_' . $v . '_cache';
                $this->cache_m->$method();
            }
            $this->_message("缓存更新成功！", '', TRUE);
        } else {
            $this->_template('ss_cache_v');
        }
    }

    // -------------------------------------------------------------------------
    
    /**
     * 更新缓存处理post提交数据
     * @access private
     * @return boolean or array
     */

    private function _cache_post() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('cache', '要更新的缓存', 'required');
        if ($this->form_validation->run() == FALSE) {
            return FALSE;
        } else {
            $cache = $this->input->post('cache');
            $array = is_array($cache) ? $cache : array($cache);
            return $array;
        }
    }

// ------------------------------------------------------------------------
}

/* End of file ss_cache.php */
/* Location: ./admin/controllers/ss_cache.php */