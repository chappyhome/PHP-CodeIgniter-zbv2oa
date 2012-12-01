<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="headbar">
    <div class="position"><span>系统</span><span>></span><span>更新缓存</span></div>
    <div class="operating">
        <a href="javascript:void(0)" onclick="selectAll('cache[]');"><button class="operating_btn" type="button"><span class="sel_all">全选</span></button></a>
        <a href="javascript:;" onclick="$('#cache_form').submit();"><button class="operating_btn" type="button"><span class="remove">更新</span></button></a>
    </div>
    <div class="field">
        <table class="list_table">
            <col width="40px" />
            <col />
            <thead>
                <tr>
                    <th>选择</th>
                    <th>缓存名称</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<div class="content">
    <form name='cache_form' id="cache_form" method='post' action='<?php echo site_url('ss_cache/cache'); ?>'>
        <table id="list_table" class="list_table">
            <col width="40px" />
            <col />
            <tbody>               
                <tr>
                    <td><input type="checkbox" value="menu" name="cache[]" /></td>
                    <td>菜单缓存</td>
                </tr>
                <tr>
                    <td><input type="checkbox" value="role" name="cache[]" /></td>
                    <td>权限数据缓存</td>
                </tr>
<!--                <tr>
                    <td><input type="checkbox" value="site" name="cache[]" /></td>
                    <td>站点设置缓存</td>
                </tr>
                <tr>
                    <td><input type="checkbox" value="backend" name="cache[]" /></td>
                    <td>后台设置缓存</td>
                </tr>-->
            </tbody>
        </table>
    </form>
</div>