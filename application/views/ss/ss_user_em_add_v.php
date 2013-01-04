<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="pageContent">
    <form method="post" action="<?php echo site_url('ss_user/add_em_user/submit'); ?>" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
        <div class="pageFormContent" layoutH="56">
            <dl>
                <dt>所属部门：</dt>
                <dd>
                    <input id="department_id" name="department.department_id" value="" type="hidden"/>
                    <input class="required readonly textInput" name="department.department_name" type="text" suggestFields="department_name" 
                           suggestUrl="<?php echo site_url('ss_user/add_em_user/department'); ?>" lookupGroup="department"/>
                </dd>
            </dl>
            <dl>
                <dt>关联员工：</dt>
                <dd>
                    <input id="user_id" name="user_id" value="" type="hidden"/>
                    <input class="required readonly textInput" name="fullname" type="text"  suggestFields="fullname" 
                           suggestUrl="<?php echo site_url('ss_user/add_em_user/user') . '?department_id={department_id}'; ?>" warn="请先选择部门" lookupGroup=""/>
                </dd>
            </dl>
            <dl>
                <dt>用户名：</dt>
                <dd><input name="user_name_add" class="required textInput"  minlength="4" maxlength="20" type="text" value="" /></dd>
            </dl>
            <dl>
                <dt>用户密码：</dt>
                <dd><input id="user_pw" name="password" class="required alphanumeric" minlength="6" maxlength="16" type="password" value="" /></dd>
            </dl>
            <dl>
                <dt>重复密码：</dt>
                <dd><input name="password_ok" class="required textInput" type="password" equalto="#user_pw" value="" /></dd>
            </dl>
            <dl>
                <dt>权限组：</dt>
                <dd>
                    <input name="role_id" value="" type="hidden">
                    <input class="required" name="role_name" type="text" suggestFields="role_name" 
                           suggestUrl="<?php echo site_url('ss_user/add_em_user/role'); ?>" lookupGroup=""/>
                </dd>
            </dl>
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
