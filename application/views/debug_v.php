<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <base href="<?php echo base_url(); ?>" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php ?>DEBUG----Powered By Binarx</title>
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
                    <div class="login_title">抱歉，程序出现错误！</div>
                    <div class="login_cont">
                        <p><b style="color:red">请将以下信息反馈给管理员或联系binarx@gmail.com</b></p>
                        <p>错误定位：<?php echo $from; ?></p>
                        <p>详细信息：<?php echo $message; ?></p>
                    </div>
                </div>
            </div>
            <div id="footer">Power by <a href="http://www.zbv2.com/">Binarx</a> <b>v1.0</b> Copyright &copy; 2012
            </div>
        </div>
    </body>
</html>
