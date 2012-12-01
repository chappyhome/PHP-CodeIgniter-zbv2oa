<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="headbar">
    <div class="position">
        <span><?php $menu = $this->acl->current_location();echo $menu[1]; ?></span>
        <span>></span><span><?php echo $menu[2]; ?></span><span>></span>
        <span><?php echo $menu[3]; ?></span></div>
    <div class="operating">
        <a class="hack_ie" href="<?php echo site_url('ss_user/add_em_user'); ?>"><button class="operating_btn" type="button"><span class="addition">添加新用户</span></button></a>
        <div class="search f_r">
            <form name="serachuser" action="<?php echo site_url('ss_user/view'); ?>" method="get">
                <select class="normal" style="width:auto" name="role" onchange="location='<?php echo site_url('ss_user/view'); ?>/'+this.value;">
                    <option value="">选择用户组</option>
                    <?php foreach ($roles as $k => $r): ?>
                        <option <?php echo $role == $k ? 'selected="selected"' : '' ?> value="<?php echo $k; ?>"><?php echo $r; ?></option>
<?php endforeach; ?>
                </select>
            </form>
        </div>
    </div>
    <div class="field">
        <table class="list_table">
            <col width="40px" />
            <col />
            <thead>
                <tr>
                    <th></th>
                    <th>用户名称</th>
                    <th>员工姓名</th>
                    <th>用户组</th>
                    <th>帐号状态</th>
                    <th>操作选项</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<div class="content">
    <table id="list_table" class="list_table">
        <col width="40px" />
        <col />
        <tbody>
<?php foreach ($list as $v) : ?>
                <tr>
                    <td></td>
                    <td><?php echo $v->user_name; ?></td>
                    <td><?php echo $v->fullname?$v->fullname:'[ 外部用户 ]'; ?></td>
                    <td><?php echo $v->role_name; ?></td>
                    <td><?php echo $v->is_admin == 1 ? '正常' : '<b style="color:red">冻结</span>'; ?></td>
                    <td>
                        <a href="<?php echo site_url('ss_user/edit/' . $v->user_id); ?>"><img class="operator" src="theme/images/icon_edit.gif" alt="修改" title="修改"></a>
                        <a href="<?php echo site_url('ss_user/stop/' . $v->user_id); ?>"><img class="operator" src="theme/images/icon_stop.gif" alt="冻结" title="冻结"></a>
                        <a class="confirm_delete" href="<?php echo site_url('ss_user/del/' . $v->user_id); ?>"><img class="operator" src="theme/images/icon_del.gif" alt="删除" title="删除"></a>
                    </td>
                </tr>
<?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class="pages_bar pagination"><?php echo $pagination; ?></div>
<script language="javascript">
    $('a.confirm_delete').click(function(){
        return confirm('是否要删除所选用户？');	
    });
</script>