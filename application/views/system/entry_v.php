<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<title>企业管理平台</title>
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

<script src="public/dwz/bin/dwz.min.js" type="text/javascript"></script>
<script src="public/dwz/js/dwz.regional.zh.js" type="text/javascript"></script>

<script type="text/javascript">
$(function(){
	DWZ.init("public/dwz/dwz.frag.xml", {
		loginUrl:"login_dialog.html", loginTitle:"登录",	// 弹出登录对话框
//		loginUrl:"login.html",	// 跳到登录页面
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
                                        <li><a href="<?php echo site_url('index/quit') ?>">退出</a></li>
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
                                    <?php  $this->acl->show_top_menus(); ?>
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
                                                        <li><a href="w_panel.html" target="navTab" rel="w_panel">面板</a></li>
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
								<h2><a href="doc/dwz-user-guide.pdf" target="_blank">DWZ框架使用手册(PDF)</a></h2>
								<a href="doc/dwz-user-guide.swf" target="_blank">DWZ框架演示视频</a>
							</div>
							<div class="right">
								<p><a href="doc/dwz-user-guide.zip" target="_blank" style="line-height:19px">DWZ框架使用手册(CHM)</a></p>
								<p><a href="doc/dwz-ajax-develop.swf" target="_blank" style="line-height:19px">DWZ框架Ajax开发视频教材</a></p>
							</div>
							<p><span>DWZ富客户端框架</span></p>
							<p>DWZ官方微博:<a href="http://weibo.com/dwzui" target="_blank">http://weibo.com/dwzui</a></p>
						</div>
						<div class="pageFormContent" layoutH="80">
							<iframe width="100%" height="430" class="share_self"  frameborder="0" scrolling="no" src="http://widget.weibo.com/weiboshow/index.php?width=0&height=430&fansRow=2&ptype=1&speed=300&skin=1&isTitle=0&noborder=1&isWeibo=1&isFans=0&uid=1739071261&verifier=c683dfe7"></iframe>
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