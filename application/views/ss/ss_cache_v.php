<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="pageContent">
    <form method="post" action="<?php echo site_url('ss_cache/cache'); ?>" class="pageForm" onsubmit="return validateCallback(this, navTabAjaxDone);">
	<div class="panelBar">
		<ul class="toolBar">
			<li><input type="checkbox" class="checkboxCtrl" group="cache[]" /><span>全选</span></li>
			<li><a class="edit" href="" target="navTab" onclick="$('#cache_form').submit();"><span>更新</span></a></li>
		</ul>
	</div>
	<table class="table" width="100%" layoutH="138">
		<thead>
			<tr>
				<th width="100" align="center">选择</th>
				<th width="">缓存项目</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><input type="checkbox" value="menu" name="cache[]" /></td>
                    <td>菜单缓存</td>
			</tr>
			<tr>
				<td><input type="checkbox" value="role" name="cache[]" /></td>
                    <td>权限数据缓存</td>
			</tr>
		</tbody>
	</table>
    </form>
</div>                        