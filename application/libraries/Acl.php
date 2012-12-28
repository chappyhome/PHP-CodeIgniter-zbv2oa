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
 * ZBV2OA 后台权限控制类
 * @author      Binarx
 */
class Acl {

    /**
     * ci
     * CI超级类句柄
     *
     * @var object
     * @access  private
     * */
    private $ci = NULL;

    /**
     * t_menus
     * 菜单集合
     *
     * @var array
     * @access  private
     * */
    public $_menus = array();

    /**
     * _class
     *
     * @var string 当前类
     * @access  private
     * */
    private $_class = '';

    /**
     * _method
     * 当前方法
     *
     * @var string
     * @access  private
     * */
    private $_method = '';

    /**
     * _role
     * 当前用户权限ID
     *
     * @var array
     * @access private
     */
    private $_role = array();

    /**
     * _current_level_1_menu
     * 当前操作所属的一级菜单
     * 
     * @var int
     * @access privete
     */
    private $_current_level_1_menu = -1;

    /**
     * _current_level_2_menu
     * 当前操作所属的二级菜单
     * 
     * @var int
     * @access privete
     */
    private $_current_level_2_menu = -1;

    /**
     * _current_level_3_menu
     * 当前操作所属的三级菜单
     * 
     * @var int
     * @access privete
     */
    private $_current_level_3_menu = -1;

    /**
     * 构造函数
     *
     * @access  public
     * @return  void
     */
    public function __construct() {
        $this->ci = & get_instance();
        $this->ci->load->library('session');
        $this->ci->load->model(array('user_m'));
        $this->ci->load->helper('file');
        $this->_class = $this->ci->uri->rsegment(1);
        $this->_method = $this->ci->uri->rsegment(2);
        $user_role_id = $this->ci->user_m->get_full_user_by_username($this->ci->session->userdata('user_id'), 'uid')->role_id;
        $this->_menus = json_decode(read_file("./application/date/menu_$user_role_id.php"), TRUE);
        $this->_role = json_decode(read_file("./application/date/role_$user_role_id.php"), TRUE);
        if (empty($this->_menus) || empty($this->_role)) {
            redirect(site_url('debug/index/[acl.__construct]/获取权限和菜单文件失败'));
        }
        $this->_current_level_menu();
    }

// ------------------------------------------------------------------------

    /**
     * 输出顶部菜单
     *
     * @access  public
     * @return  void
     */
    public function show_top_menus() {
        foreach ($this->_menus as $key) {
            $link = site_url("_menu/left/" . "$key[menu_id]");
            $name = $key['menu_name'];
            echo '<li><a href="' . $link . '"><span>' . $name . '</span></a></li>';
        }
    }

// ------------------------------------------------------------------------

    /**
     * 输出边栏菜单
     *
     * @access  public
     * @return  void
     */
    public function show_left_menus($menu_id) {
        foreach ($this->_menus as $key) {
            if ($key['menu_id'] == $menu_id) {
                echo '<div class="accordion" fillSpace="sidebar">';
                echo '<div class="accordionHeader"><h2><span>Folder</span>'.$key['menu_name'].'</h2></div>';
                echo '<div class="accordionContent">';
                echo '<ul class="tree treeFolder expand">';
                foreach ($key['level_2'] as $i) {
                    if (!empty($i)) {
                        echo '<li><a>' . $i['menu_name'] . '</a>';
                        if (isset($i['level_3'])) {
                            echo '<ul>';
                            foreach ($i['level_3'] as $j) {
                                $link = site_url("$j[right_class]/$j[right_method]");
                                $name = $j['menu_name'];
                                echo '<li><a href="' . $link . '" target="navTab" rel="' . $j['right_class'] . '_' . $j['right_method'] . '">' . $name . '</a></li>';
                            }
                            echo '</ul>';
                        }
                    }
                }
                echo '</div>';
                echo '</div>';
            }
        }
    }

// ------------------------------------------------------------------------
    /**
     * 判断当前操作所属的各项菜单
     * @access private
     * @return void
     */
    private function _current_level_menu() {
        foreach ($this->_menus as $key) {
            foreach ($key['level_2'] as $m) {
                if (!empty($m)) {
                    foreach ($m['level_3'] as $n) {
                        if ($n['right_class'] === $this->_class) {
                            $this->_current_level_1_menu = $key['menu_id'];
                            $this->_current_level_2_menu = $m['menu_id'];
                            break;
                        }
                    }
                    foreach ($m['level_3'] as $n) {
                        if ($n['right_class'] === $this->_class && $n['right_method'] === $this->_method) {
                            $this->_current_level_1_menu = $key['menu_id'];
                            $this->_current_level_2_menu = $m['menu_id'];
                            $this->_current_level_3_menu = $n['menu_id'];
                            break;
                        }
                    }
                }
            }
        }
    }

// ------------------------------------------------------------------------
    /**
     * 检测权限
     *
     * @access  public
     * @return  void
     */
    public function permit() {
        $ok = 0;
        foreach ($this->_role as $key) {
            if ($key['right_class'] == $this->_class && $key['right_method'] == $this->_method) {
                $ok = 1;
                break;
            }
        }
        if ($ok == 1 || strstr($this->_method, 'ajax')) {
            return 1;
        } else {
            return 0;
        }
    }

// ------------------------------------------------------------------------
    /**
     * 当前位置
     * 
     * @access public
     * @return array
     */
    public function current_location() {
        $this->ci->load->database();
        $data[1] = $this->ci->db->select('menu_name,right_class,right_method')
                ->where('menu_id', $this->_current_level_1_menu)
                ->join('zb_right', 'zb_right.right_id = zb_menu.right_id')
                ->get('zb_menu')
                ->row();
        $data[2] = $this->ci->db->select('menu_name,right_class,right_method')
                ->where('menu_id', $this->_current_level_2_menu)
                ->join('zb_right', 'zb_menu.right_id = zb_right.right_id')
                ->get('zb_menu')
                ->row();
        $data[3] = $this->ci->db->select('menu_name,right_class,right_method')
                ->where('menu_id', $this->_current_level_3_menu)
                ->join('zb_right', 'zb_menu.right_id = zb_right.right_id')
                ->get('zb_menu')
                ->row();
        for ($i = 1; $i <= 3; $i++) {
            if ($data[$i]) {
                $k = $data[$i]->right_class . '/' . $data[$i]->right_method;
                $link = site_url($k);
                $menu[$i] = '<a href="' . $link . '"/>' . $data[$i]->menu_name . '</a>';
            } else {
                $menu[$i] = NULL;
            }
        }
        return $menu;
    }

// ------------------------------------------------------------------------   
}

/* End of file Acl.php */
/* Location: ./application/libraries/Acl.php */