<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>首页----Powered By Binarx</title>
        <base href="<?php echo base_url(); ?>" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="theme/images/admin.css" />
        <script language="javascript" src="theme/js/jquery.js"></script>
        <script language="javascript" src="theme/js/admin.js"></script>
    </head>
    <body>
        <div class="container">
            <div id="header">
                <div class="logo">
                    <img src="theme/images/logo.gif" />
                </div>
                <div id="menu">
                    <ul name="menu">
                        <?php  $this->acl->show_top_menus(); ?>
                    </ul>
                </div>
                <p>
                    <a href="<?php echo site_url('index/quit'); ?>">退出管理</a>
                    <a href="<?php echo site_url('system/home'); ?>">后台首页</a>
                    <a href="<?php echo site_url('/'); ?>" target='_blank'>站点首页</a>
                    <span>您好 <label class='bold'><?php echo $this->_admin->user_name; ?></label>，
                        当前身份 <label class='bold'><?php echo $this->_admin->role_name; ?></label></span>
                </p>
            </div>
            <div id="info_bar">
                <span class="nav_sec">    	
                    <!-- 站点提示信息 -->
                </span></div>
            <div id="admin_left">
                <ul class="submenu">
                    <?php  $this->acl->show_left_menus(); ?>
                </ul>
            </div>
            <div id="admin_right">
                    <?php
                    
                        $this->load->view(isset($tpl) && $tpl ? $tpl : 'default_v');
                   
                    ?>
            </div>
            <div id="separator"></div>
        </div>
        <script type='text/javascript'>
            //隔行换色
            $(".list_table tr::nth-child(even)").addClass('even');
            $(".list_table tr").hover(
            function () {
                $(this).addClass("sel");
            },
            function () {
                $(this).removeClass("sel");
            }
        );
        </script>
    </body>
</html>
