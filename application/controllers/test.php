<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Test extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('cache_m');
        $this->load->helper('file');
    }

    function index($user_id = 1) {
        $this->cache_m->update_role_cache($user_id);
    }

    function acl() {
        $this->load->library('acl');
        var_dump($this->acl->_menus);
//        $this->acl->_current_level_1();
    }

    function json() {
        $arr = read_file("./application/date/menu_1.php");
        var_dump(json_decode($arr, TRUE));
    }

    function arr() {
        $fruit1 = array();
        for ($i = 1; $i <= 3; $i++) {
            $fruit1[]['no'] = $i;
            $fruit1[]['string'] = $i . $i . $i;
        }
        print_r($fruit1);
    }

    function data() {
        echo date('Y-m-d H:i:s');
    }

    function view() {
        $this->load->view('system/entry_v');
        
    }
    function leftmenu($param) {
        if($param == 1){
            $str = '
            <div class="accordion" fillSpace="sideBar">
	<div class="accordionHeader">
		<h2><span>Folder</span>界面组件</h2>
	</div>
	<div class="accordionContent">
		<ul class="tree treeFolder">
			<li><a href="tabsPage.html" target="navTab">框架面板</a></li>
		</ul>
	</div>
	<div class="accordionHeader">
		<h2><span>Folder</span>典型页面</h2>
	</div>
	<div class="accordionContent">
		<ul class="tree treeFolder treeCheck">
			<li><a href="demo_upload.html" target="navTab" rel="demo_upload">文件上传表单提交示例</a></li>
			<li><a href="demo_page1.html" target="navTab" rel="demo_page1">查询我的客户</a></li>
			<li><a href="demo_page1.html" target="navTab" rel="demo_page2">表单查询页面</a></li>
			<li><a href="demo_page4.html" target="navTab" rel="demo_page4">表单录入页面</a></li>
			<li><a href="demo_page5.html" target="navTab" rel="demo_page5">有文本输入的表单</a></li>
		</ul>
	</div>
	<div class="accordionHeader">
		<h2><span>Folder</span>流程演示</h2>
	</div>
	<div class="accordionContent">
		<ul class="tree">
			<li><a href="newPage1.html" target="dialog" rel="dlg_page">列表</a></li>
		</ul>
	</div>
</div>';
            echo $str;

        }
    }

}
