<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=7" />
        <title>智拓企业管理平台</title>
        <base href="<?php echo base_url(); ?>" />
        <link href="public/dwz/themes/default/style.css" rel="stylesheet" type="text/css" media="screen"/>
        <link href="public/dwz/themes/css/core.css" rel="stylesheet" type="text/css" media="screen"/>
        <link href="public/dwz/themes/css/print.css" rel="stylesheet" type="text/css" media="print"/>
        <link href="public/uploadify/css/uploadify.css" rel="stylesheet" type="text/css" media="screen"/>
        <!--[if IE]>
        <link href="public/dwz/themes/css/ieHack.css" rel="stylesheet" type="text/css" media="screen"/>
        <![endif]-->
        <style type="text/css">
            #header{height:85px}
            #leftside, #container, #splitBar, #splitBarProxy{top:90px}
        </style>

        <script src="public/dwz/js/speedup.js" type="text/javascript"></script>
        <script src="public/dwz/js/jquery-1.7.2.min.js" type="text/javascript"></script>
        <script src="public/dwz/js/jquery.cookie.js" type="text/javascript"></script>
        <script src="public/dwz/js/jquery.validate.js" type="text/javascript"></script>
        <script src="public/dwz/js/jquery.bgiframe.js" type="text/javascript"></script>
        <script src="public/xheditor/xheditor-1.1.14-zh-cn.min.js" type="text/javascript"></script>
        <script src="public/uploadify/scripts/swfobject.js" type="text/javascript"></script>
        <script src="public/uploadify/scripts/jquery.uploadify.v2.1.0.js" type="text/javascript"></script>
        <!-- svg图表  supports Firefox 3.0+, Safari 3.0+, Chrome 5.0+, Opera 9.5+ and Internet Explorer 6.0+ -->
<!--        <script type="text/javascript" src="chart/raphael.js"></script>
        <script type="text/javascript" src="chart/g.raphael.js"></script>
        <script type="text/javascript" src="chart/g.bar.js"></script>
        <script type="text/javascript" src="chart/g.line.js"></script>
        <script type="text/javascript" src="chart/g.pie.js"></script>
        <script type="text/javascript" src="chart/g.dot.js"></script>-->

        <script src="public/dwz/js/dwz.core.js" type="text/javascript"></script>
        <script src="public/dwz/js/dwz.util.date.js" type="text/javascript"></script>
        <script src="public/dwz/js/dwz.validate.method.js" type="text/javascript"></script>
        <script src="public/dwz/js/dwz.regional.zh.js" type="text/javascript"></script>
        <script src="public/dwz/js/dwz.barDrag.js" type="text/javascript"></script>
        <script src="public/dwz/js/dwz.drag.js" type="text/javascript"></script>
        <script src="public/dwz/js/dwz.tree.js" type="text/javascript"></script>
        <script src="public/dwz/js/dwz.accordion.js" type="text/javascript"></script>
        <script src="public/dwz/js/dwz.ui.js" type="text/javascript"></script>
        <script src="public/dwz/js/dwz.theme.js" type="text/javascript"></script>
        <script src="public/dwz/js/dwz.switchEnv.js" type="text/javascript"></script>
        <script src="public/dwz/js/dwz.alertMsg.js" type="text/javascript"></script>
        <script src="public/dwz/js/dwz.contextmenu.js" type="text/javascript"></script>
        <script src="public/dwz/js/dwz.navTab.js" type="text/javascript"></script>
        <script src="public/dwz/js/dwz.tab.js" type="text/javascript"></script>
        <script src="public/dwz/js/dwz.resize.js" type="text/javascript"></script>
        <script src="public/dwz/js/dwz.dialog.js" type="text/javascript"></script>
        <script src="public/dwz/js/dwz.dialogDrag.js" type="text/javascript"></script>
        <script src="public/dwz/js/dwz.sortDrag.js" type="text/javascript"></script>
        <script src="public/dwz/js/dwz.cssTable.js" type="text/javascript"></script>
        <script src="public/dwz/js/dwz.stable.js" type="text/javascript"></script>
        <script src="public/dwz/js/dwz.taskBar.js" type="text/javascript"></script>
        <script src="public/dwz/js/dwz.ajax.js" type="text/javascript"></script>
        <script src="public/dwz/js/dwz.pagination.js" type="text/javascript"></script>
        <script src="public/dwz/js/dwz.database.js" type="text/javascript"></script>
        <script src="public/dwz/js/dwz.datepicker.js" type="text/javascript"></script>
        <script src="public/dwz/js/dwz.effects.js" type="text/javascript"></script>
        <script src="public/dwz/js/dwz.panel.js" type="text/javascript"></script>
        <script src="public/dwz/js/dwz.checkbox.js" type="text/javascript"></script>
        <script src="public/dwz/js/dwz.history.js" type="text/javascript"></script>
        <script src="public/dwz/js/dwz.combox.js" type="text/javascript"></script>
        <script src="public/dwz/js/dwz.print.js" type="text/javascript"></script>
        <!--
        <script src="bin/dwz.min.js" type="text/javascript"></script>
        -->
        <script src="public/dwz/js/dwz.regional.zh.js" type="text/javascript"></script>

        <script type="text/javascript">
            $(function(){
                DWZ.init("public/dwz/dwz.frag.xml", {
                    //loginUrl:"login_dialog.html", loginTitle:"登录",	// 弹出登录对话框
                    loginUrl:"<?php echo site_url('login'); ?>",	// 跳到登录页面
                    statusCode:{ok:200, error:300, timeout:301}, //【可选】
                    pageInfo:{pageNum:"pageNum", numPerPage:"numPerPage", orderField:"orderField", orderDirection:"orderDirection"}, //【可选】
                    debug:true,	// 调试模式 【true|false】
                    callback:function(){
                        initEnv();
                        $("#themeList").theme({themeBase:"themes"});
                        setTimeout(function() {$("#sidebar .toggleCollapse div").trigger("click");}, 10);
                    }
                });
            });
        </script>
    </head>

    <body scroll="no">
        <div id="layout">
            <div id="header">
                <div class="headerNav">
                    <a class="logo" href="#">智拓企业管理</a>
                    <ul class="nav">
                        <li id="switchEnvBox"><a href="javascript:">（<span>默认</span>）快速切换</a>
                            <ul>
                                <li><a href="sidebar_1.html">北京</a></li>
                                <li><a href="sidebar_2.html">上海</a></li>
                                <li><a href="sidebar_2.html">南京</a></li>
                                <li><a href="sidebar_2.html">深圳</a></li>
                                <li><a href="sidebar_2.html">广州</a></li>
                                <li><a href="sidebar_2.html">天津</a></li>
                                <li><a href="sidebar_2.html">杭州</a></li>
                            </ul>
                        </li>
                        <li><a href="https://me.alipay.com/zzhoubbin" target="_blank">捐赠</a></li>
                        <li><a href="changepwd.html" target="dialog" width="600">设置</a></li>
                        <li><a href="http://www.zbv2.com/" target="_blank">博客</a></li>
                        <li><a href="mailto:binarx@gmail.com" target="_blank">邮箱</a></li>
                        <li><a href="<?php echo site_url('login/quit') ?>">退出</a></li>
                    </ul>
                    <ul class="themeList" id="themeList">
                        <li theme="default"><div class="selected">蓝色</div></li>
                        <li theme="green"><div>绿色</div></li>
                        <li theme="purple"><div>紫色</div></li>
                        <li theme="silver"><div>银色</div></li>
                        <li theme="azure"><div>天蓝</div></li>
                    </ul>
                </div>

                <div id="navMenu">
                    <ul>
                        <?php $this->acl->show_top_menus(); ?>
                    </ul>
                </div>
            </div>

            <div id="leftside">
                <div id="sidebar_s">
                    <div class="collapse">
                        <div class="toggleCollapse"><div></div></div>
                    </div>
                </div>
                <div id="sidebar">
                    <div class="toggleCollapse"><h2>当前登录：<?php echo $this->_admin->user_name; ?></h2><div>收缩</div></div>

                    <div class="accordion" fillSpace="sidebar">
                        <div class="accordionHeader">
                            <h2><span>Folder</span>常用功能</h2>
                        </div>
                        <div class="accordionContent">
                            <ul class="tree treeFolder">
                                <li><a>主框架面板</a>
                                    <ul>
                                        <li><a href="main.html" target="navTab" rel="main">我的主页</a></li>
                                    </ul>
                                </li>

                                <li><a>常用组件</a>
                                    <ul>
                                        <li><a href="<?php echo site_url('test/date/'); ?>" target="navTab" rel="test_view">面板</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div id="container">
                <div id="navTab" class="tabsPage">
                    <div class="tabsPageHeader">
                        <div class="tabsPageHeaderContent"><!-- 显示左右控制时添加 class="tabsPageHeaderMargin" -->
                            <ul class="navTab-tab">
                                <li tabid="main" class="main"><a href="javascript:;"><span><span class="home_icon">我的主页</span></span></a></li>
                            </ul>
                        </div>
                        <div class="tabsLeft">left</div><!-- 禁用只需要添加一个样式 class="tabsLeft tabsLeftDisabled" -->
                        <div class="tabsRight">right</div><!-- 禁用只需要添加一个样式 class="tabsRight tabsRightDisabled" -->
                        <div class="tabsMore">more</div>
                    </div>
                    <ul class="tabsMoreList">
                        <li><a href="javascript:;">我的主页</a></li>
                    </ul>
                    <div class="navTab-panel tabsPageContent layoutBox">
                        <div class="page unitBox">
                            <div class="accountInfo">
                                <div class="alertInfo">
                                    <h2>最新消息：</h2>
                                    <a href="">关于公司元旦放假的通知</a>
                                </div>
                                <div class="right">
                                    <p>待办工作 <a href="">3</a> 项，消息 <a href="">2</a> 条</p>
                                    <p>07月12日，星期二</p>
                                </div>
                                <p><span>河南泰森宝酒业有限公司</span></p>
                                <p>用户：<a href="" target="_blank">周斌</a></p>
                            </div>
                            <div class="pageFormContent" layoutH="80">
                                <p style="color:red">企业官网 <a href="http://www.xgtsb.com" target="_blank">http://www.xgtsb.com</a></p>
                                <p style="color:red">企业微博 <a href="http://weibo.com/xgtsb" target="_blank">http://weibo.com/xgtsb</a></p>
                                <div class="divider"></div>
                                <h2>个人信息</h2>
                                <div class="unit">员工姓名：<?php echo $this->_admin->fullname; ?></div>
                                <div class="unit">所属部门：电商部</div>
                                <div class="unit">登录帐号：<?php echo $this->_admin->user_name; ?></div>
                                <div class="unit">用户组：<?php echo $this->_admin->role_name; ?></div>
                                <div class="unit">登录IP：<?php echo $this->input->ip_address(); ?></div>
                                <div class="divider"></div>
                                <h2>企业信息</h2>
                                <div class="unit">企业名称：河南泰森宝酒业有限公司</div>
                                <div class="unit">当前员工数：18</div>
                                <div class="unit">公司电话：前台： 招商： 财务： 总经理： 传真：</div>
                                <div class="unit">公司地址：郑州市经二路中州都会广场3号楼903</div>
                                <div class="divider"></div>
                                <h2>平台信息</h2>
                                <div class="unit">平台版本：<?php echo SYS_VERSION; ?>(CI:<?php echo CI_VERSION; ?>)</div>
                                <div class="unit">服务器IP：<?php echo getHostByName(php_uname('n')) . ':' . $_SERVER['SERVER_PORT']; ?></div>
                                <div class="unit">当前编码：UTF-8</div>
                                <div class="unit">脚本语言：<?php echo 'PHP' . PHP_VERSION; ?></div>
                                <div class="unit">数据库：<?php echo 'MySQL' . $this->db->version(); ?></div>
                                <div class="unit">当前时区：<?php echo date_default_timezone_get(); ?></div>
                                <div class="unit">上传上限：<?php echo @ini_get('upload_max_filesize'); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div id="footer">Copyright &copy; 2012 <a href="demo_page2.html" target="dialog">智拓二进制</a></div>

        <!-- 注意此处js代码用于google站点统计，非DWZ代码，请删除 -->

    </body>
</html>