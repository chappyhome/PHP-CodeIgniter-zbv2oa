<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="pageContent">
    <form method="post" action="<?php echo site_url('ss_role/edit/submit').'?id='. $role->role_id; ?>" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
        <div class="pageFormContent" layoutH="56">
            <dl>
                <dt>用户组：</dt>
                <dd><input name="role_name" class="readonly required textInput" readonly="readonly" minlength="4" maxlength="20" type="text" value="<?php echo $role->role_name ?>" /></dd>
            </dl>
            <dl>
                <dt>描述：</dt>
                <dd><input name="role_desc" class="textInput" maxlength="100" type="text" value="<?php echo $role->role_desc ?>" /></dd>
            </dl>
            <dl>
                <dt>全部选择：</dt>
                <dd><input type="checkbox" class="checkboxCtrl" group="right[]" /></dd>
            </dl>
            <div class="divider"></div>
            <fieldset>
		<legend>系统管理权限</legend>
                <?php $right_id = explode(',', $role->rights)?explode(',', $role->rights):array(); ?>
                <?php foreach ($right_ss as $key => $v): ?>
                         <label><input type="checkbox" <?php echo in_array($key, $right_id) ? 'checked="checked"' : ''; ?> value="<?php echo $key; ?>" name="right[]"><?php echo $v; ?></label>
                <?php endforeach; ?>
            </fieldset>
            <fieldset>
		<legend>人员管理权限</legend>
                <?php foreach ($right_em as $key => $v): ?>
                         <label><input type="checkbox" <?php echo in_array($key, $right_id) ? 'checked="checked"' : ''; ?> value="<?php echo $key; ?>" name="right[]"><?php echo $v; ?></label>
                <?php endforeach; ?>
            </fieldset>
            <fieldset>
		<legend>客户关系权限</legend>
                <?php foreach ($right_cr as $key => $v): ?>
                         <label><input type="checkbox" <?php echo in_array($key, $right_id) ? 'checked="checked"' : ''; ?> value="<?php echo $key; ?>" name="right[]"><?php echo $v; ?></label>
                <?php endforeach; ?>
            </fieldset>
            <fieldset>
		<legend>个人管理权限</legend>
                <?php foreach ($right_mi as $key => $v): ?>
                         <label><input type="checkbox" <?php echo in_array($key, $right_id) ? 'checked="checked"' : ''; ?> value="<?php echo $key; ?>" name="right[]"><?php echo $v; ?></label>
                <?php endforeach; ?>
            </fieldset>
        </div>
        <div class="formBar">
            <ul>
                <li>
                    <div class="buttonActive"><div class="buttonContent"><button type="submit">保存</button></div></div>
                </li>
                <li>
                    <div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div>
                </li>
            </ul>
        </div>
    </form>
</div>
