<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <base href="<?php echo base_url(); ?>" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php ?>用户登录----Powered By Binarx</title>
        <link rel="stylesheet" href="theme/images/admin.css"  type="text/css" />
    </head>
    <body id="login">
        <div class="container">
            <div id="header">
                <div class="logo">
                    <img src="theme/images/logo.gif" />
                </div>
            </div>
            <div id="wrapper" class="clearfix">
                <div class="login_box">
                    <div class="login_title">用户登录</div>
                    <div class="login_cont">
                        <b style="color:red"><?php echo validation_errors(); ?></b>
                        <b style="color:red"><?php echo $this->session->flashdata('error'); ?></b>
                        <form action='<?php echo site_url('index/checklogin'); ?>' method='post'>
                            <table class="form_table">
                                <col width="90px" />
                                <col />
                                <tr>
                                    <th>用户名：</th><td><input class="normal" type="text" name="username" value="<?php echo $cookie_username; ?>" alt="请填写用户名" /></td>
                                </tr>
                                <tr>
                                    <th>密码：</th><td><input class="normal" type="password" name="password" value="<?php echo $cookie_password; ?>" alt="请填写密码" /></td>
                                </tr>
                                <tr>
                                    <th></th><td>记住用户名和密码 <input class="remeber" type="checkbox" name="remeber" value="1" alt="记住用户名密码" />
                                        <input type="hidden" name="isremeber" value="<?php echo $isremeber; ?>" /></td>
                                </tr>
                                <tr>
                                    <th></th><td><input class="submit" type="submit" value="登录" /><input class="submit" type="reset" value="取消" /></td>
                                </tr>
                            </table>
                        </form>

                    </div>
                </div>
            </div>
            <div id="footer">Power by <a href="http://www.zbv2.com/">Binarx</a> <b>v1.0</b> Copyright &copy; 2012
            </div>
        </div>
    </body>
</html>
