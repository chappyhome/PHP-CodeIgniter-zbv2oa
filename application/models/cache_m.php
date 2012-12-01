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
 * DiliCMS 缓存操作模型
 * @author      Jeongee
 */
class Cache_m extends CI_Model {

    /**
     * 构造函数
     *
     * @access  public
     * @return  void
     */
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('file');
        $this->_create_folder();
    }

    // ------------------------------------------------------------------------
    /**
     * 更新所有的菜单缓存
     *
     * @access  public
     * @return  void
     */
    public function update_menu_cache() {
        $array = $this->db->get('zb_role')->result_array();
        foreach ($array as $key) {
            $this->_update_menu_cache($key['role_id']);
        }
    }

    // ------------------------------------------------------------------------    
    /**
     * 更新所有的权限缓存
     *
     * @access  public
     * @return  void
     */
    public function update_role_cache() {
        $array = $this->db->get('zb_role')->result_array();
        foreach ($array as $key) {
            $this->_update_role_cache($key['role_id']);
        }
    }

    // ------------------------------------------------------------------------

    /**
     * 更新指定Role_id的菜单缓存
     *
     * @access  public
     * @param int $role_id 权限ID
     * @return  void
     */
    public function _update_menu_cache($role_id = 0) {
        //获取role_id对应的权限right的数组
        $right_str = $this->db->select('rights')
                ->where('role_id', $role_id)
                ->get('zb_role')
                ->row();
        $right_arr = explode(',', $right_str->rights);
        $menus_arr = array();
        foreach ($right_arr as $key) {
            $level_1_menus = $this->db->select('menu_id, menu_name, zb_menu.right_id, right_class, right_method')
                    ->where('zb_menu.right_id', $key)
                    ->where('menu_level', 0)
                    ->where('menu_parent', 0)
                    ->join('zb_right', 'zb_menu.right_id = zb_right.right_id')
                    ->get('zb_menu')
                    ->result_array();
            foreach ($level_1_menus as & $i) {
                $level_2_menus = $this->db->select('menu_id, menu_name, zb_menu.right_id, right_class, right_method')
                        ->where('menu_level', 1)
                        ->where('menu_parent', $i['menu_id'])
                        ->join('zb_right', 'zb_menu.right_id = zb_right.right_id')
                        ->order_by('order')
                        ->get('zb_menu')
                        ->result_array();
                foreach ($level_2_menus as & $j) {
                    $level_3_menus = $this->db->select('menu_id, menu_name, zb_menu.right_id, right_class, right_method')
                            ->where_in('zb_menu.right_id', $right_arr)
                            ->where('menu_level', 2)
                            ->where('menu_parent', $j['menu_id'])
                            ->join('zb_right', 'zb_menu.right_id = zb_right.right_id')
                            ->order_by('order')
                            ->get('zb_menu')
                            ->result_array();
                    $j['level_3'] = $level_3_menus;
                    if (empty($level_3_menus)) {
                        $j = array();
                    }
                }
                $i['level_2'] = $level_2_menus;
            }
            $menus_arr = array_merge_recursive($menus_arr, $level_1_menus);
        }
        $menus_json = json_encode($menus_arr);
        write_file("./application/date/menu_$role_id.php", $menus_json);
    }

    // ------------------------------------------------------------------------

    /**
     * 更新指定Role_id的用户组缓存
     *
     * @access  public
     * @param int $role_id 权限ID
     * @return  void
     */
    public function _update_role_cache($role_id = 0) {
        //获取role_id对应的权限right的数组
        $right_str = $this->db->select('rights')
                ->where('role_id', $role_id)
                ->get('zb_role')
                ->row();
        $right_arr = explode(',', $right_str->rights);
        $right = array();
        foreach ($right_arr as & $key) {
            $i = $this->db->select('right_id,right_name,right_class,right_method')
                    ->where('right_id', $key)
                    ->get('zb_right')
                    ->result_array();
            $right = array_merge_recursive($right, $i);
        }
        $right_json = json_encode($right);
        write_file("./application/date/role_$role_id.php", $right_json);
    }

    // ------------------------------------------------------------------------

    /**
     * 更新站点信息缓存
     *
     * @access  public
     * @return  void
     */
    /* public function update_site_cache() {
      $data = $this->db->get($this->db->dbprefix('site_settings'))->row_array();
      $this->platform->cache_write(DILICMS_SHARE_PATH . 'settings/site.php', array_to_cache("setting", $data));
      } */

    // ------------------------------------------------------------------------

    /**
     * 更新后台设置缓存
     *
     * @access  public
     * @return  void
     */
    /* public function update_backend_cache() {
      $data = $this->db->get($this->db->dbprefix('backend_settings'))->row_array();
      $this->platform->cache_write(DILICMS_SHARE_PATH . 'settings/backend.php', array_to_cache("setting", $data));
      } */

    // ------------------------------------------------------------------------

    /**
     * 判断是否存在对应文件夹，若不存在则创建
     *
     * @access  private
     * @return  void
     */
    private function _create_folder() {
        if (!file_exists('./application/date/')) {
            mkdir('./application/date/');
        }
    }
    // ------------------------------------------------------------------------
}

/* End of file cache_mdl.php */
/* Location: ./shared/models/cache_mdl.php */