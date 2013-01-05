<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="pageContent">
    <form method="post" action="<?php echo site_url('em/edit/submit').'?id='. $em->user_id;; ?>" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
        <div class="pageFormContent" layoutH="56">
            <dl>
                <dt>姓名：</dt>
                <dd><input name="fullname" class="required textInput" maxlength="20" type="text" value="" /></dd>
            </dl>
            <dl>
                <dt>性别：</dt>
                <dd>
                    <select name="sex" class="select" style="width: 80px;">
                        <option value="男">男</option>
                        <option value="女">女</option>
                    </select>
                </dd>
            </dl>
            <dl>
                <dt>民族：</dt>
                <dd><input name="nation" class="required textInput" maxlength="30" type="text" value="" /></dd>
            </dl>
            <dl>
                <dt>婚否：</dt>
                <dd>
                    <select name="marriage" class="select" style="width: 80px;">
                        <option value="未婚">未婚</option>
                        <option value="已婚">已婚</option>
                        <option value="离异">离异</option>
                    </select>
                </dd>
            </dl>
            <dl>
                <dt>学历：</dt>
                <dd>
                    <select name="education" class="select" style="width: 80px;">
                        <option value="大专">大专</option>
                        <option value="本科">本科</option>
                        <option value="高中">高中</option>
                        <option value="研究生">研究生</option>
                        <option value="博士生">博士生</option>
                    </select>
                </dd>
            </dl>
            <dl>
                <dt>毕业院校：</dt>
                <dd><input name="school" class="required textInput" maxlength="50" type="text" value="" /></dd>
            </dl>
            <dl>
                <dt>在校专业：</dt>
                <dd><input name="major" class="required textInput" maxlength="50" type="text" value="" /></dd>
            </dl>
            <dl>
                <dt>身份证号码：</dt>
                <dd><input name="id_cart" class="required alphanumeric textInput" maxlength="18" minlength="18" type="text" value="" /></dd>
            </dl>
            <dl>
                <dt>身份证地址：</dt>
                <dd><input name="address_cart" class="required textInput" maxlength="50" type="text" value="" /></dd>
            </dl>
            <div class="divider"></div>
            <dl>
                <dt>联系电话：</dt>
                <dd><input name="tel" class="required phone textInput" maxlength="20" type="text" value="" /></dd>
            </dl>
            <dl>
                <dt>常用邮箱：</dt>
                <dd><input name="email" class="required email textInput" maxlength="40" type="text" value="" /></dd>
            </dl>
            <dl>
                <dt>紧急联系人：</dt>
                <dd><input name="emergency_name" class="required textInput" maxlength="20" type="text" value="" /></dd>
            </dl>
            <dl>
                <dt>紧急联系人电话：</dt>
                <dd><input name="emergency_tel" class="required phone textInput" maxlength="20" type="text" value="" /></dd>
            </dl>
            <dl>
                <dt>现居地址：</dt>
                <dd><input name="address" class="required textInput" maxlength="50" type="text" value="" /></dd>
            </dl>
            <div class="divider"></div>
            <dl>
                <dt>级别：</dt>
                <dd>
                    <select name="level" class="select" style="width: 80px;">
                        <option value="执行专员">执行专员</option>
                        <option value="部门经理">部门经理</option>
                        <option value="副总经理">副总经理</option>
                        <option value="总经理">总经理</option>
                    </select>
                </dd>
            </dl>
            <dl>
                <dt>部门：</dt>
                <dd>
                    <input name="department_id" value="" type="hidden">
                    <input class="required textInput" name="department_name" readonly="readonly" type="text" suggestFields="department_name" 
                           suggestUrl="<?php echo site_url('em/edit/department'); ?>" lookupGroup=""/>
                </dd>
            </dl>
            <dl>
                <dt>职位：</dt>
                <dd><input name="post" class="required textInput" maxlength="40" type="text" value="" /></dd>
            </dl>
            <div class="divider"></div>
            <dl>
                <dt>入职时间：</dt>
                <dd><input name="entry_time" class="date textInput readonly valid" readonly="readonly" type="text" value="" /><a href="javascript:;" class="inputDateButton">选择</a></dd>
            </dl>
            <dl>
                <dt>转正时间：</dt>
                <dd><input name="formal_time" class="date textInput readonly valid" readonly="readonly" type="text" value="" /><a href="javascript:;" class="inputDateButton">选择</a></dd>
            </dl>
            <dl>
                <dt>社保开始时间：</dt>
                <dd><input name="ss_start_time" class="date textInput readonly valid" readonly="readonly" type="text" value="" /><a href="javascript:;" class="inputDateButton">选择</a></dd>
            </dl>
            <dl>
                <dt>社保结束时间：</dt>
                <dd><input name="ss_end_time" class="date textInput readonly valid" readonly="readonly" type="text" value="" /><a href="javascript:;" class="inputDateButton">选择</a></dd>
            </dl>
            <dl>
                <dt>离职时间：</dt>
                <dd><input name="level_time" class="date textInput readonly valid" readonly="readonly" type="text" value="" /><a href="javascript:;" class="inputDateButton">选择</a></dd>
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
